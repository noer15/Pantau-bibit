<?php 
class Laporan extends CI_Model
{
	public function get_all()
	{
		return $this->db
		->join("provinsi","provinsi.id_prov = sumbangan.id_prov")
		->join("kabupaten","kabupaten.id_kabupaten = sumbangan.id_kab")
		->join("kecamatan","kecamatan.id_kecamatan = sumbangan.id_kec")
		->join("desa","desa.id_desa = sumbangan.id_desa")
		->join("category","category.id_category = sumbangan.id_kategori")
		->join("jenis","jenis.id_jenis = sumbangan.id_jenis")
		->group_by("sumbangan.id_kab")
		->get("sumbangan");
	}

	public function total_perkab()
	{
		return $this->db->query("SELECT SUM(jumlah) AS total, sumbangan.*, pantau_bibit.kabupaten.*, pantau_bibit.jenis.*, pantau_bibit.jenis.id_jenis FROM pantau_bibit.jenis JOIN sumbangan ON pantau_bibit.jenis.id_jenis = sumbangan.id_jenis  JOIN pantau_bibit.kabupaten ON pantau_bibit.kabupaten.id_kabupaten = sumbangan.id_kab GROUP BY id_kab");
	}

	public function get_kab($kabupatenID)
	{
		return $this->db->query("SELECT * FROM pantau_bibit.kabupaten JOIN pantau_bibit.sumbangan ON pantau_bibit.kabupaten.id_kabupaten = pantau_bibit.sumbangan.id_kab  JOIN pantau_bibit.kecamatan ON pantau_bibit.kecamatan.id_kecamatan = pantau_bibit.sumbangan.id_kec  JOIN pantau_bibit.jenis ON pantau_bibit.jenis.id_jenis = pantau_bibit.sumbangan.id_jenis  WHERE id_kab = '$kabupatenID'");
	}

	public function get_kec($kecamatanID)
	{
		return $this->db->query("SELECT * FROM pantau_bibit.kabupaten JOIN pantau_bibit.sumbangan ON pantau_bibit.kabupaten.id_kabupaten = pantau_bibit.sumbangan.id_kab  JOIN pantau_bibit.kecamatan ON pantau_bibit.kecamatan.id_kecamatan = pantau_bibit.sumbangan.id_kec  JOIN pantau_bibit.jenis ON pantau_bibit.jenis.id_jenis = pantau_bibit.sumbangan.id_jenis  JOIN pantau_bibit.desa ON pantau_bibit.desa.id_desa = pantau_bibit.sumbangan.id_desa where id_kec = '$kecamatanID' ");
	}
	public function get_jenis()
	{
		return $this->db
		->join("provinsi","provinsi.id_prov = sumbangan.id_prov")
		->join("kabupaten","kabupaten.id_kabupaten = sumbangan.id_kab")
		->join("kecamatan","kecamatan.id_kecamatan = sumbangan.id_kec")
		->join("desa","desa.id_desa = sumbangan.id_desa")
		->join("category","category.id_category = sumbangan.id_kategori")
		->join("jenis","jenis.id_jenis = sumbangan.id_jenis")
		->group_by("jenis.id_jenis")
		->get("sumbangan");
	}
	
	public function input_data($data,$table){
		$this->db->insert($table,$data);
	}

	public function delete($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function edit_data($where,$table){	
    	return $this->db
		->join("provinsi","provinsi.id_prov = sumbangan.id_prov")
		->join("kabupaten","kabupaten.id_kabupaten = sumbangan.id_kab")
		->join("kecamatan","kecamatan.id_kecamatan = sumbangan.id_kec")
		->join("desa","desa.id_desa = sumbangan.id_desa")
		->join("category","category.id_category = sumbangan.id_kategori")
		->join("jenis","jenis.id_jenis = sumbangan.id_jenis")
		->get_where($table,$where);
	}

	public function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}


	// total penyumbang
	public function total_sumbangan()
	{
		return $this->db
		->select_sum('jumlah')
		->get("sumbangan");
	}
    
}