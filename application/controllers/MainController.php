<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
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
       
        $template['title']          = 'Aplikasi Pantau Bibit - Dashboard';
        $template['content']        = $this->load->view('dashboard/index');
		$this->render($template);
    }

	
}
