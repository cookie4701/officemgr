<?php

namespace App\Controllers;

use App\Entity\User;
use App\Libraries\Hash;

class Auth extends BaseController
{

  public function __construct() {
    helper(['url', 'Form', 'form']);
  }

    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
      return view('auth/login');
    }

    public function register()
    {
      return view('auth/register');
    }

    public function save()
    {
      $validation = $this->validate([
        'email' => [
          'rules' => 'required|valid_email|is_unique[users.email]',
          'errors' => [
            'required' => 'Du musst eine E-Mail Adresse eingeben!',
            'valid_email' => 'Bitte gib eine korrekte E-Mail Adresse ein!',
            'is_unique' => 'Mit dieser Adresse funktioniert das nicht!'
          ]
        ],
        'password' => [
          'rules' => 'required|min_length[6]|max_length[50]',
          'errors' => [
            'required' => 'Bitte gib ein Passwort ein!',
            'min_length' => 'Das Passwort muss mindestens 6 Zeichen lang sein!',
            'max_length' => 'Das Passwort darf höchstens 50 Zeichen lang sein!',
          ]
        ],
        'password2' => [
          'rules' => 'required|matches[password]',
          'errors' => [
            'required' => 'Bitte bestätige dein Passwort!',
            'matches' => 'Die Passwörter stimmen nicht überein!'
          ]
        ]
      ]);

      if (!$validation)
      {
        return view('auth/register', ['validation' => $this->validator]);
      }

      $user = new \App\Entities\User();
      $user_model = new \App\Models\UserModel();
      $user->email =    $this->request->getVar('email');
      $user->password = Hash::make( $this->request->getVar('password') );
      $user_model->save($user);

      return view('auth/login');
    }

    function check()
    {
      $validation = $this->validate([
        'email' => [
          'rules' => 'required|valid_email|is_not_unique[users.email]',
          'errors' => [
            'required' => 'Bitte gib deine E-Mail Adresse ein',
            'valid_email' => 'Bitte gib eine gültige E-Mail Adresse ein',
            'is_not_unique' => 'E-Mail Adresse wurde nicht gefunden!'
          ]
        ],
        'password' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib ein Passwort ein!'
          ]
        ]
      ]);

      if (!$validation) {
        return view('auth/login', [ 'validation' => $this->validator]);
      } else {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $user_model = new \App\Models\UserModel();
        $user_info = $user_model->where('email', $email)->first();
        $check_password = Hash::check($password, $user_info->password);

        if (! $check_password ) {
          return redirect()->to('/auth/login')->with('fail', 'Login war nicht erfolgreich! Falsches Passwort?!');
        }
        else {
          $user_id = $user_info->id;
          session()->set('loggedUser', $user_id);
          //return view('auth/login_ok');
          return redirect()->to('/dashboard')->with('success', 'Login erfolgreich');
        }
      }


    }

    public function logout()
    {
      if (session()->has('loggedUser'))
      {
        session()->remove('loggedUser');
        return redirect()->to('/auth?access=out')->with('fail', 'Du bist abgemeldet!');
      }
    }
}
