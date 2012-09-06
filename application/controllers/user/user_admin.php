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

    function index($company = 0) {

        redirect('user/user_admin/list_companies');
    }

    function _prep_password($password) {
        return sha1($password . $this->config->item('encryption_key'));
    }

    function list_companies($company = 0) {

        $data['main_content'] = "admin/users/main";
        $data['leftside'] = "admin/dashboard";
        $data['companies'] = $this->company_model->get_companies();
        $data['company'] = $this->company_model->get_company($company);
        $data['users'] = $this->company_model->get_users($company);
        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();
        $data['company_categories'] = $this->company_model->get_company_parent_cats($company);
        
        
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }

        $this->load->vars($data);
        $this->load->view('template/sunncamp/admin');
    }

    function view_user($user_id) {
        $data['main_content'] = "admin/users/view_user";
        $data['leftside'] = "admin/dashboard";

        $data['user'] = $this->company_model->get_user($user_id);
        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }

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

    function update_company() {

        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        if ($this->form_validation->run() == FALSE) {
            //$this->session->set_flashdata('message', validation_errors());
            $this->alertmessage = "Error " . validation_errors();
            $this->create_company();
        } else {

            // add company
            $company_id = $this->input->post('company_id');
            $this->company_model->update_company($company_id);

            //add company addresss
            $address_id = $this->input->post('address_id');
            $this->company_model->update_address($address_id);

            $this->session->set_flashdata('message', 'company updated');
            redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
        }
    }

    function add_company() {
        //Validate Form here
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        if ($this->form_validation->run() == FALSE) {
            //$this->session->set_flashdata('message', validation_errors());
            $this->alertmessage = "Error " . validation_errors();
            $this->create_company();
        } else {

            // add company
            $this->company_model->add_company();
            $company_id = $this->db->insert_id();
            //add company addresss
            $this->company_model->add_address($company_id);

            $this->session->set_flashdata('message', 'company added');
            redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
        }
    }

    function deactivate_user() {
        $user_id = $this->input->post('user_id');
        $this->company_model->deactivate_user($user_id);
    }

    function delete_company() {
        //get company id
        $company_id = $this->input->post('company_id');
        if ($company_id == 0) {

            echo "This Company is protected";
        } else {
            $this->company_model->deactivate_users($company_id);
            $this->company_model->remove_addresses($company_id);
            $this->company_model->delete_company($company_id);

            echo "Company Deleted";
        }
    }

    /**
     * 
     */
    function add_cat_to_company() {
        $company_id = $this->input->post('company_id');
        $category_id = $this->input->post('category_id');

        if ($this->company_model->add_cat_to_company($company_id, $category_id)) {
            echo "success";
        } else {
            echo "failed";
        }
        redirect('/user/user_admin/list_companies/'.$company_id);
    }
    
    function remove_company_cat() {
        
        $company_cat_id = $this->input->post('company_cat_id');
         if ($this->company_model->delete_company_cat_id($company_cat_id)) {
            echo "success";
        } else {
            echo "failed";
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

