<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Docs extends CI_Controller {


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
        $this->load->model('DocsModel');
    }
    
    
    /*
     * Admin page
     */
    public function index() {

        $data = array(
            'title' => 'Documentation',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'page_lists' => $this->DocsModel->retrivePages(),
            'pagename' => 'admin/docs/dashboard'
            
        );
        
        $this->load->view('template/admin_master_view', $data);
    }

    
    /**
     * Add New Page
     */
    public function addEditPage(){
        //Check page edit action
        $page_details = false;
        $page_id = (int) $this->uri->segment(3);
        
        if ($page_id !== FALSE && $page_id > 0) {
            $page_id = $this->uri->segment(3);
            $page_details = $this->DocsModel->retrivePages($page_id);
        }
        
        //request 
        $page_action = ($page_details === false)? 'add' : 'edit';
        
        $data = array(
            'title'             => 'Add New Page',
            'logged_in'         => isset($this->session->userdata['logged_in']),
            'page_categories'   => $this->DocsModel->retriveCategory(),
            'targets'           => $this->DocsModel->retriveTargets(),
            'page_action'       => $page_action,
            'page_details'      => $page_details,
            'pagename' => 'admin/docs/add_edit_page'
        );
        
        $this->load->view('template/admin_master_view', $data);
    }
    
    
    /**
     * Ajax call to get sub categories
    
    
    public function ajaxRetrive(){
        $cat_id = $this->input->post('id', TRUE);
        $data = $this->DocsModel->retriveSubCategoryUsingCategory($cat_id);
        
        echo json_encode($data);
    }
     */
    
    
    /**
     * Process new page
     */
    public function processAddEditPage(){
        //Validation
        $this->form_validation->set_rules('cat_id', 'Page Category', array('trim', 'required'));
        $this->form_validation->set_rules('page_title', 'Page Title', array('trim', 'required', 'min_length[2]'));
        $this->form_validation->set_rules('target[]', 'Target', 'required');
        $this->form_validation->set_rules('page_status', 'Page Status', array('trim', 'required', 'min_length[2]'));
        $this->form_validation->set_rules('content', 'Page Content', array('trim', 'required', 'min_length[10]'));
        
        //operation 
        $operation = $this->input->post('hdn_page_action', TRUE);
        $page_id = (int) $this->input->post('hdn_page_id', TRUE);
        
        if ($this->form_validation->run() == FALSE){
            $this->addEditPage();
         
        }else if(!in_array($operation, array('add','edit')) || ($operation == 'edit' && $page_id < 1 )){
            $this->session->set_flashdata('error_msg', 'Unable to add record');
            $this->addEditPage();
            
        }else{
            
            $data = array(
                'cat_id' => $this->input->post('cat_id', TRUE),
                //'subcat_id' => $this->input->post('page_sub_category', TRUE),
                'page_title' => $this->input->post('page_title', TRUE),
                'target' => json_encode($this->input->post('target', TRUE)),
                'tag' => $this->input->post('tag', TRUE),
                'page_order' => $this->input->post('page_order', TRUE),
                'page_status' => $this->input->post('page_status', TRUE),
                'content' => $this->input->post('content')
            );
            
            $res = $this->DocsModel->addEditPage($data, $operation, $page_id);

            if ($res) {
                $this->session->set_flashdata('success_msg', 'Record '.$operation.'ed successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Unable to '.$operation.' record');
            }

            redirect('docs/');
        }
    }
    
    
    /**
     * Delete page
     */
    public function deletePage(){
        if ($this->uri->segment(3) === FALSE || (int) $this->uri->segment(3) < 1) {
            redirect('docs/', 'refresh');
            
        } else {
            
            $page_id = $this->uri->segment(3);
            $res = $this->DocsModel->removePage($page_id);
                        
            ($res)? $this->session->set_flashdata('success_msg', 'Page deleted successfully'): $this->session->set_flashdata('error_msg', 'Unable to delete page');
            
            redirect('docs/');
        }
        
    }
    
    
    /**
     * Page: Category list
     */
    public function pageCategory(){
        //Check page edit action
        $category_details = false;
        $category_id = (int) $this->uri->segment(3);
        
        if ($category_id !== FALSE && $category_id > 0) {
            $category_id = $this->uri->segment(3);
            $category_details = $this->DocsModel->retriveCategory($category_id);
        }
        
        //request 
        $category_action = ($category_details === false)? 'add' : 'edit';
        
        $data = array(
            'title' => 'Category',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'category_lists' => $this->DocsModel->retriveCategory(),
            'pagename' => 'admin/docs/manage_category',
            'category_action' => $category_action,
            'category_detail' => $category_details
            
        );
        
        $this->load->view('template/admin_master_view', $data);
    }
    
    
    /**
     * Process: Update Category 
     */
    public function processCategory(){
        $this->form_validation->set_rules('txt_title', 'Category Title', array('trim', 'required', 'min_length[3]'));
        
        //operation 
        $operation = $this->input->post('hdn_category_action', TRUE);
        $category_id = (int) $this->input->post('hdn_category_id', TRUE);
        
        if ($this->form_validation->run() == FALSE){
            $this->pageCategory();
         
        }else if(!in_array($operation, array('add','edit')) || ($operation == 'edit' && $category_id < 1 )){
            $this->session->set_flashdata('error_msg', 'Unable to add record');
            $this->pageCategory();
            
        }else{
            
            $data = array(
                'category_title' => $this->input->post('txt_title', TRUE),
                'description' => $this->input->post('txt_desc', TRUE)
            );
            
            $res = $this->DocsModel->addEditCategory($data, $operation, $category_id);

            if ($res) {
                $this->session->set_flashdata('success_msg', 'Record '.$operation.'ed successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Unable to '.$operation.' record');
            }

            redirect('docs/pageCategory');
        }
    }
    
    
    /**
     * Process: Delete Category
     */
    public function categoryDelete(){
        if ($this->uri->segment(3) === FALSE || (int) $this->uri->segment(3) < 1) {
            redirect('docs/pageCategory', 'refresh');
            
        } else {
            
            $category_id = $this->uri->segment(3);
            $res = $this->DocsModel->removeCategory($category_id);
                        
            ($res)? $this->session->set_flashdata('success_msg', 'Category deleted successfully'): $this->session->set_flashdata('error_msg', 'Unable to delete category');
            
            redirect('docs/pageCategory');
        }
    }


    /**
     * Image gallery
     */
    public function imageGallery(){
        $data = array(
            'title' => 'Image Gallery',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'allImages' => $this->DocsModel->getGallery(),
            'pagename' => 'admin/docs/manage_image_gallery'
        );
        
        $this->load->view('template/admin_master_view', $data);
    }
    
    /**
     * Handel image upload request
     */
    public function processAddGallery(){

        //Validation
        $this->form_validation->set_rules('txt_title', 'Title', array('trim', 'required', 'min_length[2]'));
        if ($this->form_validation->run() == FALSE){
            $this->imageGallery();
            
        }else{
            $config['upload_path'] = './uploads/gallery';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2100;
            $config['max_width'] = 1900;
            $config['max_height'] = 1600;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $this->session->set_flashdata('error_msg',  $this->upload->display_errors());

            }else {
                $data = $this->upload->data();
                $image_name = $data['raw_name'].$data['file_ext'];
                $this->DocsModel->addGallery(array('img_name' => $image_name, "img_title" => $this->input->post('txt_title')));
                $this->session->set_flashdata('success_msg',  "Hurry! Image uploaded successfully.");
            }

            redirect('docs/imageGallery');
        }
    }
    
    
    /**
     * Delete image
     */
    public function deleteGallery(){
        if ($this->uri->segment(3) === FALSE) {
            redirect('/docs/imageGallery', 'refresh');
            
        } else {
            $res = false;
            
            $img_id = $this->uri->segment(3);
            $img_details = $this->DocsModel->getGallery($img_id);
            
            if(!empty($img_details)){
                //Remove image
                $img_fullpath = './uploads/gallery/'.$img_details->img_name;
                $res = unlink($img_fullpath);
                if($res){
                    $this->DocsModel->removeImgRecord($img_id);
                    $res = true;
                }
            }
            
            ($res)? $this->session->set_flashdata('success_msg', 'Image deleted successfully'): $this->session->set_flashdata('error_msg', 'Unable to delete image');
            
            redirect('docs/imageGallery');
        }
    }
   
    
}
