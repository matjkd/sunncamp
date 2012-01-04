<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_content($title) {

        $this->db->where('menu', $title);
        $query = $this->db->get('content');
        if ($query->num_rows == 1)
            ; {
            return $query->result();
        }
    }

    function get_seo_links() {
        $this->db->select('menu, title, content_id');
        $this->db->where('category', 'seo');
        $query = $this->db->get('content');
        if ($query->num_rows > 0)
            ; {
            return $query->result();
        }
    }

    function get_content_id($id) {

        $this->db->where('content_id', $id);
        $query = $this->db->get('content');
        if ($query->num_rows == 1)
            ; {
            return $query->result();
        }
    }

    function edit_content($id) {


        $content_update = array(
            'content' => $this->input->post('content'),
            'menu' => $this->input->post('menu'),
            'title' => $this->input->post('title'),
            'extra' => $this->input->post('extra'),
            'sidebox' => $this->input->post('sidebox')
        );




        $this->db->where('content_id', $id);
        $update = $this->db->update('content', $content_update);
        return $update;
    }

    function get_all_content() {
        $query = $this->db->get('content');
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }
    
    
/**
 *
 * @param type $cat
 * @return type 
 */
    function get_all_products($cat = NULL) {


        $this->db->join('products', 'product_options.product_id = products.product_id', 'right');

//Filter by category
        if ($cat != NULL && $cat !=0) {
            $this->db->join('product_category_link', 'products.product_id = product_category_link.product_id', 'left');
            $this->db->where('product_category_link.product_category_id', $cat);
        }

        $query = $this->db->get('product_options');
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_all_news() {

        $this->db->where('content_type', 'news');
        $this->db->orderby('content_id', 'desc');
        $query = $this->db->get('content');
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_news($id) {

        $this->db->where('menu', $id);
        $query = $this->db->get('content');
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_service_groups() {

        $query = $this->db->get('service_groups');
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_services() {
        $query = $this->db->get('services');
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function latest_news() {
        $this->db->where('content_type', 'news');
        $this->db->orderby('content_id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('content');
        if ($query->num_rows == 1) {
            return $query->result();
        }
    }

    function add_content() {

        // build array for the model
        $name = "" . $this->session->userdata('firstname') . " " . $this->session->userdata('lastname') . "";
        $format = 'DATE_RFC1123';
        $now = time();
        $datetime = $now;
        $form_data = array(
            'title' => set_value('title'),
            'content' => $this->input->post('content'),
            'menu' => $this->input->post('menu'),
            'category' => set_value('category'),
            'added_by' => $name,
            'date_added' => $datetime
        );
        $insert = $this->db->insert('content', $form_data);
        return $insert;
    }

}