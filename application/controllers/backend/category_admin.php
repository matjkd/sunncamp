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
        
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }

        $data['allcategories'] = $this->products_model->get_all_product_cats();
        $data['allcategory_parents'] = $this->products_model->get_all_product_parents(0);

        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function add_category_parent() {
        $this->form_validation->set_rules('category_parent', 'Parent Category', 'trim|required');
        if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
            $this->session->set_flashdata('message', "Field must not be blank");
            redirect('/backend/category_admin');
        } else { // passed validation proceed to post success logic
            $this->cat_model->create_parent();
            redirect('/backend/category_admin');
        }
    }

    function change_parent() {
        $drag = $this->input->post('drag');

        $drop = $this->input->post('drop');


        $this->cat_model->change_parent($drag, $drop);
      
        
   
        
        return;
    }
    
    function change_cat_order() {
    	
    	$pages = $this->input->post('pages');
    	parse_str($pages, $pageOrder);
    	
    	// list id is retrieved from the ID on the sortable list
    	foreach ($pageOrder['pageorder'] as $key => $value):
    	
    	mysql_query("UPDATE ignite_product_categories SET `product_category_order` = '$key' WHERE `product_category_id` = '$value'") or die(mysql_error());
    	
    	
    	
    	//$this->db->update('practice_area_links', $pro_update);
    	endforeach;
    	
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
