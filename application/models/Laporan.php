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
		return $this->db->query("SELECT SUM(jumlah) AS total, sumbangan.*, pantaubibit.kabupaten.*, pantaubibit.jenis.*, pantaubibit.jenis.id_jenis FROM pantaubibit.jenis JOIN sumbangan ON pantaubibit.jenis.id_jenis = sumbangan.id_jenis  JOIN pantaubibit.kabupaten ON pantaubibit.kabupaten.id_kabupaten = sumbangan.id_kab GROUP BY id_kab");
	}

	public function get_kab($kabupatenID)
	{
		return $this->db->query("SELECT * FROM pantaubibit.kabupaten JOIN pantaubibit.sumbangan ON pantaubibit.kabupaten.id_kabupaten = pantaubibit.sumbangan.id_kab  JOIN pantaubibit.kecamatan ON pantaubibit.kecamatan.id_kecamatan = pantaubibit.sumbangan.id_kec  JOIN pantaubibit.jenis ON pantaubibit.jenis.id_jenis = pantaubibit.sumbangan.id_jenis  WHERE id_kab = '$kabupatenID'");
	}

	public function get_kec($kecamatanID)
	{
		return $this->db->query("SELECT * FROM pantaubibit.kabupaten JOIN pantaubibit.sumbangan ON pantaubibit.kabupaten.id_kabupaten = pantaubibit.sumbangan.id_kab  JOIN pantaubibit.kecamatan ON pantaubibit.kecamatan.id_kecamatan = pantaubibit.sumbangan.id_kec  JOIN pantaubibit.jenis ON pantaubibit.jenis.id_jenis = pantaubibit.sumbangan.id_jenis  JOIN pantaubibit.desa ON pantaubibit.desa.id_desa = pantaubibit.sumbangan.id_desa where id_kec = '$kecamatanID' ");
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

	//Data perwilayah
	public function getProv($id)
	{
		return $this->db
		->join('kabupaten','kabupaten.id_kabupaten=sumbangan.id_kab')
		// ->join('jenis','jenis.id_jenis=sumbangan.id_jenis')
		->where('kabupaten.id_prov', $id)
		->get('sumbangan');
	}

	public function getKab($id)
	{
		return $this->db
		->where('id_prov',$id)
		->order_by('nama_kab','ASC')
		->get('kabupaten');
	}
	
	public function getByKabupaten($id)
	{
		return $this->db
		// ->join('kabupaten','kabupaten.id_kabupaten=sumbangan.id_kab')
		->join('kecamatan','kecamatan.id_kecamatan=sumbangan.id_kec')
		->join('jenis','jenis.id_jenis=sumbangan.id_jenis')
		->where('sumbangan.id_kab', $id)
		->get('sumbangan');
	}

	public function getByKecamatan($id)
	{
		return $this->db
		// ->join('kecamatan','kecamatan.id_kecamatan=sumbangan.id_kec')
		->join('desa','desa.id_desa=sumbangan.id_desa')
		->join('jenis','jenis.id_jenis=sumbangan.id_jenis')
		->where('sumbangan.id_kec', $id)
		->get('sumbangan');
	}

	public function getByDesa($id)
	{
		return $this->db
		->join('desa','desa.id_desa=sumbangan.id_desa')
		->join('jenis','jenis.id_jenis=sumbangan.id_jenis')
		->where('desa.id_desa', $id)
		->get('sumbangan');
	}
    
}