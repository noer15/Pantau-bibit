<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan');
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
        
        $data['show']               = $this->Laporan->total_perkab()->result();
        $data['provinsi']           = $this->db->get('provinsi')->result();
        $template['title']          = 'Aplikasi Pantau Bibit - Laporan';
        $template['content']        = $this->load->view('laporan/index',$data);
		$this->render($template);
    }

    function kabupaten(){
        $propinsiID = $_GET['id'];
        $kabupaten   = $this->db->get_where('kabupaten',array('id_prov'=>$propinsiID));
        echo " <div class='form-group'>
                <label>Kabupaten</label>";
        echo "<select id='kabupaten' onChange='loadKecamatan()' class='form-control' name='kab'>";
        foreach ($kabupaten->result() as $k)
        {
            echo "<option value='$k->id_kabupaten'>$k->nama_kab</option>";
        }

        
        echo "</select></div>";
    }
    
    function kecamatan(){
        $kabupatenID = $_GET['id'];
        $kecamatan   = $this->db->get_where('kecamatan',array('id_kabupaten'=>$kabupatenID));
        $getkab     = $this->Laporan->get_kab($kabupatenID)->result();
        echo " <div class='form-group'>
                <label>Kecamatan</label>";
        echo "<select id='kecamatan' onChange='loadDesa()' class='form-control' name='kec'>";
        foreach ($kecamatan->result() as $k)
        {
            echo "<option value='$k->id_kecamatan'>$k->nama_kec</option>";
        }
        echo"</select></div><br>";
        
            echo"<div class='main-wrapper' id='kab_hide'>
                        <div class='card'>
                            <div class='card-body'>
                                 <table id='zero-conf' class='display' style='width:100%'>
                                    <thead>
                                        <th>Jenis</th>
                                    </thead>
                                    <tbody>";
                                    foreach ($getkab as $kab)
                                        {
                                        echo "<tr>
                                                <td>$kab->nama_kec</td>
                                            <tr>";
                                        }
                                    echo "</tbody>

                                 </table>
                            </div>
                        </div>
                </div>";
       

    }
    


    private function desa(){
        $kecamatanID  = $_GET['id'];
        $desa         = $this->db->get_where('desa',array('id_kecamatan'=>$kecamatanID));
        $getkec     = $this->Laporan->get_kec($kecamatanID)->result();
    }

    

    public function testing()
    {
        $data = $this->Laporan->total_perkab()->result();
        print_r($data);
    }




	
}
