<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
  public function __construct() {
    helper(['Menu']);
  }

    public function index()
    {
      $user_model = new \App\Models\UserModel();
      $loggedUser = session()->get('loggedUser');
      $user_info = $user_model->find($loggedUser);

        $data = [
          'title' => 'Dashboard',
          'userinfo' => $user_info,
        ];
        return view('dashboard/index', $data);
    }
}
