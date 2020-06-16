<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
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
        $template['title']          = 'Aplikasi Pantau Bibit - Category';
        $template['content']        = $this->load->view('laporan/index');
		$this->render($template);
    }





	
}
