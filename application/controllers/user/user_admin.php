<?php

class User_admin extends MY_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->is_logged_in();
        $this->load->model('content_model');
        $this->load->model('products_model');
        $this->load->model('cat_model');
        $this->load->model('company_model');
        $this->load->model('menu_model');
    }

    function index() {




        $data['main_content'] = "admin/users/main";
        $data['leftside'] = "admin/dashboard";

    

        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();


        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function create_company() {


        $data['main_content'] = "admin/users/create_company";
        $data['leftside'] = "admin/dashboard";

        $cat = $this->input->post('cats');
        $data['users'] = $this->content_model->get_all_products($cat);

        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();
        if (isset($this->alertmessage)) {
            $data['message'] = $this->alertmessage;
        }

        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function add_company() {
        //Validate Form here
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            $this->alertmessage = "Error ".validation_errors();
            $this->create_company();
        } else {
            
            // add company
            $this->company_model->add_company();
            $company_id = $this->db->insert_id(); 
            //add company addresss
            $this->company_model->add_address($company_id);
            
            echo "success";
        }
    }

        function create_user() {
            
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

    