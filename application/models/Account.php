<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account extends CI_Model
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

    public function update_data($update){
		return $this->db->where('id', $update['id'])
                        ->update('pegawai', $update);
	}	
}