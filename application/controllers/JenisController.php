<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis');
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
        $data['jenis']              = $this->db->get('jenis')->result();
        $template['title']          = 'Aplikasi Pantau Bibit - Category';
        $template['content']        = $this->load->view('bibit/index',$data);
		$this->render($template);
    }

    public function add_action(){
        $name = $this->input->post('jenis');
        $warna = $this->input->post('warna');
 
        $data = array(
            'jenis_name' => $name,
            'warna' => $warna
            );
        $this->Jenis->input_data($data,'jenis');
        $this->session->set_flashdata('msg', 'Jenis bibit has been added');
        redirect('jenis');
    }

    public function delete($id)
    {
        $jenis = array('id_jenis' => $id);
        $this->Jenis->delete($jenis,'jenis');
        $this->session->set_flashdata('msg', 'Jenis bibit has been deleted');
        redirect('jenis');
    }

    public function update(){
        $name = $this->input->post('jenis');
        $warna = $this->input->post('warna');
 
        $data = array(
            'jenis_name' => $name,
            'warna' => $warna
            );
       $where = array( 'id_jenis' => $_POST['id'] );
        $this->Jenis->update_data($where,$data,'jenis');
        $this->session->set_flashdata('msg', 'Jenis has been update');
        redirect('jenis');
    }
	
}
