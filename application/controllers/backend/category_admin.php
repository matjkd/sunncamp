<?php

class Category_admin extends MY_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->is_logged_in();
        $this->load->model('content_model');
        $this->load->model('products_model');
        $this->load->model('cat_model');
        $this->load->model('gallery_model');
        $this->load->model('menu_model');
    }

    function index() {


        //trim products with no data
        $this->products_model->trim_products();

        $data['main_content'] = "admin/cats/cat_main";
        $data['leftside'] = "admin/cats/cat_sidebox";

        $cat = $this->input->post('cats');
        $data['products'] = $this->content_model->get_all_products($cat);

        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();


        $data['allcategories'] = $this->products_model->get_all_product_cats();
        $data['allcategory_parents'] = $this->products_model->get_all_product_parents(0);

        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function add_category_parent() {

        $this->cat_model->create_parent();
        redirect('/backend/category_admin');
    }

    function change_parent() {
        $drag = $this->input->post('drag');

        $drop = $this->input->post('drop');


        $this->cat_model->change_parent($drag, $drop);
        return;
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
