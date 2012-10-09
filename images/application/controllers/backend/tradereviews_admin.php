<?php

class Tradereviews_admin extends MY_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->is_logged_in();
        $this->load->model('content_model');
        $this->load->model('products_model');
        $this->load->model('gallery_model');
        $this->load->model('tradereviews_model');
        $this->load->model('menu_model');
    }

    function index() {
        $id = $this->uri->segment(3);
        $data['menu'] = $id;
        $data['page'] = $id;
        $data['content'] = $this->products_model->get_product($id);
        $data['leftside'] = "admin/dashboard";
        $data['main_content'] = "admin/trade_reviews/trade_reviews_main";
        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();


        //get all manuals
        $data['trade_reviews'] = $this->tradereviews_model->get_trade_reviews();

        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }
       

        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function do_upload() {
        $config['upload_path'] = './images/trade_reviews/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
        $config['max_size'] = '10000';

        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());

            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            foreach ($data as $row):

                $filename = $row['file_name'];
            endforeach;

            $this->tradereviews_model->add_trade_review($filename);
            $this->session->set_flashdata('message', "File added.");
            redirect('backend/tradereviews_admin', 'refresh');
        }
    }

    function delete_trade_review() {

        $filename = $this->input->post('filename');
        $id = $this->input->post('trade_review_id');

        if ($this->tradereviews_model->delete_trade_review($filename, $id)) {
            echo "deleted";
        } else {
            echo "delete failed";
        }
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
