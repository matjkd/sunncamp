<?php

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('admin_model');
        $this->load->library('postmark');
		$this->merchant->load('paypal_express');
		$settings = array(
	    'username' => 'test_api1.redstudio.co.uk',
	    'password' => '1370523366',
	    'signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31A9Ou9oM.UDtyg0GhmUkB36eGYYtn',
	    'test_mode' => true);

		$this->merchant->initialize($settings);

        $admindata = $this->admin_model->get_admin(1);
        foreach ($admindata as $row):

            $config_data['config_company_name'] = $row->company_name;
            $config_data['config_company_short'] = $row->company_name_short;

            $config_data['config_address1'] = $row->address1;
            $config_data['config_address2'] = $row->address2;
            $config_data['config_address3'] = $row->address3;
            $config_data['config_address4'] = $row->address4;
            $config_data['config_address5'] = $row->address5;

            $config_data['config_address'] = "" . $row->address1 . ", " . $row->address2 . ", " . $row->address3 . ", " . $row->address4 . ", " . $row->address5 . "";

            $config_data['config_version'] = "0.0.9";
            $config_data['bucket'] = $row->bucket;
            $config_data['config_email'] = $row->main_email;
            $config_data['config_website'] = $row->web_address;
            $config_data['config_phone'] = $row->main_phone;
            $config_data['config_theme'] = $row->company_theme;
            $config_data['config_logo'] = $row->company_logo;
            $config_data['config_doc_root'] = $row->doc_root;
            $config_data['maps_api'] = $row->mapsapi;
            //age of company
            $startdate = $row->startyear;
            $currentyear = date('Y');
            $age = $currentyear - $startdate;
            $config_data['age'] = $age;
            $this->config_theme = $row->company_theme;
            $this->bucket = $row->bucket;
            $this->last_update = $row->last_update;
            $this->config_email = $row->main_email;
            $this->config_base_path = $row->doc_root;
            $this->config_company_name = $row->company_name;
            $this->load->vars($config_data);
			
			

        endforeach;
		
		if (strpos(base_url(),'dutch') !== false || strpos(base_url(),'.nl') !== false) {
			
			$url = "http://rate-exchange.appspot.com/currency?from=GBP&to=EUR";
			$json = file_get_contents($url);
			$data = json_decode($json, TRUE);
			
			$rate = ceil($data['rate']*10)/10;
			//echo $rate;
   			  $this->sitelanguage = "dutch";
			  $this->currency = "";
			   $this->currencybefore = "";
				 $this->currencyafter = "&euro;";
			   $this->convert = $rate;
			   $this->currencyval  = 'EUR';
			} else {
				$this->sitelanguage = "english";
				
				 $this->currencybefore = "&pound;";
				 $this->currencyafter = "";
				 $this->convert = "1";
				$this->currencyval = 'GBP';
			}
    }

}