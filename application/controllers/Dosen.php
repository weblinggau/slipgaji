<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller 
{
	public function __construct(){
		parent::__construct();

		$this->load->model('Basemodel');
        
	}

    public function Tambah()
    {

    	if ($this->session->userdata('login') != 'zpmlogin') {
    		redirect('Auth');
    	}else{
    		$this->load->view('templates/panel_header');
		    $this->load->view('templates/panel_menu');
		    // $this->load->view('home/index');
		    $this->load->view('templates/panel_footer');
    	}
    	
    }

    public function add()
    {
        // password_hash($this->input->post('pass'), PASSWORD_DEFAULT)
        // ini adalah fungsi untuk cek apkah yg menggunakan fungsi ini login atau tida
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');

        // jika login maka akan meng eksekusi printah add ke database
        }else{
            $form['username'] = htmlspecialchars($this->input->post('username',true));
            $form['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $form['nama'] = htmlspecialchars($this->input->post('nama',true));
            $form['nip'] = htmlspecialchars($this->input->post('nip',true));
            $form['alamat'] = htmlspecialchars($this->input->post('alamat',true));
            $form['jenis_kelamin'] = htmlspecialchars($this->input->post('jk',true));
            $form['id_jabatan'] = htmlspecialchars($this->input->post('jabatan',true));
            $form['id_jenjang'] = htmlspecialchars($this->input->post('jenjang',true));

            $this->Basemodel->addDosen($form);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambhkan.!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('panel/dosen');
        }
        
    }

    public function praEdit(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');

        // jika login maka akan meng eksekusi printah add ke database
        }else{
            $id_dosen= htmlspecialchars($this->input->post('dosenid',true));
            $dataedit = $this->Basemodel->dosenPraedit($id_dosen)->row();
            $jabatan = $this->Basemodel->getjabatan()->result();
            $data['jenjang'] = $this->Basemodel->getjenjang()->result();


            echo '
            <div class="form-group">
                  <input type="hidden" name="jenis" value="dosen">
                  <label>Username</label>
                  <input type="text" class="form-control"  name="username" readonly value="'.$dataedit->username.'">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control"  name="nama"value="'.$dataedit->nama.'">
                </div>
                 <div class="form-group">
                  <label>Nip</label>
                  <input type="text" class="form-control"  name="nip" value="'.$dataedit->nip.'">
                </div>
                 <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control">'.$dataedit->alamat.'</textarea>
                </div>
                 <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select class="form-control" name="jk">';
                    if ($dataedit->jenis_kelamin == 'laki-laki') {
                        echo '
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                        ';
                    }else{
                        echo '
                        <option value="perempuan">Perempuan</option>
                        <option value="laki-laki">Laki-Laki</option>
                        ';
                    }
                echo '
                  </select>
                </div>
                <div class="form-group">
                  <label>Jabatan</label>
                  <select class="form-control" name="jabatan">
                  <option value="'.$dataedit->id_jabatan.'">'.$dataedit->nama_jabatan.'</option>';                 
                    foreach ($jabatan as $jab) {
                        echo'
                    <option value="'.$jab->id_jabatan.'">'.$jab->nama_jabatan.'</option>';
                    };
                echo '
                  </select>
                </div>
                <div class="form-group">
                  <label>Jenjang</label>
                  <select class="form-control" name="jenjang" required>
                    <option selected>Open this select menu</option>
                    <?php foreach ($jenjang as $jej) {
                      
                    ?>
                    <option value="<?= $jej->id_jenjang; ?>"><?= $jej->nama_jenjang; ?></option>
                    <?php } ?>
                  </select>
                </div>
            ';

        }
    }


}
