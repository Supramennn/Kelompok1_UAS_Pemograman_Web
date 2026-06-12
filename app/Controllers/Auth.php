<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'nama' => $user['nama'],
                'role' => $user['role'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
