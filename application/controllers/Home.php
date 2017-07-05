<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');
        
        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load model
        $this->load->helper('common_helper');
        $this->load->model('HomeModel');        
    }
    

    /**
     * Home page
     */
    public function index() {
        
        
        $data=array(
            'title' => 'Home',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'images' => getAllImages()
        );
        $this->load->view('include/header', $data);
        $this->load->view('home');
        $this->load->view('include/footer');
    }

    
    /**
     * Index Page for this controller.
     */
    public function vulnerabilities() {

        $data = array(
            'title' => 'Seurity Vulnerabilities',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'alert_lists' => $this->HomeModel->retriveAlerts()
        );
        $this->load->view('include/header', $data);
        $this->load->view('securitylist');
        $this->load->view('include/footer');
    }
   
    
    /**
     * Fellowship documentation
     */
    public function docs(){
        
        $page_data = array();
        $request_action = $this->uri->segment(3);
        $request_page_id = (int) $this->uri->segment(4);
        
        if($request_action == 'page' && $request_page_id > 0){
            $page_data = $this->getPage($request_page_id);
            
        }else{
            //Get first page 
            $page_data = $this->HomeModel->getFirstPage();
            if(!empty($page_data)){ redirect('/home/docs/page/'.$page_data->id); }
        }
        
        $categories = $this->HomeModel->retriveDocsCategories();
        $data=array(
            'title' => 'Home',
            'logged_in' => isset($this->session->userdata['logged_in']),
            'categories' => $categories,
            'accordion_menu' => $this->accordionMenu($categories, $request_action, $request_page_id),
            'page_data' => $page_data
        );
        
        $this->load->view('include/header', $data);
        $this->load->view('docs');
        $this->load->view('include/footer');
        
    }

    
    /**
     * Prepare page data
     * @param type $page_id
     * @return string
     */
    public function getPage($page_id){
        $page_details = $this->HomeModel->retrivePages($page_id);
        
        $page_data = (object) array('breadcrumb' =>'', 'title'=>"Page Not Found", 'content'=>'<h1>404 Error</h1>', 'last_update'=>'');
        
        if(empty($page_details) || $page_data === false){
            return $page_data;
        }else{
            //var_dump($page_data); die();
            $separator = '&raquo;';
            $page_data->breadcrumb = 'Docs ' .$separator.' '.$page_details->category_title .' '. $separator . ' ' . $page_details->page_title;
            $page_data->title = $page_details->page_title;
            $page_data->content  = $page_details->content;
            $page_data->last_update = 'Last update: '.$page_details->last_update;
        }
        return $page_data;
    }
    
    
    /**
     * Generate accordion menu and sub-menu -landing page
     * @return string
     */
    public function accordionMenu($categories, $request_action, $request_page_id){
        
        //Valid category
        if(empty($categories)){ return 'No record found!';}
        
        //Valid page
        $page_details = $this->HomeModel->retrivePages($request_page_id);
        if($page_details == false){ return false;}
        
        
        $i =0;
        $category_and_page = $categories;
        foreach($categories as $category ){
            $category_and_page[$i]->pages = $this->HomeModel->retrivePagesUsingCategory($category->id);
            $i++;
        }
        
        $html = '<ul class="nano-content">';
        
        foreach($category_and_page as $category){
            
            $class = '';
            if($request_action == 'page' && $request_page_id > 0){
                $class = ($category->id == $page_details->cat_id) ? 'active' : '';
            }
            
            // Attributes & child elements
            $arrow = '';
            $pageslist = '';
            
            if($category->pages != false){
                $class = 'class="sub-menu '.$class.'"';
                $arrow = '<i class="arrow fa fa-angle-right pull-right"></i>';
                
                //Child menu
                $pageslist = '<ul>';
                foreach($category->pages as $page){
                    $subcls = ($page->page_id == $request_page_id)? 'class="active"' : '';
                    $pageslist .= '<li '.$subcls.'>' . '<a href="'.base_url().'index.php/home/docs/page/'.$page->page_id.'">'.$page->page_title.'</a>' . '</li>';
                }
                $pageslist .= '</ul>';
            }

            // Complete accordion menu
            $html .= '<li '.$class.'>'
                        . '<a href="javascript:void(0);">' . '<span>' . $category->category_title . '</span>'.$arrow . '</a>'
                        . $pageslist
                    . '</li>';
        }
        
        $html .='</ul>';
        
        return $html;
    }
    
}
