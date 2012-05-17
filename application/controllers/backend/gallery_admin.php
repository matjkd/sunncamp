<?php

class Tradereviews_admin extends MY_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->is_logged_in();
        $this->load->model('content_model');
        $this->load->model('products_model');
        $this->load->model('gallery_model');
        $this->load->model('manuals_model');
        $this->load->model('tradereviews_model');
        $this->load->model('menu_model');
        $this->load->library('s3');
    }
    
    function index() {
    	
    }
    
    
    function move_manualsS3() {
    	
    	
    	echo "moving manuals to s3";
    	
    	
    }
}
