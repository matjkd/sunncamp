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
    

}
