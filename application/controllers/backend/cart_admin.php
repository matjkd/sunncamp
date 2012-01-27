<?php

class Cart_admin extends MY_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->is_logged_in();
        $this->load->model('content_model');
        $this->load->model('products_model');
        $this->load->model('cat_model');
        $this->load->model('cart_model');
        $this->load->model('menu_model');
    }

    function index() {

        //get all cats for the product menu
        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();

        //list all carts
        $data['cart_list'] = $this->cart_model->list_all_carts();


        $data['main_content'] = "admin/carts/cart_main";
        $data['leftside'] = "admin/dashboard";

        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function view_cart($id) {
        $data['user_id'] = $id;

        //get user details


        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();

// $data['sidebox'] = "sidebox/product_cats";
        $data['cart'] = $this->cart_model->list_cart_contents($data['user_id']);
        $data['main_content'] = "admin/carts/admin_view_cart";
        $data['leftside'] = "admin/dashboard";
        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }
    
    function mark_as_ordered() {
        
        
    }
    
     function mark_as_acknowledged() {
        
        
    }

     function mark_as_dispatched() {
        
        
    }
    
    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $role = $this->session->userdata('role');
        if (!isset($is_logged_in) || $role != 1) {
            $data['message'] = "You don't have permission";
            redirect('welcome/login', 'refresh');
        }
    }

}
