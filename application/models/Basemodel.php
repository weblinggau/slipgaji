<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basemodel extends CI_Model {
    

    // model untuk menampilkan data dari 2 table user dan table dosen
    public function getdosen(){
    	$this->db->select('*');
      	$this->db->from('dosen');
      	$this->db->join('user','user.id_user = dosen.id_dosen','left');      
      	$query = $this->db->get();
     	return $query;
    }

    // ini adalah fungsi untuk input data dosen
    public function addDosen($data){
    	// mengunakan metod trans karena ad 2 table yg hrus di isi dalam satu exekusi
    	$this->db->trans_start();
    		$dosen = array(
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'id_jabatan' => $data['id_jabatan'],
                'id_jenjang' => $data['id_jenjang'],
                'nip' => $data['nip'],
            );
            $this->db->insert('dosen', $dosen);
            $id_dosen = $this->db->insert_id();

            $user = array(
                'id_user' => $id_dosen,
                'username' => $data['username'],
                'password' => $data['password'],
                'role_user' => 'dosen',
            );
            $this->db->insert('user', $user);
        $this->db->trans_complete();
    	return;
    }

    public function dosenPraedit($data){
    	$this->db->select('*');
      	$this->db->from('dosen');
      	$this->db->join('user','user.id_user = dosen.id_dosen','left');
      	$this->db->where('id_dosen', $data);      
      	$query = $this->db->get();
      	return $query;
    }

    public function getjabatan(){
    	$data = $this->db->get('jabatan');
        return $data;
    }

    public function getjenjang(){
    	$data = $this->db->get('jenjang');
        return $data;
    }

}