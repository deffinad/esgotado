<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $validation;
    protected $mAuth;
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();

        $this->session->start();

        $this->mAuth = new AuthModel();
    }

    public function index()
    {
        return view('auth/signin');
    }

    public function signinProcess()
    {
        $input = $this->request->getPost();

        $validation = [
            'email' => $input['email'],
            'password' => $input['password']
        ];

        if (!$this->validation->run($validation, 'signin')) {
            $this->session->setFlashdata('input', $this->request->getPost());
            $this->session->setFlashdata('validationError', $this->validation->getErrors());
            $this->session->setFlashdata('gagal', 'Mohon Maaf Masukan Data Dengan Benar');
            return redirect()->back();
        } else {
            $result = $this->mAuth->signin($input['email'], sha1($input['password']));
            if ($result > 0) {
                $this->session->set('isLogged', $result);
                return redirect()->to('/');
            } else {
                $this->session->setFlashdata('gagal', 'Mohon Maaf Email/Password Salah');
                return redirect()->back();
            }
        }
    }

    public function signupView()
    {
        return view('auth/signup');
    }

    public function signupProcess()
    {
        $input = $this->request->getPost();

        $validation = [
            'email' => $input['email'],
            'password' => $input['password']
        ];

        if (!$this->validation->run($validation, 'signin')) {
            $this->session->setFlashdata('input', $this->request->getPost());
            $this->session->setFlashdata('validationError', $this->validation->getErrors());
            $this->session->setFlashdata('gagal', 'Mohon Maaf Masukan Data Dengan Benar');
            return redirect()->back();
        } else {
            $result = $this->mAuth->signin($input['email'], sha1($input['password']));
            if ($result > 0) {
                $this->session->set('isLogged', $result);
                return redirect()->to('/');
            } else {
                $this->session->setFlashdata('gagal', 'Mohon Maaf Email/Password Salah');
                return redirect()->back();
            }
        }
    }

    public function logout()
    {
        $this->session->remove('isLogged');

        if (!($this->session->get('isLogged'))) { //jika berhasil dihapus session
            $this->session->setFlashdata('sukses', "Berhasil Keluar"); //menampilkan pesan berhasil
        }
        return redirect()->to('/signin');
    }
}
