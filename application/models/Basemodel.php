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

    public function getadmin(){
        $role = array('role_user' => 'admin', );
        $data = $this->db->get_where('user',$role);
        return $data;
    }

    public function addAdmin($data){
        $user = array(
                'id_user' => '0',
                'username' => $data['username'],
                'password' => $data['password'],
                'role_user' => 'admin',
            );
        $this->db->insert('user', $user);
        return 'sukses';
    }

    public function adminPraedit($id){
        $this->db->where('id_data', $id);
        $this->db->where('role_user', 'admin'); 
        $data = $this->db->get('user');
        return $data;
    }

    public function updateAdmin($data,$id){
        if ($data['type'] == 'pass') {
            $admin = array(
                'username' => $data['username'],
                'password' => $data['password'],
                'role_user' => 'admin',
            );
        }elseif ($data['type'] == 'nopass') {
            $admin = array(
                'username' => $data['username'],
                'role_user' => 'admin',
            );
        }
        
        $id_admin = array('id_data' => $id,);
        $this->db->where($id_admin);
        $this->db->where('role_user','admin');
        $this->db->update('user',$admin);
        return;
    }

    public function hapusAdmin($id){
        $this->db->where('id_data',$id);
        $this->db->where('role_user','admin');
        $this->db->delete('user');
        return;
    }

    public function getdosenAbsen(){
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('bulan',date('m'));
        $this->db->where('tahun',date('Y'));
        $this->db->where('type','dosen');
        $this->db->join('dosen','dosen.id_dosen = absensi.id_user','left');      
        $query = $this->db->get();
        return $query;
    }

    public function filterdosenAbsen($data){
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('bulan',$data['bulan']);
        $this->db->where('tahun',$data['tahun']);
        $this->db->where('type','dosen');
        $this->db->join('dosen','dosen.id_dosen = absensi.id_user','left');      
        $query = $this->db->get();
        return $query;
    }

    public function addDosenAbsen($data){
        $absen = array(
                'id_user' => $data['dosen'],
                'bulan' => $data['bulan'],
                'tahun' => $data['tahun'],
                'masuk' => $data['masuk'],
                'absen' => $data['absen'],
                'sakit_skd' => $data['sakit'],
                'sakit_non_skd' => $data['sakit_non_skd'],
                'izin' => $data['izin'],
                'cuti' => $data['cuti'],
                'type' => 'dosen',
            );
        $this->db->insert('absensi', $absen);
        return;
    }

    
    public function absenDosenPraedit($data){
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->join('dosen','dosen.id_dosen = absensi.id_user','left');
        $this->db->where('id_absen', $data);
        $this->db->where('type','dosen');      
        $query = $this->db->get();
        return $query;
    }

    public function upadateDosenAbsen($data,$id){
        $this->db->where($id);
        $this->db->where('type','dosen');
        $this->db->update('absensi',$data);
        return;
    }

     public function hapusDosenAbsen($id){
        $this->db->where('id_absen',$id);
        $this->db->where('type','dosen');
        $this->db->delete('absensi');
        return;
    }

    public function getstaffAbsen(){
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('bulan',date('m'));
        $this->db->where('tahun',date('Y'));
        $this->db->where('type','staff');
        $this->db->join('staff','staff.id_staff = absensi.id_user','left');      
        $query = $this->db->get();
        return $query;
    }

    public function filterstaffAbsen($data){
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('bulan',$data['bulan']);
        $this->db->where('tahun',$data['tahun']);
        $this->db->where('type','staff');
        $this->db->join('staff','staff.id_staff = absensi.id_user','left');      
        $query = $this->db->get();
        return $query;
    }

    public function addStaffAbsen($data){
        $absen = array(
                'id_user' => $data['staff'],
                'bulan' => $data['bulan'],
                'tahun' => $data['tahun'],
                'masuk' => $data['masuk'],
                'absen' => $data['absen'],
                'sakit_skd' => $data['sakit'],
                'sakit_non_skd' => $data['sakit_non_skd'],
                'izin' => $data['izin'],
                'cuti' => $data['cuti'],
                'type' => 'staff',
            );
        $this->db->insert('absensi', $absen);
        return;
    }

    public function absenStaffPraedit($data){
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->join('staff','staff.id_staff = absensi.id_user','left');
        $this->db->where('id_absen', $data);
        $this->db->where('type','staff');      
        $query = $this->db->get();
        return $query;
    }

    public function upadateStaffAbsen($data,$id){
        $this->db->where($id);
        $this->db->where('type','staff');
        $this->db->update('absensi',$data);
        return;
    }

     public function hapusStaffAbsen($id){
        $this->db->where('id_absen',$id);
        $this->db->where('type','staff');
        $this->db->delete('absensi');
        return;
    }


    public function getdosenGaji(){
        $this->db->select('*');
        $this->db->from('gaji');
        $this->db->where('bulan',date('m'));
        $this->db->where('tahun',date('Y'));
        $this->db->where('type', 'dosen');
        $this->db->join('dosen','dosen.id_dosen = gaji.id_user','left'); 
        $this->db->join('pendapatan','pendapatan.id_pendapatan = gaji.id_pendapatan','left');
        $this->db->join('potongan','potongan.id_potong = gaji.id_potongan','left');  
        $query = $this->db->get();
        return $query;
    }

    public function filterdosenGaji($data){
        $this->db->select('*');
        $this->db->from('gaji');
        $this->db->where('bulan',$data['bulan']);
        $this->db->where('tahun',$data['tahun']);
        $this->db->where('type', 'dosen');
        $this->db->join('dosen','dosen.id_dosen = gaji.id_user','left'); 
        $this->db->join('pendapatan','pendapatan.id_pendapatan = gaji.id_pendapatan','left');
        $this->db->join('potongan','potongan.id_potong = gaji.id_potongan','left');  
        $query = $this->db->get();
        return $query;
    }

    public function addDosenGaji($data,$dpat,$ptng){
        // mengunakan metod trans karena ad 2 table yg hrus di isi dalam satu exekusi
        $this->db->trans_start();
            $pndptan = array(
                'lembur' => $dpat['lembur'],
                'gapok' => $dpat['gapok'],
                'tj_jabatan' => $dpat['tj_jabatan'],
                'transport' => $dpat['transport'],
                'bonus' => $dpat['bonus'],
                'thr' => $dpat['thr'],
                'uang_makan' => $dpat['makan'],
            );

            $potongan = array (
                'cicilan_pinjaman' => $ptng['cicilan'],
                'jamsostek' => $ptng['jamsostek'],
                'pt_telat' => $ptng['telat'],
                'pt_absen' => $ptng['absen'],
                'pph21' => $ptng['pph'],
            );

            $this->db->insert('pendapatan', $pndptan);
            $id_pndptn = $this->db->insert_id();
            $this->db->insert('potongan', $potongan);
            $id_potong = $this->db->insert_id();

            $gaji = array(
                'id_user' => $data['id_user'],
                'bulan' => $data['bulan'],
                'tahun' => $data['tahun'],
                'id_pendapatan' => $id_pndptn,
                'id_potongan' => $id_potong,
                'type' => 'dosen',
            );
            $this->db->insert('gaji', $gaji);
        $this->db->trans_complete();
        return;
    }

    public function gajiDosenPraedit($id){
        $this->db->select('*');
        $this->db->from('gaji');
        $this->db->where('id_gaji', $id);
        $this->db->where('type', 'dosen');
        $this->db->join('dosen','dosen.id_dosen = gaji.id_user','left'); 
        $this->db->join('pendapatan','pendapatan.id_pendapatan = gaji.id_pendapatan','left');
        $this->db->join('potongan','potongan.id_potong = gaji.id_potongan','left');  
        $query = $this->db->get();
        return $query;
    }

    public function upadateDosenGaji($form,$id){
        
        $pndptan = array(
                'lembur' => $form['lembur'],
                'gapok' => $form['gapok'],
                'tj_jabatan' => $form['tj_jabatan'],
                'transport' => $form['transport'],
                'bonus' => $form['bonus'],
                'thr' => $form['thr'],
                'uang_makan' => $form['makan'],
            );

        $potongan = array (
                'cicilan_pinjaman' => $form['cicilan'],
                'jamsostek' => $form['jamsostek'],
                'pt_telat' => $form['telat'],
                'pt_absen' => $form['absen'],
                'pph21' => $form['pph'],
        );
        $id_pendapatan = array('id_pendapatan' => $id['iddapat']);
        $id_potong = array('id_potong' => $id['idpotong']);
        $this->db->trans_start();
            $this->db->where($id_pendapatan);
            $this->db->update('pendapatan',$pndptan);

            $this->db->where($id_potong);
            $this->db->update('potongan',$potongan);
        $this->db->trans_complete();
        return;
    }

    public function hapusDosenGaji($id){
        $this->db->trans_start();
            $this->db->where('id_gaji',$id['id_gaji']);
            $this->db->where('type','dosen');
            $this->db->delete('gaji');

            $this->db->where('id_pendapatan',$id['id_pendap']);
            $this->db->delete('pendapatan');

            $this->db->where('id_potong',$id['id_potong']);
            $this->db->delete('potongan');

            $this->db->where('id_gaji',$id['id_gaji']);
            $this->db->delete('gaji');
        $this->db->trans_complete();
    }

    public function dosenGetuser($id){
        $this->db->where('id_gaji', $id);
        $this->db->where('type', 'dosen'); 
        $data = $this->db->get('gaji');
        return $data;
    }

    public function dosenGetData($id){
        $this->db->select('*');
        $this->db->from('dosen');
        $this->db->where('id_dosen', $id);
        $this->db->join('jabatan','jabatan.id_jabatan = dosen.id_jabatan','left');
        $this->db->join('jenjang','jenjang.id_jenjang = dosen.id_jenjang','left'); 
        $data = $this->db->get();
        return $data;
    }

    public function dosenGetDataAbsen($id){
        $this->db->select('*');
        $this->db->from('dosen');
        $this->db->where('id_dosen', $id);
        $this->db->join('absensi','absensi.id_user = dosen.id_dosen','left');
        $this->db->where('type', 'dosen');
        $data = $this->db->get();
        return $data;
    }


    // =========
    public function getstaffGaji(){
        $this->db->select('*');
        $this->db->from('gaji');
        $this->db->where('bulan',date('m'));
        $this->db->where('tahun',date('Y'));
        $this->db->where('type', 'staff');
        $this->db->join('staff','staff.id_staff = gaji.id_user','left'); 
        $this->db->join('pendapatan','pendapatan.id_pendapatan = gaji.id_pendapatan','left');
        $this->db->join('potongan','potongan.id_potong = gaji.id_potongan','left');  
        $query = $this->db->get();
        return $query;
    }

    public function filterstaffGaji($data){
        $this->db->select('*');
        $this->db->from('gaji');
        $this->db->where('bulan',$data['bulan']);
        $this->db->where('tahun',$data['tahun']);
        $this->db->where('type', 'staff');
        $this->db->join('staff','staff.id_staff = gaji.id_user','left'); 
        $this->db->join('pendapatan','pendapatan.id_pendapatan = gaji.id_pendapatan','left');
        $this->db->join('potongan','potongan.id_potong = gaji.id_potongan','left');  
        $query = $this->db->get();
        return $query;
    }

    public function addStaffGaji($data,$dpat,$ptng){
        // mengunakan metod trans karena ad 2 table yg hrus di isi dalam satu exekusi
        $this->db->trans_start();
            $pndptan = array(
                'lembur' => $dpat['lembur'],
                'gapok' => $dpat['gapok'],
                'tj_jabatan' => $dpat['tj_jabatan'],
                'transport' => $dpat['transport'],
                'bonus' => $dpat['bonus'],
                'thr' => $dpat['thr'],
                'uang_makan' => $dpat['makan'],
            );

            $potongan = array (
                'cicilan_pinjaman' => $ptng['cicilan'],
                'jamsostek' => $ptng['jamsostek'],
                'pt_telat' => $ptng['telat'],
                'pt_absen' => $ptng['absen'],
                'pph21' => $ptng['pph'],
            );

            $this->db->insert('pendapatan', $pndptan);
            $id_pndptn = $this->db->insert_id();
            $this->db->insert('potongan', $potongan);
            $id_potong = $this->db->insert_id();

            $gaji = array(
                'id_user' => $data['id_user'],
                'bulan' => $data['bulan'],
                'tahun' => $data['tahun'],
                'id_pendapatan' => $id_pndptn,
                'id_potongan' => $id_potong,
                'type' => 'staff',
            );
            $this->db->insert('gaji', $gaji);
        $this->db->trans_complete();
        return;
    }

    public function gajiStaffPraedit($id){
        $this->db->select('*');
        $this->db->from('gaji');
        $this->db->where('id_gaji', $id);
        $this->db->where('type', 'staff');
        $this->db->join('staff','staff.id_staff = gaji.id_user','left'); 
        $this->db->join('pendapatan','pendapatan.id_pendapatan = gaji.id_pendapatan','left');
        $this->db->join('potongan','potongan.id_potong = gaji.id_potongan','left');  
        $query = $this->db->get();
        return $query;
    }

    public function upadateStaffGaji($form,$id){
        
        $pndptan = array(
                'lembur' => $form['lembur'],
                'gapok' => $form['gapok'],
                'tj_jabatan' => $form['tj_jabatan'],
                'transport' => $form['transport'],
                'bonus' => $form['bonus'],
                'thr' => $form['thr'],
                'uang_makan' => $form['makan'],
            );

        $potongan = array (
                'cicilan_pinjaman' => $form['cicilan'],
                'jamsostek' => $form['jamsostek'],
                'pt_telat' => $form['telat'],
                'pt_absen' => $form['absen'],
                'pph21' => $form['pph'],
        );
        $id_pendapatan = array('id_pendapatan' => $id['iddapat']);
        $id_potong = array('id_potong' => $id['idpotong']);
        $this->db->trans_start();
            $this->db->where($id_pendapatan);
            $this->db->update('pendapatan',$pndptan);

            $this->db->where($id_potong);
            $this->db->update('potongan',$potongan);
        $this->db->trans_complete();
        return;
    }

    public function hapusStaffGaji($id){
        $this->db->trans_start();
            $this->db->where('id_gaji',$id['id_gaji']);
            $this->db->where('type','staff');
            $this->db->delete('gaji');

            $this->db->where('id_pendapatan',$id['id_pendap']);
            $this->db->delete('pendapatan');

            $this->db->where('id_potong',$id['id_potong']);
            $this->db->delete('potongan');

            $this->db->where('id_gaji',$id['id_gaji']);
            $this->db->delete('gaji');
        $this->db->trans_complete();
    }

    public function staffGetuser($id){
        $this->db->where('id_gaji', $id);
        $this->db->where('type', 'staff'); 
        $data = $this->db->get('gaji');
        return $data;
    }

    public function staffGetData($id){
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('id_staff', $id);
        $this->db->join('jabatan','jabatan.id_jabatan = staff.id_jabatan','left');
        $this->db->join('jenjang','jenjang.id_jenjang = staff.id_jenjang','left'); 
        $data = $this->db->get();
        return $data;
    }

    public function staffGetDataAbsen($id){
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('id_staff', $id);
        $this->db->join('absensi','absensi.id_user = staff.id_staff','left');
        $this->db->where('type', 'staff');
        $data = $this->db->get();
        return $data;
    }

    public function addMeta($data,$var){
        if ($var == 'jabatan') {
            $meta = array(
                'nama_jabatan' => $data
            );
            $this->db->insert('jabatan', $meta);
        }elseif ($var == 'jenjang') {
             $meta = array(
                'nama_jenjang' => $data
            );
            $this->db->insert('jenjang', $meta);
        }
        return 'sukses';
    }

    public function metaPraedit($id,$var){
        if ($var == 'jabatan') {
            $this->db->where('id_jabatan', $id);
            $data = $this->db->get('jabatan');
        }elseif ($var == 'jenjang') {
            $this->db->where('id_jenjang', $id);
            $data = $this->db->get('jenjang');
        }
        return $data;
    }

    public function updateMeta($data,$id,$var){
        if ($var == 'jabatan') {
            $datas = array(
                'nama_jabatan' => $data['nama'],
            );
            $iddata = array('id_jabatan' => $id,);
            $this->db->where($iddata);
            $this->db->update('jabatan',$datas);
        }elseif ($var == 'jenjang') {
            $datas = array(
                'nama_jenjang' => $data['nama'],
            );
            $iddata = array('id_jenjang' => $id,);
            $this->db->where($iddata);
            $this->db->update('jenjang',$datas);
        }
        return;
    }

    public function hapusMeta($id,$var){
        if ($var == 'jabatan') {
            $this->db->where('id_jabatan',$id);
            $this->db->delete('jabatan');
        }elseif ($var == 'jenjang') {
            $this->db->where('id_jenjang',$id);
            $this->db->delete('jenjang');
        }
        
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

    public function valAbsen($data,$var){
        if ($var == 'dosen') {
            $this->db->where('id_user', $data['dosen']);
            $this->db->where('bulan', $data['bulan']);
            $this->db->where('tahun', $data['tahun']); 
            $this->db->where('type', 'dosen');
            $val = $this->db->get('absensi');
        }elseif ($var == 'staff') {
            $this->db->where('id_user', $data['staff']);
            $this->db->where('bulan', $data['bulan']);
            $this->db->where('tahun', $data['tahun']); 
            $this->db->where('type', 'staff');
            $val = $this->db->get('absensi');
        }
        return $val;
    }

    public function valGaji($data,$var){
        if ($var == 'dosen') {
            $this->db->where('id_user', $data['id_user']);
            $this->db->where('bulan', $data['bulan']);
            $this->db->where('tahun', $data['tahun']); 
            $this->db->where('type', 'dosen');
            $val = $this->db->get('gaji');
        }elseif ($var == 'staff') {
            $this->db->where('id_user', $data['id_user']);
            $this->db->where('bulan', $data['bulan']);
            $this->db->where('tahun', $data['tahun']); 
            $this->db->where('type', 'staff');
            $val = $this->db->get('gaji');
        }
        return $val;
    }



}