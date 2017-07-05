<?php

class HomeModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        
        //Custom helper
        $this->load->helper('common_helper');
    }

    
    /*
     *  Retirve all security alerts
     */
    public function retriveAlerts($id=null) {
        
        $this->db->select('*');
        
        if(!empty($id) && $id > 0){
            $this->db->where('id', $id);
        }
        
        $this->db->from('scan_alerts');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return (!empty($id) && $id > 0)? $query->row() : $this->formatResult($query->result());
            
        } else {
            return false;
        }
    }
    
    
    /**
     * Format result
     */
    public function formatResult($dataArry){
        if(!is_array($dataArry)){
            return false;
        }else{
            $newArry = $dataArry;
            foreach($dataArry as $key => $data){
                $newArry[$key]->classification = truncateTxt($data->classification, 40);   
                $newArry[$key]->resource = truncateTxt($data->resource, 30);   
                $newArry[$key]->description = truncateTxt($data->description, 55);  
                
            }
            return $newArry; 
        }
    }
    
    
    /**
     * Get Docs Categories
     */
    public function retriveDocsCategories(){
        $this->db->select('*');
        
        $this->db->from('page_category');
        
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->result() : false;
    }   
    
    /**
     * Get sub category
     */
    public function retrivePagesUsingCategory($id){
        $this->db->select('id as page_id, page_title');
        
        $this->db->where('cat_id', $id);
        
        $this->db->from('page');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
            
        } else {
            return false;
        }
    }
    
    
    /**
     * Get page details
     */
    public function retrivePages($id = null){
        $this->db->select('p.id, p.cat_id, p.page_title, p.target,'
                . ' p.tag, p.page_order, p.page_status, p.content, p.last_update,'
                . ' c.category_title');
        
        if(!empty($id) && $id > 0){ $this->db->where('p.id', $id); }
        
        $this->db->from('page p');
        $this->db->join('page_category c', 'p.cat_id = c.id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return (!empty($id) && $id > 0)? $query->row() : $query->result();
            
        } else {
            return false;
        }
    }
    
    
    /**
     * Get first page details
     */
    public function getFirstPage(){
        $this->db->select('id, cat_id');
        $this->db->from('page');
        $this->db->order_by('id','asc');
        $this->db->limit(1);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->row() : false;
    }
    
}
