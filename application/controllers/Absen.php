<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller 
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

    public function Dosen($get='')
    {

        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $data['bulans'] = array(
                 'Januari' => '01',
                  'Februari' => '02',
                 'Maret' => '03',
                  'April' => '04',
                 'Mei' => '05',
                 'Juni' => '06',
                  'Juli' => '07',
                  'Agustus' => '08',
                  'September' => '09',
                  'Oktober' => '10',
                  'November' => '11',
                  'Desember' => '12',
            ); 
            $data['dosen'] = $this->Basemodel->getdosen()->result();
            if ($_SERVER['REQUEST_METHOD']=="POST") {
                // kosong
                // mode filter
                $form['bulan'] = htmlspecialchars($this->input->post('bulan',true));
                $form['tahun'] = htmlspecialchars($this->input->post('tahun',true));
                $data['bulan'] = htmlspecialchars($this->input->post('bulan',true));
                $data['tahun'] = htmlspecialchars($this->input->post('tahun',true));
                $data['absen'] = $this->Basemodel->filterdosenAbsen($form)->result();
                
            }else{
                $data['bulan'] = date('m');
                $data['tahun'] = date('Y');
                $data['absen'] = $this->Basemodel->getdosenAbsen()->result();
            }
            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('absen/dosen',$data);
            $this->load->view('templates/panel_footer');
        }
        
    }

    public function adddosen(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{

            $form['dosen'] = htmlspecialchars($this->input->post('dosen',true));
            $form['bulan'] = htmlspecialchars($this->input->post('bulan',true));
            $form['tahun'] = htmlspecialchars($this->input->post('tahun',true));
            $form['masuk'] = htmlspecialchars($this->input->post('masuk',true));
            $form['absen'] = htmlspecialchars($this->input->post('absen',true));
            $form['sakit'] = htmlspecialchars($this->input->post('sakit',true));
            $form['sakit_non_skd'] = htmlspecialchars($this->input->post('stskd',true));
            $form['izin'] = htmlspecialchars($this->input->post('izin',true));
            $form['cuti'] = htmlspecialchars($this->input->post('cuti',true));

            $valid = count($this->Basemodel->valAbsen($form,'dosen')->result());

            if ($valid > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Sudah Ada Di Periode Ini.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('absen/dosen');
            }else {
                $this->Basemodel->addDosenAbsen($form);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambhkan.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('absen/dosen');
            }
            
        }
    }

    public function dosenpraedit(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');

        // jika login maka akan meng eksekusi printah add ke database
        }else{
            $id_absen= htmlspecialchars($this->input->post('idabsen',true));
            $dataedit = $this->Basemodel->absenDosenPraedit($id_absen)->row();
            $bulans = array(
                 'Januari' => '01',
                  'Februari' => '02',
                 'Maret' => '03',
                  'April' => '04',
                 'Mei' => '05',
                 'Juni' => '06',
                  'Juli' => '07',
                  'Agustus' => '08',
                  'September' => '09',
                  'Oktober' => '10',
                  'November' => '11',
                  'Desember' => '12',
            ); 
            $periode = array_search($dataedit->bulan,$bulans);
            echo '
            <div class="form-group">
                  <label>Nama Dosen</label>
                  <input type="hidden" name="idabsen" value="'.$dataedit->id_absen.'">
                  <input type="text" class="form-control"  name="dosen" value="'.$dataedit->nama.'" readonly>
                </div>
                <div class="form-group row g-3">
                  <div class="col-md-6">
                    <label>Periode Bulan</label>
                    <input type="text" class="form-control"  name="bulan" value="'.$periode.'" readonly>
                  </div>
                  <div class="col-md-6">
                    <label>tahun</label>
                  <input type="number" class="form-control"  name="tahun" value="'.$dataedit->tahun.'" readonly>
                  </div>
                </div><br>
                <p>Input Jumlah Absen 1 Bulan</p>
                <div class="form-group row g-3">
                  <div class="col-md-4">
                    <label>Masuk</label>
                    <input type="number" class="form-control"  name="masuk" value="'.$dataedit->masuk.'">
                  </div>
                  <div class="col-md-4">
                    <label>Absen</label>
                    <input type="number" class="form-control" value="'.$dataedit->absen.'"  name="absen">
                  </div>
                  <div class="col-md-4">
                    <label>Sakit</label>
                    <input type="number" class="form-control"  name="sakit" value="'.$dataedit->sakit_skd.'">
                  </div>
                  <div class="col-md-4">
                    <label>Sakit Non SKD</label>
                    <input type="number" class="form-control"  name="stskd" value="'.$dataedit->sakit_non_skd.'">
                  </div>
                  <div class="col-md-4">
                    <label>Izin</label>
                    <input type="number" class="form-control"  name="izin" value="'.$dataedit->izin.'">
                  </div>
                  <div class="col-md-4">
                    <label>Cuti</label>
                    <input type="number" class="form-control"  name="cuti" value="'.$dataedit->cuti.'">
                  </div>
                </div>

            ';


        }
    }

    public function updatedosen(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $form['masuk'] = htmlspecialchars($this->input->post('masuk',true));
            $form['absen'] = htmlspecialchars($this->input->post('absen',true));
            $form['sakit_skd'] = htmlspecialchars($this->input->post('sakit',true));
            $form['sakit_non_skd'] = htmlspecialchars($this->input->post('stskd',true));
            $form['izin'] = htmlspecialchars($this->input->post('izin',true));
            $form['cuti'] = htmlspecialchars($this->input->post('cuti',true));
            $id = array(
                'id_absen' => htmlspecialchars($this->input->post('idabsen',true)),
                 );
            
            $this->Basemodel->upadateDosenAbsen($form,$id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dirubah.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('absen/dosen');
            
        }
    }

    public function hapusDosen($id){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $this->Basemodel->hapusDosenAbsen($id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data berhasil dirubah.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('absen/dosen');
        }
    }

    public function Staff($get='')
    {

        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $data['bulans'] = array(
                 'Januari' => '01',
                  'Februari' => '02',
                 'Maret' => '03',
                  'April' => '04',
                 'Mei' => '05',
                 'Juni' => '06',
                  'Juli' => '07',
                  'Agustus' => '08',
                  'September' => '09',
                  'Oktober' => '10',
                  'November' => '11',
                  'Desember' => '12',
            ); 
            $data['staff'] = $this->Basemodel->getstaff()->result();
            if ($_SERVER['REQUEST_METHOD']=="POST") {
                // kosong
                // mode filter
                $form['bulan'] = htmlspecialchars($this->input->post('bulan',true));
                $form['tahun'] = htmlspecialchars($this->input->post('tahun',true));
                $data['bulan'] = htmlspecialchars($this->input->post('bulan',true));
                $data['tahun'] = htmlspecialchars($this->input->post('tahun',true));
                $data['absen'] = $this->Basemodel->filterstaffAbsen($form)->result();
                
            }else{
                $data['bulan'] = date('m');
                $data['tahun'] = date('Y');
                $data['absen'] = $this->Basemodel->getstaffAbsen()->result();
            }
            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('absen/staff',$data);
            $this->load->view('templates/panel_footer');
        }
        
    }

    public function addstaff(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{

            $form['staff'] = htmlspecialchars($this->input->post('staff',true));
            $form['bulan'] = htmlspecialchars($this->input->post('bulan',true));
            $form['tahun'] = htmlspecialchars($this->input->post('tahun',true));
            $form['masuk'] = htmlspecialchars($this->input->post('masuk',true));
            $form['absen'] = htmlspecialchars($this->input->post('absen',true));
            $form['sakit'] = htmlspecialchars($this->input->post('sakit',true));
            $form['sakit_non_skd'] = htmlspecialchars($this->input->post('stskd',true));
            $form['izin'] = htmlspecialchars($this->input->post('izin',true));
            $form['cuti'] = htmlspecialchars($this->input->post('cuti',true));

            $valid = count($this->Basemodel->valAbsen($form,'staff')->result());

            if ($valid > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Sudah Ada Di Periode Ini.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('absen/staff');
            }else {
                $this->Basemodel->addStaffAbsen($form);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambhkan.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('absen/staff');
            }
            
        }
    }

    public function staffpraedit(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');

        // jika login maka akan meng eksekusi printah add ke database
        }else{
            $id_absen= htmlspecialchars($this->input->post('idstaff',true));
            $dataedit = $this->Basemodel->absenStaffPraedit($id_absen)->row();
            $bulans = array(
                 'Januari' => '01',
                  'Februari' => '02',
                 'Maret' => '03',
                  'April' => '04',
                 'Mei' => '05',
                 'Juni' => '06',
                  'Juli' => '07',
                  'Agustus' => '08',
                  'September' => '09',
                  'Oktober' => '10',
                  'November' => '11',
                  'Desember' => '12',
            ); 
            $periode = array_search($dataedit->bulan,$bulans);
            echo '
            <div class="form-group">
                  <label>Nama Dosen</label>
                  <input type="hidden" name="idabsen" value="'.$dataedit->id_absen.'">
                  <input type="text" class="form-control"  name="staff" value="'.$dataedit->nama.'" readonly>
                </div>
                <div class="form-group row g-3">
                  <div class="col-md-6">
                    <label>Periode Bulan</label>
                    <input type="text" class="form-control"  name="bulan" value="'.$periode.'" readonly>
                  </div>
                  <div class="col-md-6">
                    <label>tahun</label>
                  <input type="number" class="form-control"  name="tahun" value="'.$dataedit->tahun.'" readonly>
                  </div>
                </div><br>
                <p>Input Jumlah Absen 1 Bulan</p>
                <div class="form-group row g-3">
                  <div class="col-md-4">
                    <label>Masuk</label>
                    <input type="number" class="form-control"  name="masuk" value="'.$dataedit->masuk.'">
                  </div>
                  <div class="col-md-4">
                    <label>Absen</label>
                    <input type="number" class="form-control" value="'.$dataedit->absen.'"  name="absen">
                  </div>
                  <div class="col-md-4">
                    <label>Sakit</label>
                    <input type="number" class="form-control"  name="sakit" value="'.$dataedit->sakit_skd.'">
                  </div>
                  <div class="col-md-4">
                    <label>Sakit Non SKD</label>
                    <input type="number" class="form-control"  name="stskd" value="'.$dataedit->sakit_non_skd.'">
                  </div>
                  <div class="col-md-4">
                    <label>Izin</label>
                    <input type="number" class="form-control"  name="izin" value="'.$dataedit->izin.'">
                  </div>
                  <div class="col-md-4">
                    <label>Cuti</label>
                    <input type="number" class="form-control"  name="cuti" value="'.$dataedit->cuti.'">
                  </div>
                </div>

            ';


        }
    }

    public function updatestaff(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $form['masuk'] = htmlspecialchars($this->input->post('masuk',true));
            $form['absen'] = htmlspecialchars($this->input->post('absen',true));
            $form['sakit_skd'] = htmlspecialchars($this->input->post('sakit',true));
            $form['sakit_non_skd'] = htmlspecialchars($this->input->post('stskd',true));
            $form['izin'] = htmlspecialchars($this->input->post('izin',true));
            $form['cuti'] = htmlspecialchars($this->input->post('cuti',true));
            $id = array(
                'id_absen' => htmlspecialchars($this->input->post('idabsen',true)),
                 );
            
            $this->Basemodel->upadateStaffAbsen($form,$id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dirubah.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('absen/staff');
            
        }
    }

    public function hapusStaff($id){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $this->Basemodel->hapusStaffAbsen($id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data berhasil dirubah.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('absen/staff');
        }
    }

    


}
