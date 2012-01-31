<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function add_company() {
        $company_name = $this->input->post('company_name');
        $company_type = $this->input->post('company_type');
        $visible = $this->input->post('visible');
        $company_phone = $this->input->post('phone');
        $company_web = $this->input->post('webaddress');
        $new_company = array(
            'company_name' => $company_name,
            'company_type' => $company_type,
            'company_phone' => $company_phone,
            'company_web' => $company_web,
            'visible_on_site' => $visible
        );

        $insert = $this->db->insert('companies', $new_company);
        return $insert;
    }

    function update_company($company_id) {

        $company_name = $this->input->post('company_name');
        $company_type = $this->input->post('company_type');
        $visible = $this->input->post('visible');
        $company_phone = $this->input->post('phone');
        $company_web = $this->input->post('webaddress');
        $new_company = array(
            'company_name' => $company_name,
            'company_type' => $company_type,
            'company_phone' => $company_phone,
            'company_web' => $company_web,
            'visible_on_site' => $visible
        );

        $this->db->where('company_id', $company_id);
        $update = $this->db->update('companies', $new_company);
        return $update;
    }

    function update_address($address_id) {
        $new_company_address = array(
            'address1' => $this->input->post('address1'),
            'address2' => $this->input->post('address2'),
            'address3' => $this->input->post('address3'),
            'address4' => $this->input->post('address4'),
            'address5' => $this->input->post('address5'),
            'postcode' => $this->input->post('postcode')
        );

        $this->db->where('address_id', $address_id);
        $update = $this->db->update('company_address', $new_company_address);
        return $update;
    }

    function add_address($company_id) {
        $new_company_address = array(
            'address1' => $this->input->post('address1'),
            'address2' => $this->input->post('address2'),
            'address3' => $this->input->post('address3'),
            'address4' => $this->input->post('address4'),
            'address5' => $this->input->post('address5'),
            'postcode' => $this->input->post('postcode'),
            'company_id' => $company_id
        );


        $insert = $this->db->insert('company_address', $new_company_address);
        return $insert;
    }

    function get_companies() {
        $this->db->join('company_types', 'company_types.company_type_id = companies.company_type');
        $query = $this->db->get('companies');


        return $query->result();
    }

      function get_user($user_id) {
        $this->db->where('active', 1);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('users');


        return $query->result();
    }
    
    function get_users($company_id) {
        $this->db->where('active', 1);
        $this->db->where('company', $company_id);
        $query = $this->db->get('users');


        return $query->result();
    }

    /*
     * 
     */

    function deactivate_user($user_id) {

        $this->db->where('user_id', $user_id);

        $update_user = array(
            'active' => 0
        );

        $update = $this->db->update('users', $update_user);
        return $update;
    }

    /*
     * 
     */

    function deactivate_users($company_id) {
        $this->db->where('company', $company_id);
        $update_user = array(
            'active' => 0
        );

        $update = $this->db->update('users', $update_user);
        return $update;
    }

    function remove_addresses($company_id) {

        $this->db->where('company_id', $company_id);
        $query = $this->db->delete('company_address');
        return $query;
    }

    function delete_company($company_id) {
        $this->db->where('company_id', $company_id);
        $query = $this->db->delete('companies');
        return $query;
    }

    function get_company($company_id) {

        $this->db->where('companies.company_id', $company_id);
        $this->db->join('company_address', 'company_address.company_id = companies.company_id', 'left');
        $this->db->join('company_types', 'company_types.company_type_id = companies.company_type');
        $query = $this->db->get('companies');


        return $query->result();
    }

}
