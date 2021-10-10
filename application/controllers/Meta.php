<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meta extends CI_Controller 
{
    public function __construct(){
        parent::__construct();

        $this->load->model('Basemodel');
        
    }

    public function Jabatan(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $data['route'] = 'jabatan';
            $data['dsl'] = $this->Basemodel->getjabatan()->result();
            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('meta/index',$data);
            $this->load->view('templates/panel_footer');
        }
    }

    public function Jenjang(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $data['route'] = 'jenjang';
            $data['dsl'] = $this->Basemodel->getjenjang()->result();
            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('meta/index',$data);
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
            $tipe = htmlspecialchars($this->input->post('type',true));
            if ($tipe == 'jabatan') {
                $form = htmlspecialchars($this->input->post('nama',true));
                $this->Basemodel->addMeta($form,'jabatan');
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambhkan.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('meta/jabatan');
            }elseif ($tipe == 'jenjang') {
                $form= htmlspecialchars($this->input->post('nama',true));
                $this->Basemodel->addMeta($form,'jenjang');
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambhkan.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('meta/jenjang');
            }
            
        }
        
    }

    public function praEdit(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');

        // jika login maka akan meng eksekusi printah add ke database
        }else{
            $tipe = htmlspecialchars($this->input->post('tipe',true));
            $id = htmlspecialchars($this->input->post('iddata',true));
            if ($tipe == 'jabatan') {
                $dataedit = $this->Basemodel->metaPraedit($id,'jabatan')->row();
                echo '
                <div class="form-group">
                      <input type="hidden" name="tipe" value="jabatan">
                      <label>Nama jabatan</label>
                      <input type="hidden" name="iddata" value="'.$dataedit->id_jabatan.'">
                      <input type="text" class="form-control"  name="nama" value="'.$dataedit->nama_jabatan.'">
                    </div>';
            }elseif ($tipe == 'jenjang') {
                $dataedit = $this->Basemodel->metaPraedit($id,'jenjang')->row();
                echo '
                <div class="form-group">
                      <input type="hidden" name="tipe" value="jenjang">
                      <label>Nama Jenjang</label>
                      <input type="hidden" name="iddata" value="'.$dataedit->id_jenjang.'">
                      <input type="text" class="form-control"  name="nama" value="'.$dataedit->nama_jenjang.'">
                    </div>';
            }
        }
    }

    public function update(){
      // password_hash($this->input->post('pass'), PASSWORD_DEFAULT)
        // ini adalah fungsi untuk cek apkah yg menggunakan fungsi ini login atau tida
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');

        // jika login maka akan meng eksekusi printah add ke database
        }else{
            $tipe = htmlspecialchars($this->input->post('tipe',true));
            $form['nama'] = htmlspecialchars($this->input->post('nama',true));
            $id = htmlspecialchars($this->input->post('iddata',true));
            if ($tipe == 'jabatan') {
                $this->Basemodel->updateMeta($form,$id,'jabatan');
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dirubah.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('meta/jabatan');
            }elseif ($tipe == 'jenjang') {
                $this->Basemodel->updateMeta($form,$id,'jenjang');
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dirubah.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('meta/jenjang');
            }
        }
    }

    public function hapus($a,$var){
      if ($this->session->userdata('login') != 'zpmlogin') {
        redirect('Auth');
      }else{
        $iddata = $a;
        if ($var == 'jabatan') {
            $this->Basemodel->hapusMeta($iddata,'jabatan');
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data berhasil dihapus.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('meta/jabatan');
        }elseif ($var == 'jenjang') {
            $this->Basemodel->hapusMeta($iddata,'jenjang');
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data berhasil dihapus.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('meta/jenjang');
        }
        
      }
    }


}
