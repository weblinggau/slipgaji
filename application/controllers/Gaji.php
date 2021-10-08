<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller 
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

    


}
