<?php

class Login extends MY_Controller {

    function Login() {
        parent::__Construct();
        $id = 'login';
        $this->load->library(array('encrypt', 'form_validation', 'user_agent'));
        $this->load->model('content_model');
        $this->load->model('membership_model');
       
    }

    function index() {
        $this->is_logged_in();



        redirect('welcome');
    }

    function _prep_password($password) {
        return sha1($password . $this->config->item('encryption_key'));
    }

    function validate_credentials() {
        $this->load->model('membership_model');
        $query = $this->membership_model->validate();

        if ($query) { // if the user's credentials validated...
            $this->db->where('username', $this->input->post('username'));
            $query2 = $this->db->get('users');
            if ($query2->num_rows == 1) {
                foreach ($query2->result() as $row) {
                    $role_level = $row->role;
                    $user_id = $row->user_id;
                    $user_firstname = $row->firstname;
                    $user_lastname = $row->lastname;
                }
            }

            $data = array(
                'username' => $this->input->post('username'),
                'role' => $role_level,
                'user_id' => $user_id,
                'firstname' => $user_firstname,
                'lastname' => $user_lastname,
                'is_logged_in' => true,
            );

            $this->session->set_userdata($data);
            $this->session->set_flashdata('message', "welcome.");
            redirect($this->agent->referrer(), 'refresh');
        } else { // incorrect username or password
            $this->session->set_flashdata('message', "login failed!!.");
            redirect('welcome/login', 'refresh');
        }
    }

    function register() {
        $data['main_content'] = '/user/register';
        $this->load->vars($data);
        $this->load->view('template/main');
        //$this->template->load('template', 'user/register');
    }

    public function username_check($str) {
        $check = $this->membership_model->check_username($str);
        if ($check) {
            return TRUE;
        } else {
            $this->form_validation->set_message('username_check', 'That username is taken');
            return FALSE;
        }
    }

    function create_member() {


        // field name, error message, validation rules
        $this->form_validation->set_rules('firstname', 'Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');

        $company_id = $this->input->post('company_id');

        if ($this->form_validation->run() == FALSE) {
//add user failed
            $this->session->set_flashdata('message', validation_errors());
            redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
        } else {


            $query = $this->membership_model->create_member();
            if ($query) {
//add user success
                $this->session->set_flashdata('message', 'User added successfully');
                redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
            } else {
                $this->session->set_flashdata('message', 'There was a problem');
                redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
            }
        }
    }

    function update_login_details() {

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
        $company_id = $this->input->post('company_id');
        $user_id = $this->input->post('user_id');

        if ($this->form_validation->run() == FALSE) {
//add user failed
            $this->session->set_flashdata('message', validation_errors());
            redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
        } else {


            $query = $this->membership_model->update_password();
            if ($query) {
//add user success
                $this->session->set_flashdata('message', 'User updated successfully');
                redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
            } else {
                $this->session->set_flashdata('message', 'There was a problem');
                redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
            }
        }
    }

    function update_member() {


        // field name, error message, validation rules
        $this->form_validation->set_rules('firstname', 'Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');
//        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|callback_username_check');
//        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
//        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');

        $company_id = $this->input->post('company_id');

        if ($this->form_validation->run() == FALSE) {
//add user failed
            $this->session->set_flashdata('message', validation_errors());
            redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
        } else {


            $query = $this->membership_model->update_member();
            if ($query) {
//add user success
                $this->session->set_flashdata('message', 'User updated successfully');
                redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
            } else {
                $this->session->set_flashdata('message', 'There was a problem');
                redirect('user/user_admin/list_companies/' . $company_id, 'refresh');
            }
        }
    }

    function logout() {
        $this->session->sess_destroy();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in == true) {
            redirect('welcome/login');
        }
        $this->index();
    }

    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in == true) {
            redirect('welcome/login');
        }
    }

}

/* End of file login.php */
/* Location: ./system/application/controllers/user/login.php */
