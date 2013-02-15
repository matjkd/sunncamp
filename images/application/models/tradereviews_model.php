<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tradereviews_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
   
     function get_trade_reviews() {
    
$this->db->order_by('trade_review_id', 'DESC');      
        $query = $this->db->get('trade_reviews');


        return $query->result();
    }
    
    function add_trade_review($filename) {
      $name = $this->input->post('name');
    if($name == 'Name') {
    $name = $filename;
    }
    
    $new_manual_data = array(
                'trade_review_title' => $name,
                'trade_review_filename' => $filename
            );

   
            $this->db->insert('trade_reviews', $new_manual_data);
        
    
    }
    
    function delete_trade_review($filename, $id) {
    
     $this->db->where('trade_review_id', $id);
       
     $this->db->delete('trade_reviews');
    
     $this->gallery_path = "./images/trade_reviews";
     unlink($this->gallery_path . '/' . $filename);
     return TRUE;
     
    }
    
}
