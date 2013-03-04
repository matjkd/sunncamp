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
    
    function make_large_file($id, $filename) {
    	
    	$this->gallery_path1 = 'images/products';
    
    
    	mkdir('' . $this->config_base_path . $this->gallery_path1 . '/' . $id . '/');
    	mkdir('' . $this->config_base_path . $this->gallery_path1 . '/' . $id . '/large/');
    	 
    	echo $this->config_base_path . $this->gallery_path1 . '/' . $id . '/'.$filename;
    	$image = file_get_contents("https://s3-eu-west-1.amazonaws.com/".$this->bucket."/products/".$id."/".$filename);
    	
    	file_put_contents("images/products/".$id."/large/temp_".$filename, $image);
    	
    	
    	$config = array(
    			'source_image' => "images/products/".$id."/large/temp_".$filename,
    			'new_image' => "images/products/".$id."/large/".$filename,
    			'maintain_ratio' => true,
    			'width' => 1200,
    			'height' => 900
    	);
    	
    	$this->load->library('image_lib', $config);
    	
    	$this->image_lib->resize();
    	
    	$this->image_lib->clear();
    	return TRUE;
    	
    }

    function do_upload($id) {

    
		
        $config = array(
            'allowed_types' => 'jpg|jpeg|gif|png',
            'upload_path' => $this->gallery_path . '/' . $id . '',
            'max_size' => 10000
        );

        $this->load->library('upload', $config);
        if( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());
			
          print_r($config);
    		print_r($error);
        }
        else
        {
              $image_data = $this->upload->data();
        }
    


        //resize the images
        //create thumb
        $config = array(
            'source_image' => $image_data['full_path'],
            'new_image' => $this->gallery_path . '/' . $id . '/thumbs',
            'maintain_ratio' => true,
            'width' => 134,
            'height' => 100
        );

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        //create medium
        $config2 = array(
            'source_image' => $image_data['full_path'],
            'new_image' => $this->gallery_path . '/' . $id . '/medium',
            'maintain_ratio' => true,
            'width' => 630,
            'height' => 480
        );

        $this->image_lib->initialize($config2);
        $this->image_lib->resize();
         $this->image_lib->clear();

         
         //create large
          $config3 = array(
            'source_image' => $image_data['full_path'],
            'new_image' => $this->gallery_path . '/' . $id . '/large',
            'maintain_ratio' => true,
            'width' => 1200,
            'height' => 900
        );

        $this->image_lib->initialize($config3);
        $this->image_lib->resize();
         $this->image_lib->clear();
         
        $upload_data = array($this->upload->data());

        foreach ($upload_data as $row):

            // add this to database $row['file_name'];
            $new_image_data = array(
                'filename' => $row['file_name'],
                'product_id' => $id,
                'order' => 5
            );
$filename = $row['file_name'];
        if($row['file_name']!=NULL){
            $this->db->insert('product_images', $new_image_data);
            
        }

        endforeach;
        return $filename;
    }
    
    function do_news_upload() {
    	$this->gallery_path = './images/temp/';
    	$this->gallery_path_url = base_url() . 'images/temp/';
    
    
    	$config = array(
    			'allowed_types' => 'jpg|jpeg|gif|png',
    			'upload_path' => $this->gallery_path,
    			'max_size' => 10000
    	);
    
    	$this->load->library('upload', $config);
    	if (!$this->upload->do_upload('file')) {
    		$error = array('error' => $this->upload->display_errors());
    		print_r($error);
    	} else {
    		$image_data = $this->upload->data();
    	}
    
    
    
    	//resize the images
    	$config = array(
    			'source_image' => $image_data['full_path'],
    			'new_image' => $this->gallery_path . 'thumbs',
    			'maintain_ratio' => true,
    			'width' => 350,
    			'height' => 200
    	);
    
    	$this->load->library('image_lib', $config);
    	$this->image_lib->resize();
    	$this->image_lib->clear();
    }
   

}
