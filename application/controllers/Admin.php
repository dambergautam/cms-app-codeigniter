<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');
        $this->load->helper('common_helper');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        //Check if user logged in
        if(!isset($this->session->userdata['logged_in'])){
            redirect('/login/index', 'refresh');
        }
        
        // Load model
        $this->load->model('AdminModel');
    }
    
    
    /*
     * Admin Dashboard
     */
    public function index() {
        
        $data = array(
            'title' => 'Admin',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'alert_lists' => $this->AdminModel->retriveAlerts(),
            'pagename' => 'admin/dashboard'
        );
        $this->load->view('template/admin_master_view', $data);
    }
    
    
    /**
     * Upload
     */
    public function do_upload() {
        $config['upload_path'] = './uploads'; //base_url().'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2100;
        $config['max_width'] = 1900;
        $config['max_height'] = 1600;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $this->session->set_flashdata('error_msg',  $this->upload->display_errors());
            
        }else {
            
            $this->session->set_flashdata('success_msg',  "Hurry! Image uploaded successfully.");
        }
        
        redirect('admin/');
    }

    
    /**
     * List alerts
     */
    public function alerts(){
        $data = array(
            'title' => 'Admin',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'alert_lists' => $this->AdminModel->retriveAlerts(),
            'pagename' => 'admin/issues/alerts'
        );
        $this->load->view('template/admin_master_view', $data);
    }
    
    
    /*
     *  UI for add alert page
     */
    public function alert_add() {
        $data = array(
            'title' => 'Add Alerts',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'pagename' => 'admin/issues/alert_add'
        );

        $this->load->view('template/admin_master_view', $data);
    }

    
    /*
     * Add alerts 
     */

    public function process_add_alerts() {

        $data = array(
            'classification' => $this->input->post('classification', TRUE),
            'resource' => $this->input->post('resource', TRUE),
            'parameter' => $this->input->post('parameter', TRUE),
            'method' => $this->input->post('method', TRUE),
            'risk' => $this->input->post('risk', TRUE),
            'flag' => $this->input->post('flag', TRUE),
            'description' => $this->input->post('description', TRUE),
            'remediation' => $this->input->post('remediation', TRUE)
        );

        $res = $this->AdminModel->addAlerts($data);

        if ($res) {
            $this->session->set_flashdata('success_msg', 'Record added successfully');
        } else {
            $this->session->set_flashdata('error_msg', 'Unable to add record');
        }

        redirect('admin/alert_add');
    }

    /*
     * Detail page
     */

    public function alert_detail() {
        if ($this->uri->segment(3) === FALSE) {
            redirect('/admin/', 'refresh');
        } else {
            $issue_id = $this->uri->segment(3);
        }
        $issue_detail = $this->AdminModel->retriveAlerts($issue_id);

        $data = array(
            'title' => 'Issue detail',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'issue_detail' => $issue_detail
        );
        $this->load->view('include/header', $data);
        $this->load->view('issue_detail');
        $this->load->view('include/footer');
    }

    /**
     * Edit page
     */
    public function alert_edit() {
        if ($this->uri->segment(3) === FALSE) {
            redirect('/admin/', 'refresh');
        } else {
            $issue_id = $this->uri->segment(3);
        }
        $issue_detail = $this->AdminModel->retriveAlerts($issue_id);

        $data = array(
            'title' => 'Edit Issue',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'edit_data' => $issue_detail,
            'pagename' => 'admin/issues/alert_edit'                
        );

        $this->load->view('template/admin_master_view', $data);
    }

    /*
     * Update alerts 
     */

    public function process_edit_alerts() {

        $data = array(
            'classification' => $this->input->post('classification', TRUE),
            'resource' => $this->input->post('resource', TRUE),
            'parameter' => $this->input->post('parameter', TRUE),
            'method' => $this->input->post('method', TRUE),
            'risk' => $this->input->post('risk', TRUE),
            'flag' => $this->input->post('flag', TRUE),
            'description' => $this->input->post('description', TRUE),
            'remediation' => $this->input->post('remediation', TRUE)
        );
        $id = $this->input->post('id', TRUE);

        $res = $this->AdminModel->editAlert($data, $id);

        if ($res) {
            $this->session->set_flashdata('success_msg', 'Record updated successfully');
        } else {
            $this->session->set_flashdata('error_msg', 'Unable to update record');
        }

        redirect('admin/');
    }

    /*
     * Delete issue alert
     */

    public function alert_delete() {
        if ($this->uri->segment(3) === FALSE) {
            redirect('/admin/', 'refresh');
        } else {
            $issue_id = $this->uri->segment(3);

            $res = $this->AdminModel->deleteAlert($issue_id);

            if ($res) {
                $this->session->set_flashdata('success_msg', 'Record deleted successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Unable to delete record');
            }

            redirect('admin/');
        }
    }
    
    
    /**
     * Upload image page (mockups)
     */
    public function uploadImage(){
        $data = array(
            'title' => 'Edit Issue',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'pagename' => 'admin/image_gallery'                
        );

        $this->load->view('template/admin_master_view', $data);
    }
    
    
    public function deleteImg(){
        if ($this->uri->segment(3) === FALSE) {
            redirect('/admin/', 'refresh');
            
        } else {
            $del_path = base64_decode(urldecode($this->uri->segment(3)));
                        
            $res = unlink($del_path);

            if ($res) {
                $this->session->set_flashdata('success_msg', 'Image deleted successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Unable to delete image');
            }

            redirect('admin/');
        }
    }
    
    
    /**
     * Load backup page
     */
    public function backup(){
        $data = array(
            'title' => 'Backup',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'pagename' => 'admin/db_backup'                
        );

        $this->load->view('template/admin_master_view', $data);
    }
    
    
    /**
     * Process to backup database
     */
    public function process_backup(){
        $this->load->dbutil();
        
        $prefs = array(
            'tables'        => array(),             // Array of tables to backup.
            'ignore'        => array(),             // List of tables to omit from the backup
            'format'        => 'zip',               // gzip, zip, txt
            'filename'      => 'fs_system.sql',     // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop'      => TRUE,                // Whether to add DROP TABLE statements to backup file
            'add_insert'    => TRUE,                // Whether to add INSERT data to backup file
            'newline'       => "\n"                 // Newline character used in backup file
        );

        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the file helper and write the file to your server
        //$this->load->helper('file');
        //write_file('/path/to/mybackup.gz', $backup);

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('fs_system.zip', $backup);
    }
}