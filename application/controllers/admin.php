<?php

class Admin extends MY_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->is_logged_in();
        $this->load->model('content_model');
        $this->load->model('products_model');
        $this->load->model('gallery_model');
        $this->load->model('menu_model');
    }

    function index() {
        $data['main_content'] = "admin/dashboard";
        $data['pages'] = $this->content_model->get_all_content();
        $data['seo_links'] = $this->content_model->get_seo_links();
        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
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
        $this->load->view('template/sunncamp/admin');
    }

    function edit() {


        $id = $this->uri->segment(3);
        $data['menu'] = $id;
        $data['page'] = $id;
        $data['content'] = $this->content_model->get_content_id($id);
        $data['seo_links'] = $this->content_model->get_seo_links();
        $data['main_content'] = "admin/edit_content";



        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function edit_product() {


        $id = $this->uri->segment(3);
        $data['menu'] = $id;
        $data['page'] = $id;
        $data['content'] = $this->products_model->get_product($id);

        $data['main_content'] = "admin/edit_product";


        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    /**
     * 
     */
    function edit_attribute() {


        $submitted = $this->input->post('submit');
        $option_id = $this->input->post('option_id');
        $product_id = $this->input->post('product_id');

        if ($submitted == 'Update') {
            $this->form_validation->set_rules('option_category', 'Option Category', 'trim');
            $this->form_validation->set_rules('option', 'Option', 'trim');
            $this->form_validation->set_rules('stock_level', 'Stock Level', 'trim|required');

            $this->products_model->update_option($option_id);
        }

        if ($submitted == 'X') {


            $this->products_model->delete_option($option_id);
        }
        redirect("admin/add_product/$product_id");
    }

    /**
     * 
     */
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

    /**
     * 
     */
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

        // First create a blank product and retrieve an ID
        // TODO only add product if coming from correct button
        if ($product_id == 0) {
            $this->products_model->create_product();
            $data['product_id'] = mysql_insert_id();
        } else {
            $data['product_id'] = $product_id;
        }

        $data['leftside'] = "admin/product_sidebox";
        $data['images'] = $this->products_model->get_product_images($data['product_id']);
        $data['product'] = $this->products_model->get_product($data['product_id']);
        $data['categories'] = $this->products_model->get_product_categories($data['product_id']);

        $data['attributes'] = $this->products_model->get_attributes($data['product_id']);
        $data['main_content'] = "global/add_product";

        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    /**
     *
     * @param type $product_id 
     */
    function update_product($product_id) {

        $this->form_validation->set_rules('product_name', 'product name', 'trim|required');
        if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
            echo validation_errors();
        } else { // passed validation proceed to post success logic
            $this->products_model->edit_product($product_id);

            redirect("admin/add_product/$product_id");
        }
    }

    /**
     *
     * @param type $id 
     */
    function add_product_category($id) {

        $category = $this->input->post('product_category');
        //check if category name is in database already
        $catdata = $this->products_model->autocomplete_product_categories($category);
        if ($catdata) {

            // The cat is in the database already
            // now add to the cat  list
            foreach ($catdata as $row):
                $cat_id = $row['product_category_id'];
            endforeach;
            $this->products_model->add_to_category_link($cat_id, $id);


            echo "they are in there";
        } else {

            // The cat isn't in the database
            // TODO check for similar names
            // add to database, then add to users list
            $this->products_model->create_new_cat($category);
            $cat_id = $this->db->insert_id();
            $this->products_model->add_to_category_link($cat_id, $id);
            echo "new cat";
        }

        redirect("admin/add_product/$id");
    }

    function remove_category($id) {
        $category_link_id = $this->input->post('category_link_id');
        $this->products_model->delete_product_category($category_link_id);

        redirect("admin/add_product/$id");
    }

    /**
     * 
     */
    function upload_image() {


        $id = $this->input->post('product_id');
        $this->gallery_path = "images/products";

        //check file path exists.
        //maybe extend this check for each subfolder in future

        $path = $this->config_base_path . $this->gallery_path . '/' . $id . '/';

        //create directories if required
        if (file_exists($path)) {

            // folder exists
        } else {

            //create folders
            mkdir('' . $this->config_base_path . $this->gallery_path . '/' . $id . '/');
            mkdir('' . $this->config_base_path . $this->gallery_path . '/' . $id . '/thumbs/');
            mkdir('' . $this->config_base_path . $this->gallery_path . '/' . $id . '/medium/');
            mkdir('' . $this->config_base_path . $this->gallery_path . '/' . $id . '/large/');
        }



        if ($this->input->post('upload')) {
            $this->gallery_model->do_upload($id);
        }

        redirect("admin/add_product/$id");
    }

    /**
     * 
     */
    function delete_image() {
        //set variables
        $product_id = $this->input->post('id');
        $image_id = $this->input->post('image_id');
        $this->gallery_path = "./images/products";

        //get image data first
        $this->db->from('product_images');
        $this->db->where('product_image_id', $image_id);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();

        if ($query->num_rows == 1) {

            foreach ($query->result_array() as $row):

                $filename = $row['filename'];


            endforeach;
        }

        //delete image data
        $this->db->where('product_image_id', $image_id);
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_images');

        //delete images from server

        unlink($this->gallery_path . '/' . $product_id . '/' . $filename . '');
        // unlink($this->gallery_path . '/' . $product_id . '/large/' . $filename . '');
        unlink($this->gallery_path . '/' . $product_id . '/medium/' . $filename . '');
        unlink($this->gallery_path . '/' . $product_id . '/thumbs/' . $filename . '');


        redirect("admin/add_product/$product_id");
    }

    /**
     * 
     */
    function add_attribute($id) {
        $this->form_validation->set_rules('option_category', 'option category', 'trim|max_length[255]');
        $this->form_validation->set_rules('option', 'option', 'trim');
        $this->form_validation->set_rules('stock_level', 'stock level', 'trim|required');
        if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
            echo "validation error";
        } else { // passed validation proceed to post success logic
            if ($this->products_model->add_attribute()) { // the information has therefore been successfully saved in the db
                redirect('/admin/add_product/' . $id);   // or whatever logic needs to occur
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
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
        $this->load->view('template/sunncamp/admin');
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
        $this->load->view('template/sunncamp/admin');
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
        $this->load->view('template/sunncamp/admin');
    }

    function add_seo_content() {
        $data['main_content'] = "admin/add_content";
        $data['seo_links'] = $this->content_model->get_seo_links();
        $data['pages'] = $this->content_model->get_all_content();
        $data['category'] = "seo";
        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function list_products($cat = NULL) {

        //trim products with no data
        $this->products_model->trim_products();

        $data['main_content'] = "admin/list_products";
        $data['leftside'] = "admin/productlist_sidebox";

        $cat = $this->input->post('cats');
        $data['products'] = $this->content_model->get_all_products($cat);


        $data['categories'] = $this->products_model->get_all_product_cats();

        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function delete_product() {

        $product_id = $this->input->post('product_id');

        //delete product images
        $this->products_model->delete_product_images($product_id);

        //delete product options
        $this->products_model->delete_product_options($product_id);

        //delete category links
        $this->products_model->delete_product_category_link($product_id);
        
        //delete product
        $this->products_model->delete_product($product_id);
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