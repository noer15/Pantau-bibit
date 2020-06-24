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

    public function update(){
        $this->isPost();
        $this->Account->update_data($_POST);
        $this->session->set_flashdata('msg', 'Account has been update');
        redirect('account');
    }

    
    public function edit($id){
        $where = array('id' => $id);
        $data['pegawai'] = $this->Account->edit_data($where,'pegawai')->row();

        $template['title']      = 'Rosecell - Edit';
        $template['content']    = $this->load->view('account/v_edit',$data);
        $this->render($template);
    }

    public function delete($id)
    {
        $account = array('id' => $id);
        $this->Account->delete($account,'pegawai');
        $this->session->set_flashdata('msg', 'Account has been deleted');
        redirect('account');
    }
    private function isPost()
    {
        if(!$_POST){
            redirect('account');
        }
    }


	
}
