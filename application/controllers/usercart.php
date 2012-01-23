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
        echo "hello.";
    }
    
    function view_cart() {
   $data['user_id'] = $this->session->userdata('user_id');
     $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();
       // $data['sidebox'] = "sidebox/product_cats";
      $data['cart'] = $this->cart_model->list_cart_contents($data['user_id']);
        $data['main_content'] = "cart/view_cart";

        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function change_stock_level() {
        
        $user_id = $this->input->post('user_id');
        $option_id = $this->input->post('option_id');
        $sum = $this->input->post('sum');

        $query = $this->cart_model->update_stock($user_id, $option_id, $sum);
        echo $sum;
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
        if ($is_logged_in == NULL || $role > 5) {
            $data['message'] = "You don't have permission";
            redirect('welcome/login', 'refresh');
        }
    }

}
