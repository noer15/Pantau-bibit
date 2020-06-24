<?php 
class Dashboard extends CI_Model
{
	public function get_all()
	{
		return $this->db
		->join("kabupaten","kabupaten.id_kabupaten = sumbangan.id_kab")
		->join("kecamatan","kecamatan.id_kecamatan = sumbangan.id_kec")
		->join("desa","desa.id_desa = sumbangan.id_desa")
		->join("category","category.id_category = sumbangan.id_kategori")
		->join("jenis","jenis.id_jenis = sumbangan.id_jenis")
		->group_by("jenis_name")
		->get("sumbangan");
	}

	public function get_jenis_sum()
	{
		return $this->db
		->select_sum("jumlah")
		->group_by("id_jenis")
		->get("sumbangan");
	}

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

	public function penyumbang()
	{
		return $this->db
		->select('COUNT(nama_penyumbang) as penyumbang')
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
		->group_by('id_kab')
		->get("sumbangan");
	}


    
}

		
