<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends CI_Controller {
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
        $template['content']        = $this->load->view('category/index');
		$this->render($template);
    }

	
}
