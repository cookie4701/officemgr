<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class RequestsController extends BaseController
{
    public function __construct() {
      helper(['url', 'Form', 'form', 'Menu', 'download']);
    }
    
    public function index()
    {
        //
        return redirect()->to('/requests/create');
    }

    public function edit() {

    }

    public function create() {
      // get user
      $loggedUser = session()->get('loggedUser');

      // get types
      $model_type = new \App\Models\RequestTypeModel();
      $request_types = $model_type->orderBy('label', 'ASC')->findAll();

      $data = [
        'request_user' => $loggedUser,
        'request_types' => $request_types
      ];

      return view('request/create', $data);

    }
}
