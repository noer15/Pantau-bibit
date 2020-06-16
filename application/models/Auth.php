<?php

class Auth extends CI_Model {

    public function checkUser($username)
    {
        return  $this->db->where('nip', $username)
                ->get('pegawai')->row();
    }
}