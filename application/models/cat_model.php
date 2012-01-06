<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cat_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function create_parent() {
        
        $parent_name = $this->input->post('category_parent');
         $new_cat_parent = array(
            'parent_name' => $parent_name
        );

        $insert = $this->db->insert('product_category_parents', $new_cat_parent);
        return $insert;
    }
    
    function change_parent($drag, $drop) {
        
        
         $new_cat_parent = array(
            'parent' => $drop
        );
         $this->db->where('product_category_name', $drag);
         $update = $this->db->update('product_categories', $new_cat_parent);
        return $insert;
    }
    
}
