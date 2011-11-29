<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function Gallery_model() {

        parent::Model();
      
        $this->gallery_path = './images/products';
        $this->gallery_path_url = base_url() . 'images/products/';
    }

}