<?php

namespace App\Controllers;

class DocumentRegistryController extends BaseController {

  public function __construct() {
    helper(['url', 'Form', 'form', 'Menu']);
  }

  public function index() {
    return view('postregister/index');
  }

  public function create() {
    return view('postregister/create');
  }

  public function store() {
    return redirect()->to('postregister');
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
