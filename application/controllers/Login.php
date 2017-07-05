<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');
        $this->load->helper('common_helper');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load model
        $this->load->model('LoginModel');
    }
    
    
    /**
     * Login page 
     */
    public function index() {

        $data = array(
            'title' => 'Login',
            'logged_in' => isset($this->session->userdata['logged_in'])
        );

        $this->load->view('include/header', $data);
        (isset($this->session->userdata['logged_in'])) ? redirect('/admin/', 'refresh') : $this->load->view('login');
        $this->load->view('include/footer');
    }
    
    /*
     *  Check for user login process
     */

    public function user_login_process() {

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            (isset($this->session->userdata['logged_in'])) ? redirect('/admin/', 'refresh') : redirect('/login/', 'refresh');
            
        } else {
            $data = array('username' => $this->input->post('username', true), 'password' => $this->input->post('password', true));

            $result = $this->LoginModel->validateLogin($data);
            $user_data = $this->LoginModel->getUserData($data['username']);

            if ($result == TRUE && $user_data != FALSE) {
                $session_data = array('username' => $user_data[0]->user_name, 'email' => $user_data[0]->user_email);

                // Add user data in session
                $this->session->set_userdata('logged_in', $session_data);
                redirect('/admin/', 'refresh');
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid Username or Password');
                redirect('/login/', 'refresh');
            }
        }
    }
    
    
    /*
     *  Logout from admin page
     */
    public function logout() {

        // Removing session data
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->session->set_flashdata('success_msg', 'Successfully Logout');
        $this->index();
    }
}