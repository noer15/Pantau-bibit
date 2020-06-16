<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category');
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
        $data['category']           = $this->db->get('category')->result();
        $template['title']          = 'Aplikasi Pantau Bibit - Category';
        $template['content']        = $this->load->view('category/index',$data);
		$this->render($template);
    }

    public function add_action(){
        $name = $this->input->post('category');
 
        $data = array(
            'name_category' => $name
            );
        $this->Category->input_data($data,'category');
        $this->session->set_flashdata('msg', 'Category has been added');
        redirect('category');
    }

    public function delete($id)
    {
        $category = array('id_category' => $id);
        $this->Category->delete($category,'category');
        $this->session->set_flashdata('msg', 'Category has been deleted');
        redirect('category');
    }

     public function update(){
        $name = $this->input->post('nama_kategori');
 
        $data = array(
            'name_category' => $name
            );
       $where = array( 'id_category' => $_POST['id'] );
        $this->Category->update_data($where,$data,'category');
        $this->session->set_flashdata('msg', 'Category has been update');
        redirect('category');
    }



	
}
