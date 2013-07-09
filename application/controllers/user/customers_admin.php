<?php

	class Customers_admin extends MY_Controller
	{

		function __Construct()
		{
			parent::__Construct();
			$this -> load -> library(array(
				'encrypt',
				'form_validation'
			));
			$this -> is_logged_in();
			$this -> load -> model('content_model');
			$this -> load -> model('products_model');
			$this -> load -> model('cat_model');
			$this -> load -> model('company_model');
			$this -> load -> model('menu_model');
			$this->userID = $this -> session -> userdata('user_id');
		}

		function index($company = 0)
		{

			redirect('user/user_admin/list_companies');
		}

		function _prep_password($password)
		{
			return sha1($password . $this -> config -> item('encryption_key'));
		}

		function add_address()
		{
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim');
			$this->form_validation->set_rules('address1', 'address1', 'trim|required');
			$this->form_validation->set_rules('postcode', 'Postcode', 'trim|required');
        	$this->form_validation->set_rules('phone', 'Phone', 'trim|required');

	        if ($this->form_validation->run() == FALSE) {
	            //$this->session->set_flashdata('message', validation_errors());
	           
				 $this->session->set_flashdata('message', validation_errors());
	            redirect($this -> agent -> referrer());
				
	        } else {
	
	            // add company
	            $this->company_model->add_company();
	            $company_id = $this->db->insert_id();
	            //add company addresss
	            $this->company_model->add_address($company_id);
	
				
				//assign user to company
			$this->company_model-> assign_company_to_user($company_id, $this->userID);
			 $this->session->set_flashdata('message', 'Address added');	
			 redirect($this -> agent -> referrer());	
			}
		}

		function is_logged_in()
		{
			$is_logged_in = $this -> session -> userdata('is_logged_in');
			$role = $this -> session -> userdata('role');
			if ($role == NULL)
			{
				$data['message'] = "You don't have permission";
				redirect('welcome/login', 'refresh');
			}
		}

	}
