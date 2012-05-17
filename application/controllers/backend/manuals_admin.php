<?php

class Manuals_admin extends MY_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->is_logged_in();
        $this->load->model('content_model');
        $this->load->model('products_model');
        $this->load->model('gallery_model');
        $this->load->model('manuals_model');
        $this->load->model('menu_model');
        $this->load->library('s3');
    }

    function index() {
        $id = $this->uri->segment(3);
        $data['menu'] = $id;
        $data['page'] = $id;
        $data['content'] = $this->products_model->get_product($id);
        $data['leftside'] = "admin/dashboard";
        $data['main_content'] = "admin/manuals/manuals_main";
        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();


        //get all manuals
        $data['manuals'] = $this->manuals_model->get_manuals();

        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }
        $data['manuals_cats'] = $this->manuals_model->get_manual_cats();

        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function do_upload() {
        $config['upload_path'] = './images/manuals/';
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

            $this->manuals_model->add_manual($filename);
            $this->session->set_flashdata('message', "File added.");
            
            
            //upload manual to s3
            $filelocation = "manuals/".$filename;
            $thefile = file_get_contents($this->config_base_path."images/manuals/".$filename, true);
            
            $this->s3->putObject($thefile, $this->bucket, $filelocation, S3:: ACL_PUBLIC_READ);
            
            redirect('backend/manuals_admin', 'refresh');
        }
    }

    function delete_manual() {

        $filename = $this->input->post('filename');
        $manual_id = $this->input->post('manual_id');

        if ($this->manuals_model->delete_manual($filename, $manual_id)) {
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
