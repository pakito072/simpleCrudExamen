<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{

  protected $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
  }

  public function index()
  {
    $perPage = 5; // Número de usuarios por página
    $page = $this->request->getVar('page') ?? 1;
    $search = $this->request->getVar('search');
    $username = $this->request->getVar('username');
    $email = $this->request->getVar('email');
    $created_at = $this->request->getVar('created_at');
    $updated_at = $this->request->getVar('updated_at');
    $is_disabled = $this->request->getVar('is_disabled');
    $sort = $this->request->getVar('sort') ?? 'id';
    $order = $this->request->getVar('order') ?? 'asc';

    $query = $this->userModel;

    if ($search) {
      $query = $query->like('username', $search)
        ->orLike('email', $search);
    }

    if ($username) {
      $query = $query->like('username', $username);
    }

    if ($email) {
      $query = $query->like('email', $email);
    }

    if ($created_at) {
      $query = $query->like('created_at', $created_at);
    }

    if ($updated_at) {
      $query = $query->like('updated_at', $updated_at);
    }

    if ($is_disabled !== null) {
      $query = $query->where('is_disabled', $is_disabled);
    }

    $users = $query->orderBy($sort, $order)
      ->paginate($perPage, 'default', $page);

    $data = [
      'users' => $users,
      'pager' => $this->userModel->pager,
      'search' => $search,
      'username' => $username,
      'email' => $email,
      'created_at' => $created_at,
      'updated_at' => $updated_at,
      'is_disabled' => $is_disabled,
      'sort' => $sort,
      'order' => $order
    ];

    return view('index', $data);
  }

  public function create()
  {
    $validation = \Config\Services::validation();

    $validation->setRules([
      'username' => 'required|min_length[3]|max_length[20]',
      'email' => 'required|valid_email',
      'password' => 'required|min_length[6]'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
      return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $data = [
      'username' => $this->request->getPost('username'),
      'email' => $this->request->getPost('email'),
      'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
      'is_disabled' => false
    ];
    $this->userModel->save($data);
    return redirect()->to('/')->with('success', 'Usuario creado exitosamente.');
  }

  public function update($id)
  {
    $validation = \Config\Services::validation();

    $validation->setRules([
      'username' => 'required|min_length[3]|max_length[20]',
      'email' => 'required|valid_email',
      'password' => 'permit_empty|min_length[6]'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
      return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $data = [
      'id' => $id,
      'username' => $this->request->getPost('username'),
      'email' => $this->request->getPost('email'),
      'password' => $this->request->getPost('password') ? password_hash($this->request->getPost('password'), PASSWORD_DEFAULT) : null
    ];

    // Remove password from data if it's empty
    if (empty($data['password'])) {
      unset($data['password']);
    }

    $this->userModel->save($data);
    return redirect()->to('/')->with('success', 'Usuario actualizado exitosamente.');
  }

  public function disable($id)
  {
    $data = [
      'id' => $id,
      'is_disabled' => true
    ];
    $this->userModel->save($data);
    return redirect()->to('/')->with('success', 'Usuario deshabilitado exitosamente.');
  }

  public function restore($id)
  {
    $data = [
      'id' => $id,
      'is_disabled' => false
    ];
    $this->userModel->save($data);
    return redirect()->to('/')->with('success', 'Usuario restaurado exitosamente.');
  }

  public function edit($id)
  {
    $user = $this->userModel->find($id);
    return view('edit_modal', ['user' => $user]);
  }

  public function export()
  {
    $search = $this->request->getVar('search');
    $username = $this->request->getVar('username');
    $email = $this->request->getVar('email');
    $created_at = $this->request->getVar('created_at');
    $updated_at = $this->request->getVar('updated_at');
    $is_disabled = $this->request->getVar('is_disabled');
    $sort = $this->request->getVar('sort') ?? 'id';
    $order = $this->request->getVar('order') ?? 'asc';

    $query = $this->userModel;

    if ($search) {
      $query = $query->like('username', $search)
        ->orLike('email', $search);
    }

    if ($username) {
      $query = $query->like('username', $username);
    }

    if ($email) {
      $query = $query->like('email', $email);
    }

    if ($created_at) {
      $query = $query->like('created_at', $created_at);
    }

    if ($updated_at) {
      $query = $query->like('updated_at', $updated_at);
    }

    if ($is_disabled !== null) {
      $query = $query->where('is_disabled', $is_disabled);
    }

    $users = $query->orderBy($sort, $order)->findAll();

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=usuarios.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Username', 'Email', 'Created At', 'Updated At', 'Is Disabled']);

    foreach ($users as $user) {
      fputcsv($output, $user);
    }

    fclose($output);
    exit;
  }
}
