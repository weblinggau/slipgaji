<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller 
{
	public function __construct(){
		parent::__construct();

		$this->load->model('Basemodel');
        
	}

    public function index()
    {

    	if ($this->session->userdata('login') != 'zpmlogin') {
    		redirect('Auth');
    	}else{
    		$this->load->view('templates/panel_header');
		    $this->load->view('templates/panel_menu');
		    $this->load->view('home/index');
		    $this->load->view('templates/panel_footer');
    	}
    	
    }

    public function Dosen()
    {
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $data['dosen'] = $this->Basemodel->getdosen()->result();
            $data['jabatan'] = $this->Basemodel->getjabatan()->result();
            $data['jenjang'] = $this->Basemodel->getjenjang()->result();
            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('dosen/index', $data);
            $this->load->view('templates/panel_footer');
        }
    }

    public function Staff()
    {
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $data['staff'] = $this->Basemodel->getstaff()->result();
            $data['jabatan'] = $this->Basemodel->getjabatan()->result();
            $data['jenjang'] = $this->Basemodel->getjenjang()->result();
            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('staff/index',$data);
            $this->load->view('templates/panel_footer');
        }
    }

    public function Admin()
    {
        if ($this->session->userdata('login') != 'zpmlogin') {
            redirect('Auth');
        }else{
            $data['admin'] = $this->Basemodel->getadmin()->result();
            $this->load->view('templates/panel_header');
            $this->load->view('templates/panel_menu');
            $this->load->view('admin/index',$data);
            $this->load->view('templates/panel_footer');
        }
    }



}
