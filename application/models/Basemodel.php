<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basemodel extends CI_Model {
    

    // model untuk menampilkan data dari 2 table user dan table dosen
    public function getdosen(){
    	$this->db->select('*');
      	$this->db->from('dosen');
        $this->db->where('role_user','dosen');
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
        $this->db->join('jabatan','jabatan.id_jabatan = dosen.id_jabatan','left');
        $this->db->join('jenjang','jenjang.id_jenjang = dosen.id_jenjang','left');
      	$this->db->where('id_dosen', $data);
        $this->db->where('role_user','dosen');      
      	$query = $this->db->get();
      	return $query;
    }

    public function updateDosen($data,$id){
        $this->db->trans_start();
            $dosen = array(
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'id_jabatan' => $data['id_jabatan'],
                'id_jenjang' => $data['id_jenjang'],
                'nip' => $data['nip'],
            );
            $id_dosen = array('id_dosen' => $id,);
            $this->db->where($id_dosen);
            $this->db->update('dosen',$dosen);

            if ($data['type'] == 'pass') {
                $user = array(
                'password' => $data['password']
                );
                $id_user = array('id_user' => $id,);
                $this->db->where($id_user);
                $this->db->where('role_user','dosen');
                $this->db->update('user',$user);
            }elseif ($data['type'] == 'nopass') {
                
            }
        $this->db->trans_complete();
        return;
    }

    public function hapusDosen($id){
            $this->db->where('id_dosen',$id);
            $this->db->delete('dosen');

            $this->db->where('id_user',$id);
            $this->db->where('role_user','dosen');
            $this->db->delete('user');
        return;
    }

    // module untuk menu dosen
    public function getstaff(){
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('role_user','staff');
        $this->db->join('user','user.id_user = staff.id_staff','left');      
        $query = $this->db->get();
        return $query;
    }

    public function addStaff($data){
        // mengunakan metod trans karena ad 2 table yg hrus di isi dalam satu exekusi
        $this->db->trans_start();
            $staff = array(
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'id_jabatan' => $data['id_jabatan'],
                'id_jenjang' => $data['id_jenjang'],
                'nip' => $data['nip'],
            );
            $this->db->insert('staff', $staff);
            $id_staff = $this->db->insert_id();

            $user = array(
                'id_user' => $id_staff,
                'username' => $data['username'],
                'password' => $data['password'],
                'role_user' => 'staff',
            );
            $this->db->insert('user', $user);
        $this->db->trans_complete();
        return;
    }

    public function staffPraedit($data){
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->join('user','user.id_user = staff.id_staff','left');
        $this->db->join('jabatan','jabatan.id_jabatan = staff.id_jabatan','left');
        $this->db->join('jenjang','jenjang.id_jenjang = staff.id_jenjang','left');
        $this->db->where('id_staff', $data);
        $this->db->where('role_user','staff');      
        $query = $this->db->get();
        return $query;
    }

    public function updateStaff($data,$id){
        $this->db->trans_start();
            $staff = array(
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'id_jabatan' => $data['id_jabatan'],
                'id_jenjang' => $data['id_jenjang'],
                'nip' => $data['nip'],
            );
            $id_staff = array('id_staff' => $id,);
            $this->db->where($id_staff);
            $this->db->update('staff',$staff);

            if ($data['type'] == 'pass') {
                $user = array(
                'password' => $data['password']
                );
                $id_user = array('id_user' => $id,);
                $this->db->where($id_user);
                $this->db->where('role_user','staff');
                $this->db->update('user',$user);
            }elseif ($data['type'] == 'nopass') {
                
            }
        $this->db->trans_complete();
        return;
    }

    public function hapusStaff($id){
            $this->db->where('id_staff',$id);
            $this->db->delete('staff');

            $this->db->where('id_user',$id);
            $this->db->where('role_user','staff');
            $this->db->delete('user');
        return;
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