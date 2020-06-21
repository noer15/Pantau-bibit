<?php 
class Sumbang extends CI_Model
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

	function get_wilayah($id){
        return $this->db->get_where('desa',['id_desa'=>$id]);
    }
	// total penyumbang
	public function total_sumbangan()
	{
		return $this->db
		->select_sum('jumlah')
		->get("sumbangan");
	}
    
}