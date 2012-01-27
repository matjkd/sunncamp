<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manuals_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_manual_cats() {
    
        $this->db->order_by('manual_order');
        $query = $this->db->get('manual_cats');


        return $query->result();
    }
     function get_manuals() {
    
      
        $query = $this->db->get('manuals');


        return $query->result();
    }
    
    function add_manual($filename) {
    $name = $this->input->post('catname');
    if($name = 'Name') {
    $name = $filename;
    }
    $category = $this->input->post('man_cat');
    $new_manual_data = array(
                'manual_title' => $name,
                'manual_filename' => $filename,
                'manual_category' => $category
            );

   
            $this->db->insert('manuals', $new_manual_data);
        
    
    }
    
    function delete_manual($filename, $id) {
    
     $this->db->where('manual_id', $id);
       
     $this->db->delete('manuals');
    
     $this->gallery_path = "./images/manuals";
     unlink($this->gallery_path . '/' . $filename);
     return TRUE;
     
    }
    
}
