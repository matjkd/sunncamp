<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_cats() {

        $this->db->order_by('order');
        $query = $this->db->get('categories');


        return $query->result();
    }

    function get_product($id) {

        $this->db->where('product_id', $id);
        $query = $this->db->get('products');
        if ($query->num_rows == 1) {
            return $query->result();
        }

        return FALSE;
    }

    function get_product_images($id) {
        $this->db->where('product_id', $id);
        $query = $this->db->get('product_images');
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return FALSE;
    }

    function get_attributes($id) {
        $this->db->where('product_id', $id);
        $this->db->order_by('option_category');
        $query = $this->db->get('product_options');
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return FALSE;
    }

    function add_attribute() {
        $form_data = array(
            'product_id' => $this->input->post('product_id'),
            'option_category' => ucfirst(strtolower($this->input->post('option_category'))),
            'option' => ucfirst(strtolower($this->input->post('option'))),
            'stock_level' => $this->input->post('stock_level'),
        );

        $insert = $this->db->insert('product_options', $form_data);
        return $insert;
    }

    function get_all_products() {
        $this->db->join('cat_links', 'cat_links.product_id=products.product_id');
        $query = $this->db->get('products');
        if ($query->num_rows > 0)
            ; {
            return $query->result();
        }

        return FALSE;
    }
    
    function get_product_categories() {
        
        
    }

    function create_product() {
        $form_data = array(
            'active' => 0,
        );

        $insert = $this->db->insert('products', $form_data);
        return $insert;
    }

    function delete_product() {
        
    }

    function edit_product($id) {


        $content_update = array(
            'product_desc' => $this->input->post('product_desc'),
            'product_name' => $this->input->post('product_name'),
        );




        $this->db->where('product_id', $id);
        $update = $this->db->update('products', $content_update);
        return $update;
    }

}
