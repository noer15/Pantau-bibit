<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile');
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
        $data['profile']           = $this->Profile->get_by_id()->result();
        $template['title']          = 'Aplikasi Pantau Bibit - Profile';
        $template['content']        = $this->load->view('profile/index',$data);
		$this->render($template);
    }

    public function update()
    {
        $this->isPost();
        $config['upload_path']      = './assets/images/profile';
        $config['allowed_types']    = 'gif|png|jpg|jpeg';
        $config['encrypt_name']     = TRUE;  
        $this->load->library('upload',$config);

        $upload  = $_POST;
        $old = $this->Profile->get_by_($upload['id'])->row();

        if($_FILES['img_profile'] != null){
            if($this->upload->do_upload('img_profile')){
                $images = $this->upload->data();
                $upload['img_profile'] = $images['file_name'];
                unlink('./assets/images/profile/'.$old->img_profile);
            }
        }else{
            $upload['img_profile']  = $old->img_profile;
        }

        $this->Profile->update($upload);
        $this->session->set_flashdata('msg', 'Profile has been update');
        redirect('profile');


    }

    public function update_password()
    {
        $password = $this->input->post('password');
 
        $data = array(
            'password' => password_hash($password, PASSWORD_DEFAULT)
            );
        $where = array( 'id' => $_POST['id'] );
        $this->Profile->update_data($where,$data,'pegawai');
        $this->session->set_flashdata('msg', 'password has been update');
        redirect('profile');
    }

    private function isPost()
    {
        if(!$_POST){
            redirect('profile');
        }
    }

    public function testing()
    {
        $data = $this->Profile->get_by_id()->result();
        print_r($data);
    }

}