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

    // public function add_action(){
    //     $name = $this->input->post('jenis');
    //     $warna = $this->input->post('warna');
 
    //     $data = array(
    //         'jenis_name' => $name,
    //         'warna' => $warna
    //         );
    //     $this->Jenis->input_data($data,'jenis');
    //     $this->session->set_flashdata('msg', 'Jenis bibit has been added');
    //     redirect('jenis');
    // }

    public function add_action(){
        $this->isPost();

        $config['upload_path']      = './assets/images/icon';
        $config['allowed_types']    = 'gif|png|jpg|jpeg';
        $config['encrypt_name']     = TRUE;  
        $this->load->library('upload',$config);

        $upload  = $_POST;
        if($_FILES['warna']['name']){
            if($this->upload->do_upload('warna')){
                $images = $this->upload->data();
                $upload['warna'] = $images['file_name'];
            }
        }

        $this->Jenis->input_data($upload,'jenis');
        $this->session->set_flashdata('msg', 'Jenis has been added');
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
        $this->isPost();

        $config['upload_path']      = './assets/images/icon';
        $config['allowed_types']    = 'gif|png|jpg|jpeg';
        $config['encrypt_name']     = TRUE;  
        $this->load->library('upload',$config);

        $upload  = $_POST;
        $old = $this->Jenis->get_by_id($upload['id_jenis'])->row();

        if($_FILES['warna'] != null){
            if($this->upload->do_upload('warna')){
                $images = $this->upload->data();
                $upload['warna'] = $images['file_name'];
                unlink('./assets/images/icon/'.$old->warna);
            }
        }else{
            $upload['warna']  = $old->warna;
        }

        $this->Jenis->update($upload);
        $this->session->set_flashdata('msg', 'Jenis has been update');
        redirect('jenis');
    }

    private function isPost()
    {
        if(!$_POST){
            redirect('jenis');
        }
    }
	
}
