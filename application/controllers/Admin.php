<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function __construct(){
        parent::__construct();

        $this->load->model('Basemodel');
        
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
            $this->Basemodel->addAdmin($form);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambhkan.!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('panel/admin');
        }
        
    }

    public function praEdit(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');

        // jika login maka akan meng eksekusi printah add ke database
        }else{
            $id_admin= htmlspecialchars($this->input->post('iddata',true));
            $dataedit = $this->Basemodel->adminPraedit($id_admin)->row();
            echo '
            <div class="form-group">
                  <input type="hidden" name="jenis" value="admin">
                  <label>Username</label>
                  <input type="hidden" name="id_admin" value="'.$dataedit->id_data.'">
                  <input type="text" class="form-control"  name="username" value="'.$dataedit->username.'">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password">
                </div>';
                

        }
    }

    public function update(){
      // password_hash($this->input->post('pass'), PASSWORD_DEFAULT)
        // ini adalah fungsi untuk cek apkah yg menggunakan fungsi ini login atau tida
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');

        // jika login maka akan meng eksekusi printah add ke database
        }else{
            $form['username'] = htmlspecialchars($this->input->post('username',true));
            $pass = $this->input->post('password');
            if (empty($pass)) {
              $form['type'] = 'nopass';
            }else{
              $form['type'] = 'pass';
              $form['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $id_admin = htmlspecialchars($this->input->post('id_admin',true));

            $this->Basemodel->updateAdmin($form,$id_admin);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dirubah.!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('panel/admin');
        }
    }

    public function hapus($a){
      if ($this->session->userdata('login') != 'zpmlogin') {
        redirect('Auth');
      }else{
        $id_admin = $a;
        $this->Basemodel->hapusAdmin($id_admin);
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data berhasil dihapus.!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('panel/admin');
      }
    }


}
