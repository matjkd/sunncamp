<?php

class Admin extends MY_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->is_logged_in();
        $this->load->model('content_model');
        $this->load->model('products_model');
        $this->load->model('menu_model');
    }

    function index() {
        $data['main_content'] = "admin/dashboard";
        $data['pages'] = $this->content_model->get_all_content();
        $data['seo_links'] = $this->content_model->get_seo_links();
        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function content() {
        if (($this->uri->segment(3)) < 1) {
            $id = 1;
        } else {
            $id = $this->uri->segment(3);
        }
        $data['content'] = $this->content_model->get_content($id);
        $data['main'] = "pages/dynamic";
        $data['edit'] = "admin/edit/$id";
        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function edit() {


        $id = $this->uri->segment(3);
        $data['menu'] = $id;
        $data['page'] = $id;
        $data['content'] = $this->content_model->get_content_id($id);
        $data['seo_links'] = $this->content_model->get_seo_links();
        $data['main_content'] = "admin/edit_content";



        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function edit_product() {


        $id = $this->uri->segment(3);
        $data['menu'] = $id;
        $data['page'] = $id;
        $data['content'] = $this->products_model->get_product($id);

        $data['main_content'] = "admin/edit_product";


        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function edit_content() {
        $this->form_validation->set_rules('menu', 'menu', 'trim|required');
        if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
            echo "validation error";
        } else { // passed validation proceed to post success logic
            $id = $this->uri->segment(3);
            $this->content_model->edit_content($id);

            redirect("admin/edit/$id");
        }
    }

  
  
    function submit_content() {
        $this->form_validation->set_rules('title', 'Title', 'trim|max_length[255]');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        $this->form_validation->set_rules('menu', 'menu', 'trim|required');
        $this->form_validation->set_rules('category', 'Page Type', 'trim|max_length[11]');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
            echo "validation error";
        } else { // passed validation proceed to post success logic
            if ($this->content_model->add_content()) { // the information has therefore been successfully saved in the db
                redirect('/admin');   // or whatever logic needs to occur
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }
    
    
/**
 * 
 */
    function add_product($product_id = 0) {
        
        //first create a blank product and retrieve an ID
        // TODO only add product if coming from correct button
        if($product_id == 0){
        $this->products_model->create_product();
        $data['product_id'] = mysql_insert_id();
        } else {
             $data['product_id'] = $product_id;
        }
        $data['product'] = $this->products_model->get_product($data['product_id']);
        $data['main_content'] = "global/add_product";
        
        $this->load->vars($data);
        $this->load->view('template/main');
    }
    
    
     function update_product($product_id) {
        $this->form_validation->set_rules('product_name', 'product name', 'trim|required');
        if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
            echo "validation error";
        } else { // passed validation proceed to post success logic
            
            $this->products_model->edit_product($product_id);

            redirect("admin/add_product/$product_id");
        }
    }

    
   /**
    * sort the images for a product
    */ 
     function ajaxsort() {
        $pages = $this->input->post('pageorder');



        $pages = str_replace("pageorder;[]", "pageorder[]", $pages);
        echo $pages;
        parse_str($pages, $pageOrder);

        foreach ($pageOrder['pageorder'] as $key => $value):
            echo $key;
            mysql_query("UPDATE ignite_product_images SET `order` = '$key' WHERE `product_image_id` = '$value'") or die(mysql_error());



        endforeach;
    }

    function add_menu() {
        $data['main_content'] = "admin/add_menu";
        $data['cats'] = $this->products_model->get_cats();
        $data['products'] = $this->products_model->get_all_products();
        $data['section2'] = 'global/links';
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }

        $data['slideshow'] = 'header/slideshow';
        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function view_menus() {
        $data['main_content'] = "admin/view_menus";
        $data['page'] = 'practices';
        $data['menus'] = $this->menu_model->get_menus();

        $data['slideshow'] = 'header/slideshow';
        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function add_new_menu() {
        $this->menu_model->add_menu();
        return;
    }

    function update_menu() {
        echo $this->input->post('published');
        $this->menu_model->update_menu();
        //  return;
    }

    function edit_menu($id) {
        $data['main_content'] = "admin/edit_menu";
        $data['menudata'] = $this->menu_model->get_menu($id);
        $data['cats'] = $this->products_model->get_cats();
        $data['products'] = $this->products_model->get_all_products();
        $data['section2'] = 'global/links';
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }

        $data['slideshow'] = 'header/slideshow';
        $this->load->vars($data);
        $this->load->view('template/main');
    }

 

  

    function do_upload() {
        if (isset($_FILES['file'])) {
            $file = read_file($_FILES['file']['tmp_name']);
            $name = basename($_FILES['file']['name']);
            $name = str_replace(' ', '_', $name);
            $name = str_replace(',', '', $name);
            write_file('uploads/' . $name, $file);

            $this->cases_model->add($name);
            redirect('cases/view');
        }

        else
            $this->load->view('upload');
    }

    function add_content() {
        $data['main_content'] = "admin/add_content";
        $data['pages'] = $this->content_model->get_all_content();

        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function add_seo_content() {
        $data['main_content'] = "admin/add_content";
        $data['seo_links'] = $this->content_model->get_seo_links();
        $data['pages'] = $this->content_model->get_all_content();
        $data['category'] = "seo";
        $this->load->vars($data);
        $this->load->view('template/main');
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