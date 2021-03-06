<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jenis extends CI_Model
{
	
	public function input_data($data,$table){
		$this->db->insert($table,$data);
	}

	public function delete($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function edit_data($where,$table){		
		return $this->db->get_where($table,$where);
	}

    public function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function get_by_id($id){
        return $this->db->where('id_jenis',$id)
                        ->get('jenis');
    }

    public function update($customer){
        return $this->db->where("id_jenis", $customer["id_jenis"])
                        ->update("jenis", $customer);
    }
}