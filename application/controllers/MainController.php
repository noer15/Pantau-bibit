<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Dashboard');
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
        $data['lokasi']             = $this->Sumbang->get_all()->result();
        $data['penyumbang']         = $this->Dashboard->penyumbang()->row();
        $data['desa_perhari']       = $this->Dashboard->desa_perhari()->row();
        $data['kab_perhari']        = $this->Dashboard->kab_perhari()->row();
        $data['perhari_sumbangan']  = $this->Dashboard->sumbangan_perhari()->row();
        $data['total_sumbangan']    = $this->Dashboard->total_sumbangan()->row();
        $template['title']          = 'Aplikasi Pantau Bibit - Dashboard';
        $template['content']        = $this->load->view('dashboard/index',$data);
		$this->render($template);
    }

   public function testing()
   {
        $testing = $this->db->query("SELECT COUNT(id_kab) as tes FROM sumbangan GROUP BY id_kab")->num_rows();
        print_r($testing);
   }

	
}
