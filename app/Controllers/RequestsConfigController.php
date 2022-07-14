<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \CodeIgniter\I18n\Time;


class RequestsConfigController extends BaseController
{
    public function __construct() {
      helper(['url', 'Form', 'form', 'Menu', 'download']);
    }

    public function responsibilities() {
      $validation = $this->validate([
        'userid' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Benötige user id'
          ]
        ]
      ]);

      if (!$validation) {
        return redirect()
          ->with('fail', 'Parameter nicht gültig')
          ->to('/requestsconfig');
      }

      $responsibilites_user = $this->request->getVar('chk_resp');
      $userid = $this->request->getVar('userid');
      $model = new \App\Models\RequestResponsibleModel();

      if (isset($responsibilites_user)) {
        foreach ($responsibilites_user as $responsibility) {
          $nbr_records = $model->where('user', $userid)->where('request_type', $responsibility)->countAllResults();
          if ($nbr_records == 0) {
            $data = [
              'user' => $userid,
              'request_type' => $responsibility
            ];
            $model->insert($data);

          }
        }

        $model
          ->where('user', $userid)
          ->whereNotIn('request_type', $responsibilites_user)
          ->delete();
      } else {
        $model
          ->where('user', $userid)
          ->delete();
      }

      return redirect()
        ->with('success', 'Eintrag wurde gespeichert')
        ->to('/requestsconfig');
    }

    public function index() {
      $user_model        = new \App\Models\UserModel();
      $requesttype_model      = new \App\Models\RequestTypeModel();
      $request_user_model = new \App\Models\RequestResponsibleModel();

      $users = $user_model->orderBy('email', 'ASC')->findAll();
      $all_request_types = $requesttype_model->orderBy('label', 'ASC')->findAll();

      $userlist = array();

      foreach ($users as $user) {
        $user_id = $user->id;
        $requesttypes_user = array();
        foreach ($all_request_types as $request_type) {
          $nbr_user_requesttype = $request_user_model->where('user', $user_id)->where('request_type', $request_type->id)->countAllResults();

          if ($nbr_user_requesttype > 0) {
            $requesttypes_user[] = [
              'id' => $request_type->id,
              'label' => $request_type->label,
              'has' => 1
            ];
          } else {
            $requesttypes_user[] = [
              'id' => $request_type->id,
              'label' => $request_type->label,
              'has' => 0
            ];
          }

        }

        $userlist[] = [
          'id' => $user_id,
          'email' => $user->email,
          'responsible' => $requesttypes_user
        ];

      }

      $data = [
        'users' => $userlist
      ];

      return view('request/request_responsible', $data);
    }
}

?>
