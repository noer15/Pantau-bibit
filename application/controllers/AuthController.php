<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth');
        $this->load->library('session');
    }
    public function index()
    {
        if($this->session->userdata('logged_in')){
            return redirect(base_url());
        }else{
            $this->load->view('auth/login');
        }
    }

    public function login()
    {
        $this->isPOST();

        $user   = $this->Auth->checkUser($_POST['username']);
        if(!empty($user)){
            $checkPassword = password_verify($_POST['password'], $user->password);
            if($checkPassword){

                $session = [
                    'logged_in'     => true,
                    'nama'          => $user->nama,
                ];

                $this->session->set_userdata($session);
                return redirect(base_url());

            }else{
                $this->session->set_flashdata('error_password','Password yang dimasukan salah.');
                return redirect(base_url('login'));
            }
        }else{
            $this->session->set_flashdata('username', $_POST['username']);
            $this->session->set_flashdata('error_username','Nip tidak ditemukan.');
            return redirect(base_url('login'));
        }
    }

    public function logout()
    {
        session_destroy();
        return redirect(base_url('login'));
    }

    private function isPOST()
    {
        if(!$_POST){
            return redirect(base_url('login'));
        }
    }
}
