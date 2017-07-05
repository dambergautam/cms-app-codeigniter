<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DocsModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        
        //Custom helper
        $this->load->helper('common_helper');
    }

    
    /**
     * Page category list
     */
    public function retriveCategory($id = null){
        $this->db->select('*');
        
        if(!empty($id) && $id > 0){ $this->db->where('id', $id); }
        
        $this->db->from('page_category');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return (!empty($id) && $id > 0)? $query->row() : $query->result();
            
        } else {
            return false;
        }
    }
    
    
    /**
     * Add or update category
     */
    public function addEditCategory($data, $operation, $category_id = null){
        if($operation == "add"){
            return $this->db->insert('page_category', $data);
            
        }else if($operation == "edit"){
            $this->db->limit(1);
            $this->db->where('id', $category_id);
            return $this->db->update('page_category', $data);

        }
        
    }
    
    
    /**
     * Remove category
     */
    public function removeCategory($category_id){
        $this->db->limit(1);
        $this->db->where('id', $category_id);
        return $this->db->delete('page_category');
    }


    /**
     * Page category list
     
    public function retriveSubCategory($id = null){
        $this->db->select('*');
        
        if(!empty($id) && $id > 0){ $this->db->where('id', $id); }
        
        $this->db->from('page_sub_category');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return (!empty($id) && $id > 0)? $query->row() : $query->result();
            
        } else {
            return false;
        }
    }
     * 
     */
    
    
    /**
     * Page sub category list
     
    public function retriveSubCategoryUsingCategory($id){
        $this->db->select('id, subcategory_title');
        
        $this->db->where('cat_id', $id);
        
        $this->db->from('page_sub_category');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
            
        } else {
            return false;
        }
    }
    */
    
    
    /**
     * 
     */
    public function retrivePages($id = null){
        $this->db->select('p.id, p.cat_id, p.page_title, p.target,'
                . ' p.tag, p.page_order, p.page_status, p.content, p.last_update,'
                . ' c.category_title');
        
        if(!empty($id) && $id > 0){ $this->db->where('p.id', $id); }
        
        $this->db->from('page p');
        $this->db->join('page_category c', 'p.cat_id = c.id');
        //$this->db->join('page_sub_category s', 'p.subcat_id = s.id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return (!empty($id) && $id > 0)? $query->row() : $query->result();
            
        } else {
            return false;
        }
    }
    
    
    /**
     * Add or update page
     */
    public function addEditPage($data, $operation, $page_id = null){
        if($operation == "add"){
            return $this->db->insert('page', $data);
            
        }else if($operation == "edit"){
            $this->db->limit(1);
            $this->db->where('id', $page_id);
            return $this->db->update('page', $data);

        }
        
    }
    
    
    /**
     * Remove page
     * @param int $page_id
     * @return boolean
     */
    public function removePage($page_id){
        $this->db->limit(1);
        $this->db->where('id', $page_id);
        return $this->db->delete('page');
    }
    
    
    /*
     *  Add Image gallery record
     */
    public function addGallery($data) {
        return $this->db->insert('img_gallery', $data);
    }

    
    /**
     * Get all images
     */
    public function getGallery($id=null){
                
        $this->db->select('*');
        
        if(!empty($id) && $id > 0){
            $this->db->where('id', $id);
        }
        
        $this->db->from('img_gallery');
        
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
    public function formatResult($dataArry) {
        $directory = base_url()."uploads/gallery/";

        $imagesArray = $dataArry;
        $i=0;
        foreach ($dataArry as $image) {
            
            $imagesArray[$i]->title_trimmed = truncateTxt($image->img_title, 17);
            $imagesArray[$i]->fullpath = $directory.$image->img_name;
            $i++;
        }
        return $imagesArray;
    }
    
    
    /**
     * Remove database record of image gallery 
     * @return boolean
     */
    public function removeImgRecord($img_id){
        $this->db->limit(1);
        $this->db->where('id', $img_id);
        return $this->db->delete('img_gallery');
        
    }
    
    
    /**
     * Return target users list
     */
    public function retriveTargets(){
        $targets = array(
                    'applicant' => 'Fellowship Applicant',
                    'member'    => 'Committee Member',
                    'chair'     => 'Committee Chair',
                    'admin'     => 'System Admin',
                    'developer' => 'Developer',
                    'all'       => 'All'
                );
        
        return $targets;
    }
}
