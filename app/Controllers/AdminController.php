<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \CodeIgniter\I18n\Time;


class AdminController extends BaseController
{
    public function __construct() {
      helper(['url', 'Form', 'form', 'Menu', 'download']);
    }

    public function modules() {
      $validation = $this->validate([
        'userid' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Benötige user id'
          ]
        ]
      ]);

      if (!$validation) {
        return redirect()->to('/admin')->with('fail', 'Konnte nicht validieren');
      }

      $modules_user = $this->request->getVar('chk_module');

      $userid = $this->request->getVar('userid');

      $model_user_modules = new \App\Models\ModuleUserModel();

      if (isset($modules_user))
      {
        foreach ($modules_user as $module) {
          $nbr_records = $model_user_modules->where('user', $userid)->where('module', $module)->countAllResults();

          if ($nbr_records == 0) {
            $data = [
              'user'   => $userid,
              'module' => $module
            ];
            $model_user_modules->insert($data);
          }
        }


      $model_user_modules
        ->where('user', $userid)
        ->whereNotIn('module', $modules_user)
        ->delete();
      } else {
        $model_user_modules->where('user', $userid)->delete();
      }

      return redirect()->with('success', 'Ändeurngen wurden eingetragen.')->to('/admin');
    }

    public function index()
    {
      $user_model        = new \App\Models\UserModel();
      $module_model      = new \App\Models\ModuleModel();
      $module_user_model = new \App\Models\ModuleUserModel();

      $users = $user_model->orderBy('email', 'ASC')->findAll();
      $all_modules = $module_model->orderBy('module_name', 'ASC')->findAll();

      $userlist = array();

      foreach ($users as $user) {
        $user_id = $user->id;
        $modules_user = array();
        foreach ($all_modules as $module) {
          $nbr_user_modules = $module_user_model->where('user', $user_id)->where('module', $module->id)->countAllResults();

          if ($nbr_user_modules > 0) {
            $modules_user[] = [
              'id' => $module->id,
              'label' => $module->module_name,
              'has' => 1
            ];
          } else {
            $modules_user[] = [
              'id' => $module->id,
              'label' => $module->module_name,
              'has' => 0
            ];
          }

        }

        $userlist[] = [
          'id' => $user_id,
          'email' => $user->email,
          'modules' => $modules_user
        ];

      }

      $data = [
        'users' => $userlist
      ];

      return view('admin/panel', $data);
    }
}

?>
