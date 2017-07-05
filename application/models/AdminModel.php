<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        
        //Custom helper
        $this->load->helper('common_helper');
    }

    
    /*
     *  Add security alerts
     */
    public function addAlerts($data) {
        return $this->db->insert('scan_alerts', $data);
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
     * Update alert details
     */
    public function editAlert($data, $id){
        $query = $this->db->get_where("scan_alerts", array('id'=>$id));
        
        if($query->num_rows() == 1){
            $this->db->where('id', $id);
            return $this->db->update('scan_alerts', $data);
        }else{
            return false;
        }
        
    }
    
        
    /**
     * Delete alert
     */
    public function deleteAlert($id){
        $query = $this->db->get_where("scan_alerts", array('id'=>$id));
        
        if($query->num_rows() == 1){
            $this->db->where('id', $id);
            return $this->db->delete('scan_alerts', array('id'=>$id));
        }else{
            return false;
        }
    }

}
