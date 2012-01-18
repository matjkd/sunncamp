<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * get content categories
     * @return type 
     */
    function get_cats() {

        $this->db->order_by('order');
        $query = $this->db->get('categories');


        return $query->result();
    }

    /**
     *
     * @param type $cat_id
     * @param type $product_id
     * @return type 
     */
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

    /**
     *
     * @param type $feature_id
     * @param type $product_id
     * @return type 
     */
    function add_to_feature_link($feature_id, $product_id) {
        //check cat isn't already in links table
        //if not add to list
        $new_list_entry = array(
            'feature_id' => $feature_id,
            'product_id' => $product_id
        );

        $insert = $this->db->insert('product_feature_link', $new_list_entry);
        return $insert;
    }

    /**
     *
     * @param type $feature_id
     * @param type $product_id
     * @return type 
     */
    function add_to_spec_link($spec_id, $spec_value, $product_id) {
        //check spec isn't already in links table
        //if not add to list
        $new_list_entry = array(
            'spec_id' => $spec_id,
            'product_id' => $product_id,
            'spec_value' => $spec_value
        );

        $insert = $this->db->insert('product_spec_link', $new_list_entry);
        return $insert;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
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

    function get_default_image($id) {
        $this->db->where('product_id', $id);
        $this->db->limit(1);
        $query = $this->db->get('product_images');
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return FALSE;
    }

    function get_all_product_cats() {

        $this->db->order_by('product_category_parents.parent_name');

        // this limits it to cats with products in
        $this->db->join('product_category_link', 'product_category_link.product_category_id = product_categories.product_category_id');
        $this->db->join('product_category_parents', 'product_category_parents.parent_id = product_categories.parent');
        $this->db->group_by('product_categories.product_category_name');
        $query = $this->db->get('product_categories');


        return $query->result();
    }

    function get_all_product_parents($populated = 1) {

        $this->db->order_by('product_category_parents.parent_name');
        if ($populated == 1) {
            $this->db->join('product_categories', 'product_categories.parent = product_category_parents.parent_id');

            $this->db->join('product_category_link', 'product_category_link.product_category_id = product_categories.product_category_id');
        }
        $this->db->group_by('product_category_parents.parent_name');
        $query = $this->db->get('product_category_parents');


        return $query->result();
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

        if ($this->input->post('option_category') != NULL) {
            $option_category = ucfirst(strtolower($this->input->post('option_category')));
        } else {
            $option_category = "None";
        }

        if ($this->input->post('option') != NULL) {
            $optionname = ucfirst(strtolower($this->input->post('option')));
        } else {
            $optionname = "None";
        }

        //TODO check if attribute is already part of product, and instead of adding again,
        // add onto/or replace (need to check which is best, maybe bring up an option

        $form_data = array(
            'product_id' => $this->input->post('product_id'),
            'option_category' => $option_category,
            'option' => $optionname,
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

    function get_products_by_cat($category_name) {



        $this->db->join('product_images', 'product_images.product_id=products.product_id', 'left');

        $this->db->join('product_category_link', 'product_category_link.product_id=products.product_id');

        $this->db->join('product_categories', 'product_categories.product_category_id=product_category_link.product_category_id');



        $this->db->where('product_categories.product_category_name', $category_name);

        $this->db->group_by('products.product_name');

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
     * Get product features
     * @return type 
     */
    function get_product_features($product_id) {
        $this->db->where('product_feature_link.product_id', $product_id);
        $this->db->join('product_features', 'product_feature_link.feature_id = product_features.feature_id', 'left');
        $query = $this->db->get('product_feature_link');

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return FALSE;
    }

    /**
     * Get product specs
     * @return type 
     */
    function get_product_specs($product_id) {
        $this->db->where('product_spec_link.product_id', $product_id);
        $this->db->join('product_specifications', 'product_spec_link.spec_id = product_specifications.spec_id', 'left');
        $this->db->order_by('product_spec_link.spec_order');
        $query = $this->db->get('product_spec_link');

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
    function autocomplete_product_features($param) {
        $data = array();



        $where = "feature_name REGEXP '^$param'";
        $this->db->where($where);


        $query = $this->db->get('product_features');

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
    function autocomplete_product_specs($param) {
        $data = array();



        $where = "spec_desc REGEXP '^$param'";
        $this->db->where($where);


        $query = $this->db->get('product_specifications');

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

    function trim_products() {
        $this->db->where('notnull', 0);
        $trim = $this->db->delete('products');
        return $trim;
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

    function create_new_spec($spec) {


        $new_spec_entry = array(
            'spec_desc' => ucfirst(strtolower($spec)),
        );

        $insert = $this->db->insert('product_specifications', $new_spec_entry);
        return $insert;
    }

    function delete_product_category($category_link_id) {

        $this->db->where('category_link_id', $category_link_id);
        $update = $this->db->delete('product_category_link');
        return $update;
    }

    function delete_product_feature($feature_link_id) {

        $this->db->where('feature_link_id', $feature_link_id);
        $update = $this->db->delete('product_feature_link');
        return $update;
    }

    function delete_product_spec($spec_link_id) {

        $this->db->where('spec_link_id', $spec_link_id);
        $update = $this->db->delete('product_spec_link');
        return $update;
    }

    function create_product() {
        $form_data = array(
            'active' => 0,
        );

        $insert = $this->db->insert('products', $form_data);
        return $insert;
    }

    function delete_product($product_id) {
        $this->db->where('product_id', $product_id);

        $delete = $this->db->delete('products');
        return $delete;
    }

    function delete_product_options($product_id) {
        $this->db->where('product_id', $product_id);

        $delete = $this->db->delete('product_options');
        return $delete;
    }

    function delete_product_category_link($product_id) {
        $this->db->where('product_id', $product_id);

        $delete = $this->db->delete('product_category_link');
        return $delete;
    }

    /**
     *
     * @param type $product_id
     * @return type 
     */
    function delete_product_images($product_id) {

        $id = $product_id;
        //delete Large files
        $mydir = './images/products/' . $id . '/large/';
        $d = dir($mydir);
        while ($entry = $d->read()) {
            if ($entry != "." && $entry != "..") {
                unlink($mydir . $entry);
            }
        }
        $d->close();
        rmdir($mydir);

        //delete Medium files
        $mydir = './images/products/' . $id . '/medium/';
        $d = dir($mydir);
        while ($entry = $d->read()) {
            if ($entry != "." && $entry != "..") {
                unlink($mydir . $entry);
            }
        }
        $d->close();
        rmdir($mydir);

        //delete thumbs files
        $mydir = './images/products/' . $id . '/thumbs/';
        $d = dir($mydir);
        while ($entry = $d->read()) {
            if ($entry != "." && $entry != "..") {
                unlink($mydir . $entry);
            }
        }
        $d->close();
        rmdir($mydir);

        //delete root files
        $mydir = './images/products/' . $id . '/';
        $d = dir($mydir);
        while ($entry = $d->read()) {
            if ($entry != "." && $entry != "..") {
                unlink($mydir . $entry);
            }
        }
        $d->close();
        rmdir($mydir);

        //delete database entries
        $this->db->where('product_id', $product_id);

        $delete = $this->db->delete('product_images');
        return $delete;
    }

    function edit_product($id) {


        $content_update = array(
            'product_desc' => $this->input->post('product_desc'),
            'product_name' => $this->input->post('product_name'),
            'product_ref' => $this->input->post('product_ref'),
            'notnull' => 1
        );




        $this->db->where('product_id', $id);
        $update = $this->db->update('products', $content_update);
        return $update;
    }

}
