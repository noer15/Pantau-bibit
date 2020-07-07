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
        echo "<select id='kabupaten' onChange='loadKecamatan()' class='form-control custom-select' name='kab'>";
        echo "<option value='0'> --Pilih Kabupaten -- </option>";
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
        echo "<select id='kecamatan' onChange='loadDesa()' class='form-control custom-select' name='kec'>";
        echo "<option value='0'> --Pilih Kecamatan--</option>";
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
        echo "<select id='wilayah' onChange='getDataDesa()' class='form-control custom-select' name='id_desa'>";
        echo "<option value='0' >--Pilih Desa --</option>";
        foreach ($desa->result() as $d)
        {
            echo "<option value='$d->id_desa' data-id='$d->id_desa'>$d->nama_desa</option>";
        }
        echo"</select></div>";
    }

    public function viewDesa()
    {
        $desaID  = $_GET['id'];
        $desa         = $this->db->get_where('sumbangan',array('id_desa'=>$desaID))->result();
        print_r($desa);

    }
    // ambil data
    private function getJenis($id_kab = null, $id_kec = null, $id_des = null){
        $jenis  = $this->db->order_by('jenis_name','ASC')->get('jenis')->result();
        $data   = array();
        foreach($jenis as $j){
            $data[] = array(
                'nama'      => $j->jenis_name,
                'jumlah'    => $this->getJumlah($id_kab,$id_kec,$id_des,$j->id_jenis)
            );
        }

        return $data;
    }

    private function getJumlah($id_kab,$id_kec,$id_des,$id_jenis){
        if(!empty($id_kab)){
            $result = array();
            $data = $this->db->get_where('sumbangan',['id_kab' => $id_kab,'id_jenis' => $id_jenis])->result();
            foreach($data as $d){
                $result[]   = array(
                    'id_jenis'  => $d->id_jenis,
                    'jumlah'    => $d->jumlah,
                );
            }
            return $result;
        }

        if(!empty($id_kec)){
            return $this->db->get_where('sumbangan',['id_kec' => $id_kab,'id_jenis' => $id_jenis])->result();
        }

        if(!empty($id_des)){
            return $this->db->get_where('sumbangan',['id_desa' => $id_kab,'id_jenis' => $id_jenis])->result();
        }

    }

    private function getTotal($id_kab,$id_kec,$id_des,$id_jenis){
        if(!empty($id_kab)){
            return $this->db->get_where('sumbangan',['id_kab' => $id_kab])->num_rows();
        }

        if(!empty($id_kec)){
            return $this->db->get_where('sumbangan',['id_kec' => $id_kab])->result();
        }

        if(!empty($id_des)){
            return $this->db->get_where('sumbangan',['id_desa' => $id_kab])->result();
        }

    }
    


    public function getProvinsi($id){
        $kab   = $this->Laporan->getKab($id)->result();
        $jenis  = $this->db->order_by('jenis_name','ASC')->get('jenis')->result();
        $response = array(); $dataJenis = array();
        if(empty($kab)){
            foreach($kab as $k){
                $response[] = array(
                    'kabupaten' => $k->nama_kab,
                    'jenis'     => 0,
                    'jumlah'    => 0,
                );
            }
        }else{

            foreach($kab as $k){
                $response[] = array(
                    'kabupaten' => $k->nama_kab,
                    'jenis'     => $this->getJenis($k->id_kabupaten,null,null,null),
                    'jumlah'    => $this->getTotal($k->id_kabupaten,null,null,null)
                );
            }

            // foreach($jenis as $jn){
            //     foreach($prov as $p){
            //         if($jn->id_jenis == $p->id_jenis){
            //             $dataJenis[] = array(
            //                 $jn->jenis_name => $p->jumlah
            //             );
            //         }else{
            //             $dataJenis[] = array(
            //                 $jn->jenis_name => 0
            //             );
            //         }
            //     }
            // }

            // foreach($kab as $k){
            //     foreach($prov as $p){
            //         if($k->id_kabupaten == $p->id_kabupaten){
            //             $response[] = array(
            //                 'kabupaten' => $k->nama_kab,
            //                 'jenis'     => $dataJenis,
            //                 'jumlah'    => $p->jumlah,
            //             );
            //         }else{
            //             $response[] = array(
            //                 'kabupaten' => $k->nama_kab,
            //                 'jenis'     => $dataJenis,
            //                 'jumlah'    => 0,
            //             );
            //         }
            //     }
            // }
        }
        // print_r($response); exit();
        echo json_encode($response);
    }

    public function getKabupaten($id){
        $kab = $this->Laporan->getByKabupaten($id)->result();
        $kec = $this->db->order_by('nama_kec','ASC')->get_where('kecamatan',['id_kabupaten' => $id])->result();
        $response = array();
        if(empty($kab)){
            foreach($kec as $k){
                $response[] = array(
                    'kecamatan' => $k->nama_kec,
                    'jenis'     => 0,
                    'jumlah'    => 0,
                );
            }
        }else{
            foreach($kec as $k){
                foreach($kab as $kb){
                    if($k->id_kecamatan == $kb->id_kec){
                        $response[] = array(
                            'kecamatan' => $k->nama_kec,
                            'jenis'     => $kb->jenis_name,
                            'jumlah'    => $kb->jumlah,
                        );
                    }else{
                        $response[] = array(
                            'kecamatan' => $k->nama_kec,
                            'jenis'     => 0,
                            'jumlah'    => 0,
                        );
                    }
                }
            }
        }
        echo json_encode($response);
    }

    public function getKecamatan($id){
        $kec = $this->Laporan->getByKecamatan($id)->result();
        $des = $this->db->order_by('nama_desa','ASC')->get_where('desa',['id_kecamatan' => $id])->result();
        $response = array();

        if(empty($kec)){
            foreach($des as $d){
                $response[] = array(
                    'desa'      => $d->nama_desa,
                    'jenis'     => 0,
                    'jumlah'    => 0,
                );
            }
        }else{
            foreach($des as $d){
                foreach($kec as $k){
                    if($d->id_desa == $k->id_desa){
                        $response[] = array(
                            'desa'      => $d->nama_desa,
                            'jenis'     => $k->jenis_name,
                            'jumlah'    => $k->jumlah,
                        );
                    }else{
                        $response[] = array(
                            'desa'      => $d->nama_desa,
                            'jenis'     => 0,
                            'jumlah'    => 0,
                        );
                    }
                }
            }
        }
        echo json_encode($response);
    }

    public function getDesa($id){
        $desa    = $this->Laporan->getByDesa($id)->result_array();
        echo json_encode($desa);
    }

    public function testing()
    {
        $data['kabupaten']          = $this->db->get('kabupaten')->result();
        $template['title']          = 'Aplikasi Pantau Bibit - Laporan';
        $template['content']        = $this->load->view('laporan/testing',$data);
        $this->render($template);
    }
}
