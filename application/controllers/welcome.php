<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('captcha_model');
         $this->load->model('products_model');
    }

    /**
     * do something about this index cos it duplicates welcome/home
     */
    public function index() {
        $segment_active = $this->uri->segment(2);
        if ($segment_active != NULL) {
            $data['menu'] = $this->uri->segment(2);
        } else {
            $data['menu'] = 'home';
        }

        $data['content'] = $this->content_model->get_content($data['menu']);
        $data['captcha'] = $this->captcha_model->initiate_captcha();
        $data['seo_links'] = $this->content_model->get_seo_links();
          $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();
        foreach ($data['content'] as $row):

            $data['title'] = $row->title;
            $data['sidebox'] = $row->sidebox;
            $data['metatitle'] = $row->meta_title;
            $data['meta_description'] = $row->meta_desc;
            $data['slideshow'] = $row->slideshow;
        endforeach;
        $data['sidebar'] = "sidebox/side";
        $data['main_content'] = "global/" . $this->config_theme . "/content";

        $data['section2'] = 'global/links';
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }


        $this->load->vars($data);
        $this->load->view('template/main');
    }

    /**
     * the main page layout controller
     */
    function home() {

        $segment_active = $this->uri->segment(3);
        if ($segment_active != NULL) {
            $data['menu'] = $this->uri->segment(3);
        } else {
            $data['menu'] = $this->uri->segment(1);
        }

        $data['content'] = $this->content_model->get_content($data['menu']);
        $data['captcha'] = $this->captcha_model->initiate_captcha();
        foreach ($data['content'] as $row):

            $data['title'] = $row->title;
            $data['sidebox'] = $row->sidebox;
            $data['metatitle'] = $row->meta_title;
            $data['meta_description'] = $row->meta_desc;
            $data['slideshow'] = $row->slideshow;

        endforeach;
        $data['sidebar'] = "sidebox/side";
           $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();
        $data['main_content'] = "global/" . $this->config_theme . "/content";

        $data['section2'] = 'global/links';
        $data['seo_links'] = $this->content_model->get_seo_links();
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }


        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function login() {
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }
        $id = 'login';
        $data['content'] = $this->content_model->get_content($id);
           $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();
        $data['main_content'] = "user/login_form";
        $data['title'] = "Login to SunnCamp";

        $data['page'] = "login";
        $this->load->vars($data);
        $this->load->view('template/main');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
