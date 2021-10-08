<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        if ($this->session->userdata('login') != 'zpmlogin') {
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == false){
                $data['title'] = 'Login page';
               $this->load->view('templates/auth_header', $data);
               $this->load->view('auth/login');
               $this->load->view('templates/auth_footer');
            }else{
                //validasinya success
                $this->_login();
            }
        }else{
            redirect('Panel');
        }

}

    private function _login()
    {
        $username= $this->input->post('username');
        $password= $this->input->post('password');
        $user=$this->db->get_where('user', ['username' =>$username])->row_array();
        if($user){
                //cek password
                if(password_verify($password, $user['password'])){
                    $data=[
                        'username'=>$user['username'],
                        'role_user'=>$user['role_user'],
                        'login' => 'zpmlogin'
                    ];
                    $this->session->set_userdata($data);
                    redirect('Panel');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    redirect('auth');
                }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak ada di sistem!</div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_user');
        $this->session->unset_userdata('login');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been Logged out! </div>');
       redirect('auth');

    }
}

