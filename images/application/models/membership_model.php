<?php

class Membership_model extends CI_Model {

    function validate() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', $this->_prep_password($this->input->post('password')));
        $query = $this->db->get('users');

        if ($query->num_rows == 1) {
            return true;
        }
    }

    function _prep_password($password) {
        return sha1($password . $this->config->item('encryption_key'));
    }

    function create_member() {

        $new_member_insert_data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'username' => $this->input->post('username'),
            'active' => $this->input->post('active'),
            'email' => $this->input->post('email_address'),
            'phone' => $this->input->post('phone'),
            'role' => 4,
            'company' => $this->input->post('company_id'),
            'password' => $this->_prep_password($this->input->post('password'))
        );

        $insert = $this->db->insert('users', $new_member_insert_data);
        return $insert;
    }

    function update_member() {

        $new_member_insert_data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'active' => $this->input->post('active'),
            'email' => $this->input->post('email_address'),
            'phone' => $this->input->post('phone'),
           
            'company' => $this->input->post('company_id')
        );
        $this->db->where('user_id', $this->input->post('user_id'));
        $update = $this->db->update('users', $new_member_insert_data);
        return $update;
    }

    function update_password() {

        $new_member_insert_data = array(
            'password' => $this->_prep_password($this->input->post('password'))
        );
        $this->db->where('user_id', $this->input->post('user_id'));
        $update = $this->db->update('users', $new_member_insert_data);
        return $update;
    }

    function delete_user($user_id) {
        
    }

    function check_username($str) {
        $this->db->where('username', $str);
        $query = $this->db->get('users');

        if ($query->num_rows == 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_all_users() {

        $query = $this->db->get('users');

        if ($query->num_rows > 0) {
            return true;
        }
    }

}