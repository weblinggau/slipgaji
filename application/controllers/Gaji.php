<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller 
{
	public function __construct(){
		parent::__construct();

		$this->load->model('Basemodel');
        
	}

    public function Dosen()
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
                $data['gaji'] = $this->Basemodel->filterdosenGaji($form)->result();
                
            }else{
                $data['bulan'] = date('m');
                $data['tahun'] = date('Y');
                $data['gaji'] = $this->Basemodel->getdosenGaji()->result();
            }
    
            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('gaji/dosen',$data);
            $this->load->view('templates/panel_footer');
        }
        
    }

    public function addDosen(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{

            $form['id_user'] = htmlspecialchars($this->input->post('dosen',true));
            $form['bulan'] = htmlspecialchars($this->input->post('bulan',true));
            $form['tahun'] = htmlspecialchars($this->input->post('tahun',true));
            $pdtpan['gapok'] = htmlspecialchars($this->input->post('gapok',true));
            $pdtpan['tj_jabatan'] = htmlspecialchars($this->input->post('tj_jabatan',true));
            $pdtpan['makan'] = htmlspecialchars($this->input->post('makan',true));
            $pdtpan['transport'] = htmlspecialchars($this->input->post('transport',true));
            $pdtpan['bonus'] = htmlspecialchars($this->input->post('bonus',true));
            $pdtpan['thr'] = htmlspecialchars($this->input->post('thr',true));
            $pdtpan['lembur'] = htmlspecialchars($this->input->post('lembur',true));

            $ptongan['cicilan'] = htmlspecialchars($this->input->post('cicilan',true));
            $ptongan['jamsostek'] = htmlspecialchars($this->input->post('jamsostek',true));
            $ptongan['telat'] = htmlspecialchars($this->input->post('telat',true));
            $ptongan['absen'] = htmlspecialchars($this->input->post('absen',true));
            $ptongan['pph'] = htmlspecialchars($this->input->post('pph',true));

            
            $valid = count($this->Basemodel->valGaji($form,'dosen')->result());

            if ($valid > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Sudah Ada Di Periode Ini.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('gaji/dosen');
            }else {
                $this->Basemodel->addDosenGaji($form,$pdtpan,$ptongan);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambhkan.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('gaji/dosen');
            }
            
        }
    }

    public function dosenpraedit(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');

        // jika login maka akan meng eksekusi printah add ke database
        }else{
            $id_gaji= htmlspecialchars($this->input->post('idgaji',true));
            $dataedit = $this->Basemodel->gajiDosenPraedit($id_gaji)->row();
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
                  <input type="hidden" name="idgaji" value="'.$dataedit->id_gaji.'">
                  <input type="hidden" name="iddapat" value="'.$dataedit->id_pendapatan.'">
                  <input type="hidden" name="idpotong" value="'.$dataedit->id_potong.'">
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
                <p>Input Pendapatan Gaji</p>
                <div class="form-group row g-3">
                  <div class="col-md-4">
                    <label>Gaji Pokok</label>
                    <input type="number" class="form-control"  name="gapok" value="'.$dataedit->gapok.'">
                  </div>
                  <div class="col-md-4">
                    <label>Tunjangan Jabatan</label>
                    <input type="number" class="form-control"  name="tj_jabatan" value="'.$dataedit->tj_jabatan.'">
                  </div>
                  <div class="col-md-4">
                    <label>Uang Makan</label>
                    <input type="number" class="form-control"  name="makan" value="'.$dataedit->uang_makan.'">
                  </div>
                  <div class="col-md-4">
                    <label>Transportasi</label>
                    <input type="number" class="form-control"  name="transport" value="'.$dataedit->transport.'">
                  </div>
                  <div class="col-md-4">
                    <label>Bonus</label>
                    <input type="number" class="form-control"  name="bonus" value="'.$dataedit->bonus.'">
                  </div>
                  <div class="col-md-4">
                    <label>THR</label>
                    <input type="number" class="form-control"  name="thr" value="'.$dataedit->thr.'">
                  </div>
                  <div class="col-md-4">
                    <label>Lembur</label>
                    <input type="number" class="form-control"  name="lembur" value="'.$dataedit->lembur.'">
                  </div>
                </div><br>
                <p>Input Potongan Gaji</p>
                <div class="form-group row g-3">
                  <div class="col-md-4">
                    <label>Cicilan Pinjaman</label>
                    <input type="number" class="form-control"  name="cicilan" value="'.$dataedit->cicilan_pinjaman.'">
                  </div>
                  <div class="col-md-4">
                    <label>Jamsostek</label>
                    <input type="number" class="form-control"  name="jamsostek" value="'.$dataedit->jamsostek.'">
                  </div>
                  <div class="col-md-4">
                    <label>Potongan Telat</label>
                    <input type="number" class="form-control"  name="telat" value="'.$dataedit->pt_telat.'">
                  </div>
                  <div class="col-md-4">
                    <label>Potongan Absen</label>
                    <input type="number" class="form-control"  name="absen" value="'.$dataedit->pt_absen.'">
                  </div>
                  <div class="col-md-4">
                    <label>PPH21</label>
                    <input type="number" class="form-control"  name="pph" value="'.$dataedit->pph21.'">
                  </div>
                </div>

            ';


        }
    }

    public function updatedosen(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $id['idgaji'] = htmlspecialchars($this->input->post('idgaji',true));
            $id['iddapat'] = htmlspecialchars($this->input->post('iddapat',true));
            $id['idpotong'] = htmlspecialchars($this->input->post('idpotong',true));
        
            $form['gapok'] = htmlspecialchars($this->input->post('gapok',true));
            $form['tj_jabatan'] = htmlspecialchars($this->input->post('tj_jabatan',true));
            $form['makan'] = htmlspecialchars($this->input->post('makan',true));
            $form['transport'] = htmlspecialchars($this->input->post('transport',true));
            $form['bonus'] = htmlspecialchars($this->input->post('bonus',true));
            $form['thr'] = htmlspecialchars($this->input->post('thr',true));
            $form['lembur'] = htmlspecialchars($this->input->post('lembur',true));

            $form['cicilan'] = htmlspecialchars($this->input->post('cicilan',true));
            $form['jamsostek'] = htmlspecialchars($this->input->post('jamsostek',true));
            $form['telat'] = htmlspecialchars($this->input->post('telat',true));
            $form['absen'] = htmlspecialchars($this->input->post('absen',true));
            $form['pph'] = htmlspecialchars($this->input->post('pph',true));

            
            $this->Basemodel->upadateDosenGaji($form,$id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dirubah.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('gaji/dosen');
            
        }
    }

    public function hapusDosen($id,$dp,$pt){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            
            $ids = array(
                'id_gaji' => $id,
                'id_pendap' => $dp,
                'id_potong' => $pt
            );
            $this->Basemodel->hapusDosenGaji($ids); 
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data berhasil dirubah.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('gaji/dosen');
        }
    }

    public function detailGajiDosen($id){
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
            $id_user = $this->Basemodel->dosenGetuser($id)->row();
            $data['route'] = 'dosencetak';
            $data['dsa'] = $this->Basemodel->dosenGetData($id_user->id_user)->row();
            $data['absen'] = $this->Basemodel->dosenGetDataAbsen($id_user->id_user)->row();
            $data['gaji'] = $this->Basemodel->gajiDosenPraedit($id)->row();
            $for = $this->Basemodel->gajiDosenPraedit($id)->row();
            $pdar = array(
                'gapok' => $for->gapok,
                'tj_jabatan' => $for->tj_jabatan, 
                'uang_makan' => $for->uang_makan,
                'transport' => $for->transport,
                'bonus' => $for->bonus,
                'thr' => $for->thr,
            );
            $potar = array(
                'cicilan_pinjaman' => $for->cicilan_pinjaman,
                'jamsostek' => $for->jamsostek, 
                'pt_telat' => $for->pt_telat,
                'pt_absen' => $for->pt_absen,
                'pph21' => $for->pph21
            );
            $totalpendap = array_sum($pdar);
            $totalpotongan = array_sum($potar);
            $jumlahgaji = $totalpendap - $totalpotongan;
            
            $data['rekap'] = array(
                'ttpendapatan' => $totalpendap,
                'ttpotongan' => $totalpotongan,
                'jumlahgaji' => $jumlahgaji, 
            );

            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('gaji/detail',$data);
            $this->load->view('templates/panel_footer');
        }
    }

    public function dosenCetak($id){
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
            $id_user = $this->Basemodel->dosenGetuser($id)->row();
            $data['dsa'] = $this->Basemodel->dosenGetData($id_user->id_user)->row();
            $data['absen'] = $this->Basemodel->dosenGetDataAbsen($id_user->id_user)->row();
            $dtab = $this->Basemodel->dosenGetDataAbsen($id_user->id_user)->row();
            $data['gaji'] = $this->Basemodel->gajiDosenPraedit($id)->row();
            $for = $this->Basemodel->gajiDosenPraedit($id)->row();
            $pdar = array(
                'gapok' => $for->gapok,
                'tj_jabatan' => $for->tj_jabatan, 
                'uang_makan' => $for->uang_makan,
                'transport' => $for->transport,
                'bonus' => $for->bonus,
                'thr' => $for->thr,
            );
            $potar = array(
                'cicilan_pinjaman' => $for->cicilan_pinjaman,
                'jamsostek' => $for->jamsostek, 
                'pt_telat' => $for->pt_telat,
                'pt_absen' => $for->pt_absen,
                'pph21' => $for->pph21
            );
            $absens = array(
                'masuk' => $dtab->masuk,
                'absen' => $dtab->absen,
                'sakit_skd' => $dtab->sakit_skd,
                'sakit_non_skd' => $dtab->sakit_non_skd,
                'izin' => $dtab->izin,
                'cuti' => $dtab->cuti,
            );
            $totalabsen = array_sum($absens);
            $totalpendap = array_sum($pdar);
            $totalpotongan = array_sum($potar);
            $jumlahgaji = $totalpendap - $totalpotongan;
            
            $data['rekap'] = array(
                'ttpendapatan' => $totalpendap,
                'ttpotongan' => $totalpotongan,
                'jumlahgaji' => $jumlahgaji,
                'totalabsen' => $totalabsen 
            );
            $this->load->view('gaji/cetak',$data);
        }
    }


    public function Staff()
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
                $data['gaji'] = $this->Basemodel->filterstaffGaji($form)->result();
                
            }else{
                $data['bulan'] = date('m');
                $data['tahun'] = date('Y');
                $data['gaji'] = $this->Basemodel->getstaffGaji()->result();
            }
    
            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('gaji/staff',$data);
            $this->load->view('templates/panel_footer');
        }
        
    }

    public function addStaff(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{

            $form['id_user'] = htmlspecialchars($this->input->post('staff',true));
            $form['bulan'] = htmlspecialchars($this->input->post('bulan',true));
            $form['tahun'] = htmlspecialchars($this->input->post('tahun',true));
            $pdtpan['gapok'] = htmlspecialchars($this->input->post('gapok',true));
            $pdtpan['tj_jabatan'] = htmlspecialchars($this->input->post('tj_jabatan',true));
            $pdtpan['makan'] = htmlspecialchars($this->input->post('makan',true));
            $pdtpan['transport'] = htmlspecialchars($this->input->post('transport',true));
            $pdtpan['bonus'] = htmlspecialchars($this->input->post('bonus',true));
            $pdtpan['thr'] = htmlspecialchars($this->input->post('thr',true));
            $pdtpan['lembur'] = htmlspecialchars($this->input->post('lembur',true));

            $ptongan['cicilan'] = htmlspecialchars($this->input->post('cicilan',true));
            $ptongan['jamsostek'] = htmlspecialchars($this->input->post('jamsostek',true));
            $ptongan['telat'] = htmlspecialchars($this->input->post('telat',true));
            $ptongan['absen'] = htmlspecialchars($this->input->post('absen',true));
            $ptongan['pph'] = htmlspecialchars($this->input->post('pph',true));

            
            $valid = count($this->Basemodel->valGaji($form,'staff')->result());

            if ($valid > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Sudah Ada Di Periode Ini.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('gaji/staff');
            }else {
                $this->Basemodel->addStaffGaji($form,$pdtpan,$ptongan);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambhkan.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('gaji/staff');
            }
            
        }
    }

    public function staffpraedit(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');

        // jika login maka akan meng eksekusi printah add ke database
        }else{
            $id_gaji= htmlspecialchars($this->input->post('idgaji',true));
            $dataedit = $this->Basemodel->gajiStaffPraedit($id_gaji)->row();
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
                  <input type="hidden" name="idgaji" value="'.$dataedit->id_gaji.'">
                  <input type="hidden" name="iddapat" value="'.$dataedit->id_pendapatan.'">
                  <input type="hidden" name="idpotong" value="'.$dataedit->id_potong.'">
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
                <p>Input Pendapatan Gaji</p>
                <div class="form-group row g-3">
                  <div class="col-md-4">
                    <label>Gaji Pokok</label>
                    <input type="number" class="form-control"  name="gapok" value="'.$dataedit->gapok.'">
                  </div>
                  <div class="col-md-4">
                    <label>Tunjangan Jabatan</label>
                    <input type="number" class="form-control"  name="tj_jabatan" value="'.$dataedit->tj_jabatan.'">
                  </div>
                  <div class="col-md-4">
                    <label>Uang Makan</label>
                    <input type="number" class="form-control"  name="makan" value="'.$dataedit->uang_makan.'">
                  </div>
                  <div class="col-md-4">
                    <label>Transportasi</label>
                    <input type="number" class="form-control"  name="transport" value="'.$dataedit->transport.'">
                  </div>
                  <div class="col-md-4">
                    <label>Bonus</label>
                    <input type="number" class="form-control"  name="bonus" value="'.$dataedit->bonus.'">
                  </div>
                  <div class="col-md-4">
                    <label>THR</label>
                    <input type="number" class="form-control"  name="thr" value="'.$dataedit->thr.'">
                  </div>
                  <div class="col-md-4">
                    <label>Lembur</label>
                    <input type="number" class="form-control"  name="lembur" value="'.$dataedit->lembur.'">
                  </div>
                </div><br>
                <p>Input Potongan Gaji</p>
                <div class="form-group row g-3">
                  <div class="col-md-4">
                    <label>Cicilan Pinjaman</label>
                    <input type="number" class="form-control"  name="cicilan" value="'.$dataedit->cicilan_pinjaman.'">
                  </div>
                  <div class="col-md-4">
                    <label>Jamsostek</label>
                    <input type="number" class="form-control"  name="jamsostek" value="'.$dataedit->jamsostek.'">
                  </div>
                  <div class="col-md-4">
                    <label>Potongan Telat</label>
                    <input type="number" class="form-control"  name="telat" value="'.$dataedit->pt_telat.'">
                  </div>
                  <div class="col-md-4">
                    <label>Potongan Absen</label>
                    <input type="number" class="form-control"  name="absen" value="'.$dataedit->pt_absen.'">
                  </div>
                  <div class="col-md-4">
                    <label>PPH21</label>
                    <input type="number" class="form-control"  name="pph" value="'.$dataedit->pph21.'">
                  </div>
                </div>

            ';


        }
    }

    public function updatestaff(){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $id['idgaji'] = htmlspecialchars($this->input->post('idgaji',true));
            $id['iddapat'] = htmlspecialchars($this->input->post('iddapat',true));
            $id['idpotong'] = htmlspecialchars($this->input->post('idpotong',true));
        
            $form['gapok'] = htmlspecialchars($this->input->post('gapok',true));
            $form['tj_jabatan'] = htmlspecialchars($this->input->post('tj_jabatan',true));
            $form['makan'] = htmlspecialchars($this->input->post('makan',true));
            $form['transport'] = htmlspecialchars($this->input->post('transport',true));
            $form['bonus'] = htmlspecialchars($this->input->post('bonus',true));
            $form['thr'] = htmlspecialchars($this->input->post('thr',true));
            $form['lembur'] = htmlspecialchars($this->input->post('lembur',true));

            $form['cicilan'] = htmlspecialchars($this->input->post('cicilan',true));
            $form['jamsostek'] = htmlspecialchars($this->input->post('jamsostek',true));
            $form['telat'] = htmlspecialchars($this->input->post('telat',true));
            $form['absen'] = htmlspecialchars($this->input->post('absen',true));
            $form['pph'] = htmlspecialchars($this->input->post('pph',true));

            
            $this->Basemodel->upadateStaffGaji($form,$id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dirubah.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('gaji/staff');
            
        }
    }

    public function hapusStaff($id,$dp,$pt){
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            
            $ids = array(
                'id_gaji' => $id,
                'id_pendap' => $dp,
                'id_potong' => $pt
            );
            $this->Basemodel->hapusStaffGaji($ids); 
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data berhasil dirubah.!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('gaji/staff');
        }
    }

    public function detailGajiStaff($id){
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
            $id_user = $this->Basemodel->staffGetuser($id)->row();
            $data['route'] = 'staffcetak';
            $data['dsa'] = $this->Basemodel->staffGetData($id_user->id_user)->row();
            $data['absen'] = $this->Basemodel->staffGetDataAbsen($id_user->id_user)->row();
            $data['gaji'] = $this->Basemodel->gajiStaffPraedit($id)->row();
            $for = $this->Basemodel->gajiStaffPraedit($id)->row();
            $pdar = array(
                'gapok' => $for->gapok,
                'tj_jabatan' => $for->tj_jabatan, 
                'uang_makan' => $for->uang_makan,
                'transport' => $for->transport,
                'bonus' => $for->bonus,
                'thr' => $for->thr,
            );
            $potar = array(
                'cicilan_pinjaman' => $for->cicilan_pinjaman,
                'jamsostek' => $for->jamsostek, 
                'pt_telat' => $for->pt_telat,
                'pt_absen' => $for->pt_absen,
                'pph21' => $for->pph21
            );
            $totalpendap = array_sum($pdar);
            $totalpotongan = array_sum($potar);
            $jumlahgaji = $totalpendap - $totalpotongan;
            
            $data['rekap'] = array(
                'ttpendapatan' => $totalpendap,
                'ttpotongan' => $totalpotongan,
                'jumlahgaji' => $jumlahgaji, 
            );

            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('gaji/detail',$data);
            $this->load->view('templates/panel_footer');
        }
    }

    public function staffCetak($id){
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
            $id_user = $this->Basemodel->staffGetuser($id)->row();
            $data['dsa'] = $this->Basemodel->staffGetData($id_user->id_user)->row();
            $data['absen'] = $this->Basemodel->staffGetDataAbsen($id_user->id_user)->row();
            $dtab = $this->Basemodel->staffGetDataAbsen($id_user->id_user)->row();
            $data['gaji'] = $this->Basemodel->gajiStaffPraedit($id)->row();
            $for = $this->Basemodel->gajiStaffPraedit($id)->row();
            $pdar = array(
                'gapok' => $for->gapok,
                'tj_jabatan' => $for->tj_jabatan, 
                'uang_makan' => $for->uang_makan,
                'transport' => $for->transport,
                'bonus' => $for->bonus,
                'thr' => $for->thr,
            );
            $potar = array(
                'cicilan_pinjaman' => $for->cicilan_pinjaman,
                'jamsostek' => $for->jamsostek, 
                'pt_telat' => $for->pt_telat,
                'pt_absen' => $for->pt_absen,
                'pph21' => $for->pph21
            );
            $absens = array(
                'masuk' => $dtab->masuk,
                'absen' => $dtab->absen,
                'sakit_skd' => $dtab->sakit_skd,
                'sakit_non_skd' => $dtab->sakit_non_skd,
                'izin' => $dtab->izin,
                'cuti' => $dtab->cuti,
            );
            $totalabsen = array_sum($absens);
            $totalpendap = array_sum($pdar);
            $totalpotongan = array_sum($potar);
            $jumlahgaji = $totalpendap - $totalpotongan;
            
            $data['rekap'] = array(
                'ttpendapatan' => $totalpendap,
                'ttpotongan' => $totalpotongan,
                'jumlahgaji' => $jumlahgaji,
                'totalabsen' => $totalabsen 
            );
            $this->load->view('gaji/cetak',$data);
        }
    }

    


}
