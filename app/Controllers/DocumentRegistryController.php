<?php

namespace App\Controllers;

use \App\Entities\Document;
use \CodeIgniter\I18n\Time;

class DocumentRegistryController extends BaseController {

  public function __construct() {
    helper(['url', 'Form', 'form', 'Menu', 'download']);
  }

  public function index() {
    return view('postregister/index');
  }

  public function create() {
    return view('postregister/create');
  }

  public function doctypes() {
    $response = [
      'success' => true,
      'data' => ['EIN', 'AUS'],
      'msg' => 'Daten wurden geladen!'
    ];
    return $this->response->setJSON($response);
  }

  public function responsibles() {
    $model_responsible = new \App\Models\DocumentResponsibleModel();
    $responsibles = $model_responsible->join('users', 'users.id=postregister_responsibles.user')->orderBy('friendly_name')->findAll();
    $response = [
      'success' => true,
      'data' => [
        'responsibles' => [ [
          'id' => 0,
          'email' => 'keine',
          'friendly_name' => 'Niemand'
        ],...$responsibles
        ]
      ],
      'msg' => 'Daten wurden geladen!'
    ];
    return $this->response->setJSON($response);
  }

  public function get_workareas() {
    $model_workareas = new \App\Models\PostregisterWorkareaModel();
    $workareas = $model_workareas->orderBy('workarea')->findAll();
    $response = [
      'success' => true,
      'data' => [
        'workareas' => [ ...$workareas ]
      ],
      'msg' => 'Arbeitsbereiche wurden geladen'
    ];
    return $this->response->setJSON($response);
  }

  public function store_workarea() {
    $model_workareas = new \App\Models\PostregisterWorkareaModel();
    $ent = new \App\Entities\PostregisterWorkarea();

    $response = [
      'success' => false,
      'data' => null,
      'msg' => 'Arbeitsbereich konnte nicht gesichert werden! ' . $this->request->getJsonVar('workarea') . '---'
    ];

    if ($this->request->getJsonVar('workarea') != '' ) {
      $ent->workarea = $this->request->getJsonVar('workarea');
      $model_workareas->save($ent);
      $response = [
        'success' => true,
        'data' => null,
        'msg' => 'Arbeitsbereich wurde gesichert!'
      ];
    }

    return $this->response->setJSON($response);
  }

  public function get_file($document_id) {
    $document_model = new \App\Models\DocumentModel();
    $document = $document_model->find($document_id);
    $file_name = WRITEPATH . 'uploads/documents/'  . $this->make_filename($document->post_date, $document->document_type, $document->document_number);
    if ( file_exists($file_name)) {
      //force_download($file_name, NULL);
      return $this->response->download($file_name, NULL);
    } else {
      return redirect()
        ->to('/postregister')
        ->with('fail', 'Konnte die Datei nicht finden ' . $file_name);
    }

  }

  public function rows() {
    $document_model = new \App\Models\DocumentModel();
    $documents = $document_model->orderBy('document_number',  'DESC')->findAll();

    $response = [
      'success' => true,
      'data' => $documents,
      'msg' => 'Daten wurden geladen!'
    ];
    return $this->response->setJSON($response);
  }

  public function store() {
    $validation = $this->validate([
      'document_date' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Bitte gib das Dokumentdatum an!'
        ]
      ],
      'select_type' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte wähe eine Dokumentart aus!'
          ]
      ],
      'select_workarea' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte wähe einen Bereich aus!'
          ]
      ],
      'description' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte beschreibe das Dokument!'
          ]
      ],
      'responsible' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte wähe einen Mitarbeiter aus!'
          ]
      ]
    ]);

    $response = [
      'success' => false,
      'data' => '',
      'msg' => 'Datei konnte nicht hochgeladen werden!'
    ];

    if ($validation) {
      $mdate = Time::parse($this->request->getVar('document_date'), 'Europe/Berlin', 'de_DE');
      $db_date = $mdate->toDateTimeString();

      $doc_type = $this->request->getVar('select_type');

      $year = $mdate->format('Y');
      $firstOfYear = "$year-01-01";
      $lastOfYear = "$year-12-31";

      $document_model = new \App\Models\DocumentModel();

      $where = [
        'document_type' => $doc_type,
        'post_date >=' => $firstOfYear,
        'post_date <=' => $lastOfYear
      ];

      $max_document_nbr_ent = $document_model->where($where)->selectMax('document_number')->first();

      $nbr = 1;

      if ( isset($max_document_nbr_ent)) {
        $nbr = $max_document_nbr_ent->document_number + 1;

      }



      $data = [
        'document_number' => $nbr,
        'document_date' => $db_date,
        'document_type' => $doc_type,
        'area' => $this->request->getVar('select_workarea'),
        'description' => $this->request->getVar('description'),
        'assignee' => $this->request->getVar('responsible')
      ];

      $document_model->save($data);

      if ($file = $this->request->getFile('file_document')) {
        if (!file_exists(WRITEPATH . 'uploads/documents')) {
            mkdir(WRITEPATH . 'uploads/documents',0777, true);
        }

        if ($file->isValid() && substr($file->getClientName(),-3) == 'pdf' ) {
          //$newName = $year . '-' . $doc_type . '-' . sprintf("%07d", $nbr) . '.pdf';
          $newName = $this->make_filename($db_date, $doc_type, $nbr);
          $file->move(WRITEPATH . 'uploads/documents', $newName);
        } else {
          $response = [
            'success' => flase,
            'data' => '',
            'msg' => 'Benötige eine gültige PDF Datei!'
          ];
          return $this->response->setJSON($response);
        }

      }


      $response = [
        'success' => true,
        'data' => '',
        'msg' => 'Datei erfolgreich eingefügt!'
      ];
    } else {
      $errors = $validation->getErrors();
      foreach ($errors as $error_name => $error_val) {
        $response['msg'] .= ' ' . $error_name . ' : ' . $error_val . '**';
      }
    }

    return $this->response->setJSON($response);
  }

  private function make_filename($doc_date, $doc_type, $doc_nbr) {
    $year = substr($doc_date, 0, 4);
    $newName = $year . '-' . $doc_type . '-' . sprintf("%07d", $doc_nbr) . '.pdf';
    return $newName;
  }

  public function edit($id) {
    $data = [
      'id' => 'foo'
    ];
    return view('postregister', data);
  }

  public function update($id) {
    return redirect()->to('/postregister/edit');
  }
}
