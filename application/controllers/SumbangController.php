<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SumbangController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sumbang');
        $this->load->helper('form');
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
        $sumbangan['sumbangan']   = $this->Sumbang->get_all()->result();
        $template['title']          = 'Aplikasi Pantau Bibit - Sumbang';
        $template['content']        = $this->load->view('sumbang/index',$sumbangan);
		$this->render($template);
    }

    public function testing()
    {
        $data = $this->Sumbang->get_all()->result();
        print_r($data);
    }

    public function add()
    {
        $data['kabupaten'] = $this->db->get('kabupaten');
        $template['title']          = 'Tambah Sumbang bibit - Sumbang';
        $template['content']        = $this->load->view('sumbang/v_add',$data);
        $this->render($template);
    }

    public function ss(){
        $kab =  $_POST['kab'];
        $kec = $_POST['kec'];
        $desa = $_POST['desa'];
        $kategori = $_POST['id_kategori'];
        $jenis = $_POST['id_jenis'];
        $lat = $_POST['lat'];
        $long = $_POST['long'];
        $jumlah = $_POST['jumlah'];
        $penyumbang = $_POST['penyumbang'];
 
        $data = array(
            'id_kab' => $kab,
            'id_kec' => $kec,
            'id_desa' => $desa,
            'id_kategori' => $kategori,
            'id_jenis' => $jenis,
            'jumlah' => $jumlah,
            'lat' => $lat,
            'long' => $long,
            'nama_penyumbang' => $penyumbang,
            );
        $this->Sumbang->input_data($data,'sumbangan');
        $this->session->set_flashdata('msg', 'Sumbangan bibit has been added');
        redirect('sumbang/add');
    }

    public function add_action(){
        $this->isPost();

        $config['upload_path']      = './assets/images';
        $config['allowed_types']    = 'gif|png|jpg|jpeg';
        $config['encrypt_name']     = TRUE;  
        $this->load->library('upload',$config);

        $upload  = $_POST;
        if($_FILES['foto']['name']){
            if($this->upload->do_upload('foto')){
                $images = $this->upload->data();
                $upload['foto'] = $images['file_name'];
            }
        }

        $this->Sumbang->input_data($upload,'sumbangan');
        $this->session->set_flashdata('msg', 'Sumbang has been added');
        redirect('sumbang');
    }

    public function edit($id){
        $where = array('id_sumbangan' => $id);
        $data['provinsi'] = $this->db->get('provinsi');
        $data['e_sumbang'] = $this->Sumbang->edit_data($where,'sumbangan')->row();
        $template['title']      = 'Sumbangan - Edit';
        $template['content']    = $this->load->view('sumbang/v_edit',$data);
        $this->render($template);
    }

    public function get_by_id($id){
        return $this->db->where('customer_id',$id)
                        ->get('customer');
    }

    public function update(){
        $this->isPost();

        $config['upload_path']      = './assets/images';
        $config['allowed_types']    = 'gif|png|jpg|jpeg';
        $config['encrypt_name']     = TRUE;  
        $this->load->library('upload',$config);

        $upload  = $_POST;
        $old = $this->Sumbang->get_by_id($upload['id_sumbangan'])->row();

        if($_FILES['foto'] != null){
            if($this->upload->do_upload('foto')){
                $images = $this->upload->data();
                $upload['foto'] = $images['file_name'];
                unlink('./assets/images/'.$old->foto);
            }
        }else{
            $upload['foto']  = $old->foto;
        }

        $this->Sumbang->update($upload);
        $this->session->set_flashdata('msg', 'Sumbangan has been update');
        redirect('sumbang/edit/'.$upload['id_sumbangan']);
    }

  
    
    function kecamatan(){
        $kabupatenID = $_GET['id'];
        $kecamatan   = $this->db->get_where('kecamatan',array('id_kabupaten'=>$kabupatenID));
        echo " <div class='form-group'>
                <label>Kecamatan</label>";
        echo "<select id='kecamatan' onChange='loadDesa()' class='form-control' name='id_kec'>";
        echo "<option value='Pilih negara dahulu' data-id='0' >--Pilih Kecamatan --</option>";
        foreach ($kecamatan->result() as $k)
        {
            echo "<option value='$k->id_kecamatan'>$k->nama_kec</option>";
        }
        echo"</select></div>";
    }
    
    function desa(){
        $kecamatanID  = $_GET['id'];
        $desa         = $this->db->get_where('desa',array('id_kecamatan'=>$kecamatanID));
        echo " <div class='form-group'>
                <label>Desa</label>";
        echo "<select id='wilayah' onChange='loadWilayah()' class='form-control' name='id_desa'>";
        echo "<option value='Pilih negara dahulu' data-id='0' >--Pilih Desa --</option>";
        foreach ($desa->result() as $d)
        {
            echo "<option value='$d->id_desa' data-id='$d->id_desa'>$d->nama_desa</option>";
        }
        echo"</select></div>";
    }

    function wilayah(){
        $desa  = $_GET['id'];
        $wilayah  = $this->db->get_where('desa',array('id_desa'=>$desa));
        echo "<div class='col-md-6'><div class='form-group'>
                <label>Latitude</label>";
        foreach ($wilayah->result() as $d)
        {
            echo "<input type='text' class='form-control' name='lat' value='$d->latitude'>";
        }
        echo"</div></div>";


         echo "<div class='col-md-6' style='float:right; margin-top:-90px;'><div class='form-group'>
                <label>Longitude</label>";
        foreach ($wilayah->result() as $d)
        {
            echo "<input type='text' class='form-control' name='long' value='$d->longitude'>";
        }
        echo"</div></div>";
    }

    function get_wilayah($id){
        if($id != 'null'):
        $result = $this->Sumbang->get_wilayah($id)->result();
        echo json_encode($result);
        endif;
    }


    public function delete($id){
        $_id = $this->db->get_where('sumbangan',['id_sumbangan' => $id])->row();
        $query = $this->db->delete('sumbangan',['id_sumbangan'=>$id]);
        if($query){
            unlink(".assets/images/".$_id->foto);
        }
        $this->session->set_flashdata('msg', 'Sumbangan has been deleted');
        redirect('sumbang');
    }

    private function isPost()
    {
        if(!$_POST){
            redirect('sumbang');
        }
    }
	
}
