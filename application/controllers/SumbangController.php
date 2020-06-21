<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SumbangController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sumbang');
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
        $data['provinsi'] = $this->db->get('provinsi');
        $template['title']          = 'Tambah Sumbang bibit - Sumbang';
        $template['content']        = $this->load->view('sumbang/v_add',$data);
        $this->render($template);
    }

    public function add_action(){
        $prov = $_POST['prov'];
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
            'id_prov' => $prov,
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

    public function edit($id){
        $where = array('id_sumbangan' => $id);
        $data['provinsi'] = $this->db->get('provinsi');
        $data['e_sumbang'] = $this->Sumbang->edit_data($where,'sumbangan')->row();
        $template['title']      = 'Sumbangan - Edit';
        $template['content']    = $this->load->view('sumbang/v_edit',$data);
        $this->render($template);
    }

    public function update(){
        $kategori = $_POST['id_kategori'];
        $jenis = $_POST['id_jenis'];
        $lat = $_POST['lat'];
        $long = $_POST['long'];
        $jumlah = $_POST['jumlah'];
        $penyumbang = $_POST['penyumbang'];
 
        $data = array(
            'id_kategori' => $kategori,
            'id_jenis' => $jenis,
            'jumlah' => $jumlah,
            'lat' => $lat,
            'long' => $long,
            'nama_penyumbang' => $penyumbang,
            );
        $where = array( 'id_sumbangan' => $_POST['id_sumbangan'] );
        $this->Sumbang->update_data($where,$data,'sumbangan');
        $this->session->set_flashdata('msg', 'Sumbangan bibit has been update');
        redirect('sumbang');
    }

    function kabupaten(){
        $propinsiID = $_GET['id'];
        $kabupaten   = $this->db->get_where('kabupaten',array('id_prov'=>$propinsiID));
        echo " <div class='form-group'>
                <label>Kabupaten</label>";
        echo "<select id='kabupaten' onChange='loadKecamatan()' class='form-control' name='kab'>";
        echo "<option value='Pilih negara dahulu' data-id='0' >--Pilih Kabupaten --</option>";
        foreach ($kabupaten->result() as $k)
        {
            echo "<option value='$k->id_kabupaten'>$k->nama_kab</option>";
        }
        echo "</select></div>";
    }
    
    function kecamatan(){
        $kabupatenID = $_GET['id'];
        $kecamatan   = $this->db->get_where('kecamatan',array('id_kabupaten'=>$kabupatenID));
        echo " <div class='form-group'>
                <label>Kecamatan</label>";
        echo "<select id='kecamatan' onChange='loadDesa()' class='form-control' name='kec'>";
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
        echo "<select id='wilayah' onChange='loadWilayah()' class='form-control' name='desa'>";
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

    public function delete($id)
    {
        $sumbangan = array('id_sumbangan' => $id);
        $this->Sumbang->delete($sumbangan,'sumbangan');
        $this->session->set_flashdata('msg', 'Sumbangan has been deleted');
        redirect('sumbang');
    }

	
}
