<?php 
class Dashboard extends CI_Model
{
	// total penyumbang
	public function total_sumbangan()
	{
		return $this->db
		->select_sum('jumlah')
		->get("sumbangan");
	}
	public function sumbangan_perhari()
	{
		return $this->db
		->select_sum('jumlah')
		->where('date_format(date,"%Y-%m-%d")', 'CURDATE()', FALSE)
		->get("sumbangan");
	}

	public function desa_perhari()
	{
		return $this->db
		->select('COUNT(id_desa) as desa')
		->where('date_format(date,"%Y-%m-%d")', 'CURDATE()', FALSE)
		->get("sumbangan");
	}

	public function kab_perhari()
	{
		return $this->db
		->select('COUNT(id_kab) as kab')
		->where('date_format(date,"%Y-%m-%d")', 'CURDATE()', FALSE)
		->get("sumbangan");
	}

	public function get_kab()
	{
		return $this->db
		->select('COUNT(id_kab) as kab')
		->order_by('id_kab','DESC')
		->group_by('id_kab')
		->get("sumbangan");
	}


    
}

		
