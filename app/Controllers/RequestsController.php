<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \CodeIgniter\I18n\Time;


class RequestsController extends BaseController
{
    public function __construct() {
      helper(['url', 'Form', 'form', 'Menu', 'download']);
    }

    public function process_requests_index() {
      $user = session()->get('loggedUser');

      $model_types = new \App\Models\RequestResponsibleModel();
      $model_requests = new \App\Models\RequestModel();

      $responsibilities = $model_types->where('user', $user)->findAll();
      $ids = [];
      foreach ($responsibilities as $responsibility) {
        $ids[] = (int) $responsibility->request_type;
      }

      $open_requests = $model_requests
        ->select('requests.id as id, requests.startpoint as start_date, requests.endpoint as end_date, requests.status as numstatus, request_status.label as status, request_types.label as request_type, users.email as email, requests.requester as user')
        ->whereIn('request_type', $ids)
        ->where('status', 1)
        ->join('users', 'users.id=requests.requester', 'LEFT')
        ->join('request_types', 'requests.request_type=request_types.id', 'LEFT')
        ->join('request_status', 'requests.status=request_status.id', 'LEFT')
        ->orderBy('requests.startpoint', 'DESC')
        ->findAll();

        foreach ($open_requests as $entry) {
          $temp_date = $mdate = Time::parse($entry->start_date, 'America/Chicago', 'en_US');
          $entry->start_date = $temp_date->toLocalizedString('dd.MM.YYYY');

          $temp_date = $mdate = Time::parse($entry->end_date, 'America/Chicago', 'en_US');
          $entry->end_date = $temp_date->toLocalizedString('dd.MM.YYYY');
        }

        $data = [
          'requests' => $open_requests,
          'request_states' => $this->get_request_states()
        ];

        return view('request/process', $data);

    }

    public function update($id) {
      $model = new \App\Models\RequestModel();
      $dataset = $model->find($id);
      $dataset->startpoint = Time::parse($this->request->getVar('start_date'), 'Europe/Berlin', 'de_DE');
      $dataset->endpoint = Time::parse($this->request->getVar('end_date'), 'Europe/Berlin', 'de_DE');
      $dataset->status = 1;
      $dataset->description = $this->request->getVar('description');
      $model->save($dataset);
      return
        redirect()
        ->with('success', 'Antrag wurde erneut eingereicht!')
        ->to('/requests');


    }

    public function process_requests_update() {
      $user = $this->request->getVar('userid');
      $request_id = $this->request->getVar('requestid');
      $new_status = $this->request->getVar('request_status');

      $model = new \App\Models\RequestModel();
      $entry = $model->find($request_id);
      $entry->status = $new_status;
      $model->save($entry);

      return redirect()->with('success', 'Statusänderung war erfolgreich')->to('requests/process');
    }

    public function index()
    {
        $model_request = new \App\Models\RequestModel();

        $userid = session()->get('loggedUser');

        $entries = $model_request
          ->select('requests.id as id, requests.startpoint as start_date, requests.endpoint as end_date, request_status.label as status, requests.status as numstatus, request_types.label as request_type')
          ->where('requester', $userid)
          ->orderBy('start_date', 'DESC')
          ->join('request_types', 'requests.request_type=request_types.id', 'LEFT')
          ->join('request_status', 'requests.status=request_status.id', 'LEFT')
          ->findAll();

        foreach ($entries as $entry) {
          $temp_date = $mdate = Time::parse($entry->start_date, 'America/Chicago', 'en_US');
          $entry->start_date = $temp_date->toLocalizedString('dd.MM.YYYY');

          $temp_date = $mdate = Time::parse($entry->end_date, 'America/Chicago', 'en_US');
          $entry->end_date = $temp_date->toLocalizedString('dd.MM.YYYY');
        }

        $data = [
          'requests' => $entries
        ];

        return view('request/myrequests', $data);
    }

    public function edit($idrequest) {
      $model = new \App\Models\RequestModel();

      $dataset = $model
      ->select('requests.id as id, requests.description as description, requests.requester as user, requests.startpoint as start_date, requests.endpoint as end_date, request_status.label as request_status, request_types.label as request_type')
      ->join('request_types', 'requests.request_type=request_types.id', 'LEFT')
      ->join('request_status', 'requests.status=request_status.id', 'LEFT')
      ->find($idrequest);

      if ($dataset->user != session()->get('loggedUser')) {
        return redirect()
          ->with('fail', 'Du bist nicht berechtigt diese Anfrage zu sehen')
          ->to('/requests');
      }

      $temp_date = $mdate = Time::parse($dataset->start_date, 'America/Chicago', 'en_US');
      $dataset->start_date = $temp_date->toLocalizedString('dd.MM.YYYY');

      $temp_date = $mdate = Time::parse($dataset->end_date, 'America/Chicago', 'en_US');
      $dataset->end_date = $temp_date->toLocalizedString('dd.MM.YYYY');

      $data = [
        'userdata' => $dataset
      ];
      return view('request/edit', $data);
    }

    public function create() {
      // get user
      $loggedUser = session()->get('loggedUser');

      // get types

      $request_types = $this->get_request_types();

      $data = [
        'request_user' => $loggedUser,
        'request_types' => $request_types
      ];

      return view('request/create', $data);

    }

    private function get_request_types() {
      $model_type = new \App\Models\RequestTypeModel();
      return $model_type->orderBy('label', 'ASC')->findAll();
    }

    private function get_request_states() {
      $model_status = new \App\Models\RequestStatusModel();
      return $model_status->orderBy('label', 'ASC')->findAll();
    }

    public function store() {
      $validation  = $this->validate([
        'request_type' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib die Art der Anfrage an!'
          ]
        ],
        'start_date' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib das Startdatum an!'
          ]
        ],
        'end_date' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib das Enddatum an!'
          ]
        ]
      ]);

      if (!$validation) {
        $data = [
          'request_user' => session()->get('loggedUser'),
          'request_types' => $this->get_request_types(),
          'validation' => $this->validator
        ];
        return view('request/create', $data);
      }

      $model_request = new \App\Models\RequestModel();

      $startdate = Time::parse($this->request->getVar('start_date'), 'Europe/Berlin', 'de_DE');
      $startdate = $startdate->toDateTimeString();
      $enddate = Time::parse($this->request->getVar('end_date'), 'Europe/Berlin', 'de_DE');
      $enddate = $enddate->toDateTimeString();
      $now = Time::now('Europe/Berlin', 'de_DE');
      $now = $now->toDateTimeString();

      $data = [
        'description' => $this->request->getVar('description'),
        'startpoint' => $startdate,
        'endpoint' => $enddate,
        'requester' => session()->get('loggedUser'),
        'status' => 1,
        'request_type' => $this->request->getVar('request_type'),
        'created_at' => $now
      ];

      $model_request->save($data);

      return redirect()->with('success', 'Antrag erfolgreich eingereicht. Er wird nun noch geprüft und genehmigt.')->to('/requests');
    }
}
