<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Datasource extends CI_Controller {

    /**
     * 
     */
    function Datasource() {
        parent::__construct();
        $this->load->model('products_model');
        $this->is_logged_in();
    }

    public function index() {
        
    }

    public function json_categories() {
        $term = $this->input->post('term');
        $data['source'] = $this->products_model->autocomplete_product_categories($term);
        $this->load->vars($data);
        $this->load->view('template/json');
    }
    
     public function json_features() {
        $term = $this->input->post('term');
        $data['source'] = $this->products_model->autocomplete_product_features($term);
        $this->load->vars($data);
        $this->load->view('template/json_features');
    }
    
    
     public function json_specs() {
        $term = $this->input->post('term');
        $data['source'] = $this->products_model->autocomplete_product_specs($term);
        $this->load->vars($data);
        $this->load->view('template/json_specs');
    }
    
        public function json_options() {
        $term = $this->input->post('term');
        $data['source'] = $this->products_model->autocomplete_product_options($term);
        $this->load->vars($data);
        $this->load->view('template/json_options');
    }

    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            $data['message'] = "You don't have permission";
            redirect('user/login');
        }
    }

}

/* End of file datasource.php */
/* Location: ./application/controllers/datasource.php */