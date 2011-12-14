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

    function add_to_category_link($cat_id, $product_id) {
        //check cat isn't already in links table
        //if not add to list
        $new_list_entry = array(
            'product_category_id' => $cat_id,
            'product_id' => $product_id
        );

        $insert = $this->db->insert('product_category_link', $new_list_entry);
        return $insert;
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
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return FALSE;
    }

    /**
     * Get product categories
     * @return type 
     */
    function get_product_categories($product_id) {
        $this->db->where('product_category_link.product_id', $product_id);
        $this->db->join('product_categories', 'product_category_link.product_category_id = product_categories.product_category_id', 'left');
        $query = $this->db->get('product_category_link');

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return FALSE;
    }

    /**
     *
     * @param type $param
     * @return type 
     */
    function autocomplete_product_categories($param) {
        $data = array();



        $where = "product_category_name REGEXP '^$param'";
        $this->db->where($where);


        $query = $this->db->get('product_categories');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
            $query->free_result();

            return $data;
        } else {
            return FALSE;
        }
    }

    /**
     *
     * @param type $param
     * @return type 
     */
    function autocomplete_product_options($param) {
        $data = array();

        $where = "option_category REGEXP '^$param'";
        $this->db->where($where);
        $this->db->group_by('option_category ');


        $query = $this->db->get('product_options');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
            $query->free_result();

            return $data;
        } else {
            return FALSE;
        }
    }

    /**
     * Get product potion  categories
     * @return type 
     */
    function get_option_categories() {

        $query = $this->db->get('product_options');
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return FALSE;
    }

    /**
     * 
     */
    function update_option($option_id) {
        $option_update = array(
            'option_category' => ucfirst(strtolower($this->input->post('option_category'))),
            'option' => ucfirst(strtolower($this->input->post('option'))),
            'stock_level' => $this->input->post('stock_level'),
            'updated' => now()
        );




        $this->db->where('option_id', $option_id);
        $update = $this->db->update('product_options', $option_update);
        return $update;
    }

    function delete_option($option_id) {

        $this->db->where('option_id', $option_id);
        $update = $this->db->delete('product_options');
        return $update;
    }

    /**
     *
     * @param type $category
     * @return type 
     */
    function create_new_cat($category) {


        $new_cat_entry = array(
            'product_category_name' => ucfirst(strtolower($category)),
        );

        $insert = $this->db->insert('product_categories', $new_cat_entry);
        return $insert;
    }

    function delete_product_category($category_link_id) {

        $this->db->where('category_link_id', $category_link_id);
        $update = $this->db->delete('product_category_link');
        return $update;
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
