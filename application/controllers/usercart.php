<?php

class Usercart extends MY_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->is_logged_in();
        $this->load->model('content_model');
        $this->load->model('products_model');
        $this->load->model('cart_model');
        $this->load->model('menu_model');
    }

    function index() {
        echo "hello";
    }

    function change_stock_level() {
        $option_id = $this->input->post('option_id');
        $value = $this->input->post('stock_value');

        $this->cart_model->change_stock($option_id, $value);
        
    }

    function change_cart_quantity() {
        $option_id = $this->input->post('option_id');
        $user_id = $this->input->post('user_id');
        $cart_value = $this->input->post('cart_value');

        $this->cart_model->update_cart($option_id, $user_id, $cart_value);
    }

    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $role = $this->session->userdata('role');
        if (!isset($is_logged_in) || $role > 5) {
            $data['message'] = "You don't have permission";
            redirect('welcome/login', 'refresh');
        }
    }

}