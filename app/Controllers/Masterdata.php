<?php

namespace App\Controllers;

class Masterdata extends BaseController
{
  public function __construct() {
    helper(['url', 'Form', 'form', 'Menu']);
  }

    public function index()
    {
      $masterdata_model = new \App\Models\MasterdataModel();
      $entries = $masterdata_model->orderBy('orga_name', 'ASC')->findAll();

      $data = [
        'organizations' => $entries
      ];
        return view('masterdata/index', $data);
    }

    public function ajax_ent_data($id) {
      $masterdata_model = new \App\Models\MasterdataModel();
      $ent = $masterdata_model->find($id);
      return json_encode($ent);
    }

    public function edit($idEntry)
    {
      $masterdata_model = new \App\Models\MasterdataModel();
      $masterdate = $masterdata_model->find($idEntry);

      if (!$masterdate) {
        session()->setFlashdata('fail', 'Datensatz nicht gefunden');
        return redirect()->to('/dashboard');
      }


      //session('fail', var_dump($masterdate));

      $data = array
      (
        'id' => $idEntry,
        'name_orga' => $masterdate->orga_name,
        'address1' => $masterdate->address1,
        'address2' => $masterdate->address2,
        'zip' => $masterdate->zip,
        'city' => $masterdate->city,
        'country' => $masterdate->country,
        'vat' => $masterdate->vat,
        'phone' => $masterdate->phone,
        'contact' => $masterdate->contact_name,
        'email_contact' => $masterdate->contact_email
      );
      return view('masterdata/edit', $data);
    }

    public function create()
    {
      return view('masterdata/create');
    }

    public function store()
    {
      $validation = $this->validate([
        'name_orga' => [
          'rules' => 'required|min_length[2]|max_length[200]',
          'errors' => [
            'required' => 'Das Feld Bezeichnung der Organisation muss ausgefüllt werden!',
            'min_length' => 'Die Organisation muss aus mindestens 2 Zeichen bestehen!',
            'max_length' => 'Die Organisation darf nicht mehr als 200 Zeichen lang sein!'
          ]
        ],
        'address1' => [],
        'address2' => [],
        'zip' => [],
        'city' => [],
        'country' => [],
        'vat' => [],
        'phone' => [],
        'contact' => [],
        'email_contact' => []
      ]);

      if (!$validation)
      {
        session()->setFlashdata('fail', $this->validator->listErrors());
        return view('masterdata/create', ['validation' => $this->validator]);

      }

      $masterdata = new \App\Entities\Masterdata();
      $masterdata->orga_name = $this->request->getVar('name_orga', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->address1 = $this->request->getVar('address1', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->address2 = $this->request->getVar('address2', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->zip = $this->request->getVar('zip', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->city = $this->request->getVar('city', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->country = $this->request->getVar('country', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->vat = $this->request->getVar('vat', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->phone = $this->request->getVar('phone', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->contact_name = $this->request->getVar('contact', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->contact_email = $this->request->getVar('email_contact', FILTER_SANITIZE_EMAIL);

      $masterdata_model = new \App\Models\MasterdataModel();

      $masterdata_model->save($masterdata);

      session()->setFlashdata('success', 'Datensatz wurde erfolgreich angelegt!');
      return redirect()->to(site_url('masterdata/index'));

    }

    public function update($id)
    {
      $masterdata_model = new \App\Models\MasterdataModel();
      $masterdata = $masterdata_model->find($id);

      if (!$masterdata)
      {
        session()->setFlashdata('fail', "Datensatz wurde nicht gefunden!");
        return redirect()->to('/masterdata');
      }

      $masterdata->orga_name = $this->request->getVar('name_orga', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->address1 = $this->request->getVar('address1', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->address2 = $this->request->getVar('address2', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->zip = $this->request->getVar('zip', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->city = $this->request->getVar('city', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->country = $this->request->getVar('country', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->vat = $this->request->getVar('vat', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->phone = $this->request->getVar('phone', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->contact_name = $this->request->getVar('contact', FILTER_SANITIZE_SPECIAL_CHARS);
      $masterdata->contact_email = $this->request->getVar('email_contact', FILTER_SANITIZE_EMAIL);

      if ($masterdata->hasChanged()) $masterdata_model->save($masterdata);

      return redirect()->to(site_url('masterdata/index'));
    }
}
