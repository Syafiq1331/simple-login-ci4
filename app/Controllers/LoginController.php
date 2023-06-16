<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login/index');
    }

    public function doLogin()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $session = session();

        $model = new \App\Models\UserModel();
        $user = $model->where('email', $email)->first();

        if ($user) {
            $pass = $user['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $login = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'logged_in' => TRUE,
                ];
                $session->set($login);
                return redirect()->to('/home');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login');
        }
    }

    public function Logout()
    {
        $session = session();
        $this->$session->destroy();
        return redirect()->to('/login');
    }
}
