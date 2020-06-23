<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Account');
    }
    public function render($template)
    {
        $this->load->view('layouts/main', [
            'title'     => $template['title'],
            'content'   => $template['content']
            ]);
    }
	
	public function index()
	{
        $data['account']            = $this->db->get('pegawai')->result();
        $template['title']          = 'Aplikasi Pantau Bibit - Category';
        $template['content']        = $this->load->view('account/index',$data);
		$this->render($template);
    }


	
}
