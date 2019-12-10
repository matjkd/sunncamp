<?php

class Admin extends MY_Controller {

	function __Construct() {
		parent::__Construct();
		$this->load->library(array('s3', 'encrypt', 'form_validation'));
		$this->is_logged_in();
		$this->load->model('content_model');
		$this->load->model('products_model');
		$this->load->model('gallery_model');
		$this->load->model('menu_model');

	}

	function index() {
		
		
		
		
		$data['main_content'] = "admin/dashboard";
		$data['pages'] = $this->content_model->get_all_content();
		$data['seo_links'] = $this->content_model->get_seo_links();
		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
	}

	/**
	 *
	 */
	function content() {
		
		
		if (($this->uri->segment(3)) < 1) {
			$id = 1;
		} else {
			$id = $this->uri->segment(3);
		}
		$data['content'] = $this->content_model->get_content($id);
		$data['main'] = "pages/dynamic";
		$data['edit'] = "admin/edit/$id";
		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
	}
	
	function backup() {
		// Load the DB utility class
		$this->load->dbutil();
	
		$prefs = array(
				'ignore' => array(), // List of tables to omit from the backup
				'format' => 'gzip', // gzip, zip, txt
				'filename' => 'backup.sql', // File name - NEEDED ONLY WITH ZIP FILES
				'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
				'add_insert' => TRUE, // Whether to add INSERT data to backup file
				'newline' => "\n"               // Newline character used in backup file
		);
	
	
		$this->dbutil->backup($prefs);
		$now = time();
		$date = unix_to_human($now, TRUE, 'eu');
	
		// Backup your entire database and assign it to a variable
		$backup = & $this->dbutil->backup();
	
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/images/backup/Backup_' . $date . '.gz', $backup);
	
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('Backup_' . $date . '.gz', $backup);
		return TRUE;
	}
	
	function s3backup() {
		// Load the DB utility class
		$this->load->dbutil();
	
		$prefs = array(
				'ignore' => array(), // List of tables to omit from the backup
				'format' => 'gzip', // gzip, zip, txt
				'filename' => 'backup.sql', // File name - NEEDED ONLY WITH ZIP FILES
				'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
				'add_insert' => TRUE, // Whether to add INSERT data to backup file
				'newline' => "\n"               // Newline character used in backup file
		);
	
	
		$this->dbutil->backup($prefs);
		$now = time();
		$date = unix_to_human($now, TRUE, 'eu');
	
		
	
		// Backup your entire database and assign it to a variable
		$backup = & $this->dbutil->backup();
		
	
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/images/backup/Backup_' . $date . '.gz', $backup);
	
		echo "....";
	
		$target = 'Backup_' . $date . '.gz';
		//connect to amazon s3 and copy the file there
		//get folder info
	
		$bucket = $this->bucket . "backup";
	
		echo $bucket;
	
		$this->s3->putBucket($bucket, S3::ACL_PUBLIC_READ);
		if ($this->s3->putObject($backup, $bucket, $target)) {
	
			echo "backup complete";
		} else {
	
			echo "backup failed " . $this->doc_root;
			echo "<br/>";
			echo $bucket . " " . $target;
			echo "<br/>";
		}
		echo $target;
		
		//set last backup time
		$current_time = now();
		$backuptime = array(
				'last_update' => $current_time
		);
		
		$this->db->where('admin_id', 1);
		$update = $this->db->update('admin', $backuptime);
	
		redirect('admin/list_products');
	}

	/**
	 *
	 */
	function edit() {


		$id = $this->uri->segment(3);
		$data['menu'] = $id;
		$data['page'] = $id;
		$data['content'] = $this->content_model->get_content_id($id);
		$data['seo_links'] = $this->content_model->get_seo_links();
		$data['main_content'] = "admin/edit_content";



		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
	}

	/**
	 *
	 */
	function edit_product() {


		$id = $this->uri->segment(3);
		$data['menu'] = $id;
		$data['page'] = $id;
		$data['content'] = $this->products_model->get_product($id);

		$data['main_content'] = "admin/edit_product";


		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
	}

	/**
	 *
	 */
	function edit_attribute() {


		$submitted = $this->input->post('submit');
		$option_id = $this->input->post('option_id');
		$product_id = $this->input->post('product_id');
		$stock_level = $this->input->post('stock_level');
		$price = $this->input->post('price');

		//  if ($submitted == 'Update') {
		$this->form_validation->set_rules('option_category', 'Option Category', 'trim');
		$this->form_validation->set_rules('option', 'Option', 'trim');
		$this->form_validation->set_rules('stock_level', 'Stock Level', 'trim|required');

		$this->products_model->update_option($option_id);
		//    }
		//   if ($submitted == 'X') {
		//       $this->products_model->delete_option($option_id);
		//   }
		echo "Attribute changed";
	}

	/**
	 *
	 */
	function delete_attribute() {

		$option_id = $this->input->post('option_id');
		$product_id = $this->input->post('product_id');

		$this->products_model->delete_option($option_id);

		echo "Attribute deleted";
	}

	/**
	 *
	 */
	function edit_content() {
		$this->form_validation->set_rules('menu', 'menu', 'trim|required');
		if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
			echo "validation error";
		} else { // passed validation proceed to post success logic
			$id = $this->uri->segment(3);
			$this->content_model->edit_content($id);

			$this->upload_news_image($id);


			redirect("admin/edit/$id");
		}
	}

	/**
	 *
	 */
	function submit_content() {
		$this->form_validation->set_rules('title', 'Title', 'trim|max_length[255]');
		$this->form_validation->set_rules('content', 'Content', 'trim');
		//$this->form_validation->set_rules('menu', 'menu', 'trim|required');
		$this->form_validation->set_rules('category', 'Page Type', 'trim|max_length[11]');
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

		if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
			echo "validation error";
		} else { // passed validation proceed to post success logic
			if ($this->content_model->add_content()) { // the information has therefore been successfully saved in the db


				//now process the image
				// run insert model to write data to db
				//upload file
				//retrieve uploaded file
				$this->upload_news_image();

				redirect('/admin');   // or whatever logic needs to occur
			} else {
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
	}

	function upload_news_image($id = 0) {

		$this->gallery_model->do_news_upload();


		if (!empty($_FILES) && $_FILES['file']['error'] != 4) {

			$fileName = $_FILES['file']['name'];
			$tmpName = $_FILES['file']['tmp_name'];
			$fileName = str_replace(" ", "_", $fileName);
			$filelocation = "news/".$fileName;

			$thefile = file_get_contents($tmpName, true);

			//add filename into database
			//get blog id
			if ($id == 0) {
				$blog_id = mysql_insert_id();
			} else {
				$blog_id = $id;
			}
			$this->content_model->add_file($fileName, $blog_id);
			//move the file

			if ($this->s3->putObject($thefile, $this->bucket, $filelocation, S3:: ACL_PUBLIC_READ)) {
				//echo "We successfully uploaded your file.";
				$this->session->set_flashdata('message', 'News Added and file uploaded successfully');
			} else {
				//echo "Something went wrong while uploading your file... sorry.";
				$this->session->set_flashdata('message', 'News Added, but your file did not upload');
			}

			//uploadthumb
			$thumblocation = base_url() . 'images/temp/thumbs/' . $fileName;
			$newfilename = "news/thumb_" .  $fileName;


			$newfile = file_get_contents($thumblocation, true);

			if ($this->s3->putObject($newfile, $this->bucket, $newfilename, S3:: ACL_PUBLIC_READ)) {
				//echo "We successfully uploaded your file.";
				$this->session->set_flashdata('message', 'News Added and file uploaded successfully');
			} else {
				//echo "Something went wrong while uploading your file... sorry.";
				$this->session->set_flashdata('message', 'News Added, but your file did not upload');
			}
			//delete files from server
			$this->gallery_path = "./images/temp";
			//unlink($this->gallery_path . '/' . $fileName . '');
			//unlink($this->gallery_path . '/thumbs/' . $fileName . '');
		} else {

			$this->session->set_flashdata('message', 'News Added');
		}
	}



	/**
	 *
	 */
	function add_product($product_id = 0) {

		// First create a blank product and retrieve an ID
		// TODO only add product if coming from correct button
		if ($product_id == 0) {
			$this->products_model->create_product();
			$data['product_id'] = mysql_insert_id();
		} else {
			$data['product_id'] = $product_id;
		}

		$data['leftside'] = "admin/product_sidebox";
		$data['images'] = $this->products_model->get_product_images($data['product_id']);
		$data['product'] = $this->products_model->get_product($data['product_id']);
		$data['product_categories'] = $this->products_model->get_product_categories($data['product_id']);

		$data['categories'] = $this->products_model->get_all_product_cats();
		$data['category_parents'] = $this->products_model->get_all_product_parents();
		$data['features'] = $this->products_model->get_product_features($data['product_id']);
		$data['other_features'] = $this->products_model->get_other_features($data['product_id']);
		$data['allfeatures'] = $this->products_model->get_all_product_features();
		$data['specs'] = $this->products_model->get_product_specs($data['product_id']);

		$data['attributes'] = $this->products_model->get_attributes($data['product_id']);
		$data['main_content'] = "global/add_product";
		if($data['product_categories'] == NULL) {
			$data['message'] = "NOTE: For a product to display on the front end of the site it must be in a Product Category,
			and the 'active on site' checkbox must be checked.";
		}

		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
	}

	/**
	 *
	 * @param type $product_id
	 */
	function update_product($product_id) {

		$this->form_validation->set_rules('product_name', 'product name', 'trim|required');
		if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
			echo validation_errors();
		} else { // passed validation proceed to post success logic
			$this->products_model->edit_product($product_id);

			redirect("admin/add_product/$product_id");
		}
	}

	/**
	 *
	 * @param type $id
	 */
	function add_product_category() {

		$category = trim($this->input->post('product_category'));
		$id = $this->input->post('product_id');
		//check if category name is in database already
		$catdata = $this->products_model->check_product_categories($category);
		if ($catdata) {

			// The cat is in the database already
			// now add to the cat  list
			foreach ($catdata as $row):
			$cat_id = $row['product_category_id'];
			endforeach;

			//add a check that the category hasn't already been added
			$this->products_model->add_to_category_link($cat_id, $id);


			$return = $cat_id;
		} else {

			// The cat isn't in the database
			// TODO check for similar names
			// add to database, then add to users list
			$this->products_model->create_new_cat($category);
			$cat_id = $this->db->insert_id();
			$this->products_model->add_to_category_link($cat_id, $id);
			$return = $cat_id;
		}
		echo $return;
		//redirect("admin/add_product/$id");
	}

	/**
	 *
	 * @param type $id
	 */
	function add_product_feature() {

		$feature_id = $this->input->post('product_feature');
		$id = $this->input->post('product_id');
		$this->products_model->add_to_feature_link($feature_id, $id);
		$feature_id = $this->db->insert_id();

		echo $feature_id;
	}

	/**
	 *
	 */
	function add_other_feature() {
		$id = $this->input->post('product_id');
		$other_feature = $this->input->post('other_feature');

		//check if feature name is in database already
		$otherfeature = $this->products_model->check_other_feature($other_feature);

		if ($otherfeature) {

			// The feature is in the database already
			// now add to the feature list
			foreach ($otherfeature as $row):
			$other_feature_id = $row['other_feature_id'];
			endforeach;
			$this->products_model->add_to_other_feature_link($other_feature_id, $id);

			$link_id = $this->db->insert_id();
		} else {

			// The feature isn't in the database
			// TODO check for similar names
			// add to database, then add to users list
			$this->products_model->create_other_feature($other_feature);
			$other_feature_id = $this->db->insert_id();
			$this->products_model->add_to_other_feature_link($other_feature_id, $id);
			$link_id = $this->db->insert_id();
		}
		echo $link_id;
	}

	/**
	 *
	 */
	function remove_category() {
		$id = $this->input->post('product_id');
		$category_link_id = $this->input->post('category_link_id');
		$this->products_model->delete_product_category($category_link_id);

		echo "category removed";
	}

	/**
	 *
	 */
	function remove_feature() {
		$product_id = $this->input->post('product_id');
		$feature_link_id = $this->input->post('feature_link_id');
		$this->products_model->delete_product_feature($feature_link_id);

		echo "feature removed";
	}

	/*
	 *
	*
	*/

	function remove_other_feature() {

		$other_feature_link_id = $this->input->post('other_feature_link_id');
		$this->products_model->delete_other_feature($other_feature_link_id);

		echo "feature removed";
	}

	/**
	 *
	 */
	function remove_spec() {

		$spec_link_id = $this->input->post('spec_link_id');
		$this->products_model->delete_product_spec($spec_link_id);

		redirect("admin/add_product/$id");
	}

	/**
	 * change order of list with jquery ui autocomplete
	 */
	function sortspecs() {
		$pages = $this->input->post('pages');
		parse_str($pages, $pageOrder);

		// list id is retrieved from the ID on the sortable list
		foreach ($pageOrder['spec'] as $key => $value):
		mysql_query("UPDATE ignite_product_spec_link SET `spec_order` = '$key' WHERE `spec_link_id` = '$value'") or die(mysql_error());


		//$this->db->update('practice_area_links', $pro_update);
		endforeach;
	}


	function sortotherfeatures() {
		$pages = $this->input->post('pages');
		parse_str($pages, $pageOrder);

		// list id is retrieved from the ID on the sortable list
		foreach ($pageOrder['other_feature'] as $key => $value):
		mysql_query("UPDATE ignite_other_feature_link SET `other_feature_order` = '$key' WHERE `other_feature_link_id` = '$value'") or die(mysql_error());


		//$this->db->update('practice_area_links', $pro_update);
		endforeach;
	}

	/**
	 * sort the images for a product
	 */
	function ajaxsort() {

		$pages = $this->input->post('pages');


		parse_str($pages, $pageOrder);
		print_r($pageOrder);

		foreach ($pageOrder['pageorder'] as $key => $value):
		echo $key;
		mysql_query("UPDATE ignite_product_images SET `order` = '$key' WHERE `product_image_id` = '$value'") or die(mysql_error());



		endforeach;
	}

	/**
	 *
	 * @param type $id
	 */
	function add_product_spec() {
		$id = $this->input->post('product_id');
		$spec = $this->input->post('product_spec');
		$spec_value = $this->input->post('spec_value');
		//check if category name is in database already
		$specdata = $this->products_model->check_product_spec($spec);

		if ($specdata) {

			// The spec is in the database already
			// now add to the spec  list
			foreach ($specdata as $row):
			$spec_id = $row['spec_id'];
			endforeach;
			$this->products_model->add_to_spec_link($spec_id, $spec_value, $id);

			$link_id = $this->db->insert_id();
		} else {

			// The specisn't in the database
			// TODO check for similar names
			// add to database, then add to users list
			$this->products_model->create_new_spec($spec);
			$spec_id = $this->db->insert_id();
			$this->products_model->add_to_spec_link($spec_id, $spec_value, $id);
			$link_id = $this->db->insert_id();
		}
		echo $link_id;
	}

	/**
	 *
	 */
	function upload_image() {


		$id = $this->input->post('product_id');
		$this->gallery_path = "images/products";

		//check file path exists.
		//maybe extend this check for each subfolder in future

		$path = $this->config_base_path . $this->gallery_path . '/' . $id . '/';

		//create directories if required
		if (file_exists($path)) {

			// folder exists
			echo $path." folder exists<br/>";
			
		} else {
				
		

			//create folders
			mkdir('' . $this->config_base_path . $this->gallery_path . '/' . $id . '/');
			mkdir('' . $this->config_base_path . $this->gallery_path . '/' . $id . '/thumbs/');
			mkdir('' . $this->config_base_path . $this->gallery_path . '/' . $id . '/medium/');
			mkdir('' . $this->config_base_path . $this->gallery_path . '/' . $id . '/large/');
		}





		if ($this->input->post('upload')) {
			echo "doing upload...";
			$filename = $this->gallery_model->do_upload($id);
echo "...upload done";

			//upload images to s3
			$base_path = $this->config_base_path."/images/";
			$regularFile = $this->config_base_path . $this->gallery_path . '/' . $id . '/';
			$thumbFile =$this->config_base_path . $this->gallery_path . '/' . $id . '/thumbs/' ;
			$mediumFile =$this->config_base_path . $this->gallery_path . '/' . $id . '/medium/';
			$largeFile =$this->config_base_path . $this->gallery_path . '/' . $id . '/large/';

			$regularfilelocation =  'products/' . $id . '/'.$filename;
			$thumbfilelocation =  'products/' . $id . '/thumbs/'.$filename;
			$mediumfilelocation =  'products/' . $id . '/medium/'.$filename;
			$largefilelocation = 'products/' . $id . '/large/'.$filename;


			$regular = file_get_contents($base_path.$regularfilelocation, true);
			$thumb = file_get_contents($base_path.$thumbfilelocation, true);
			$medium = file_get_contents($base_path.$mediumfilelocation, true);
			$large = file_get_contents($base_path.$largefilelocation, true);

			if($this->s3->putObject($regular, $this->bucket, $regularfilelocation, S3:: ACL_PUBLIC_READ)){
			echo "upload to s3 success"; die();	
			} else {
				
			echo "error"; 	
			}
			
			if($this->s3->putObject($thumb, $this->bucket, $thumbfilelocation, S3:: ACL_PUBLIC_READ))
			   {
			   }
			   else
			   {
				   //echo "error2"; die();
			   }
			$this->s3->putObject($medium, $this->bucket, $mediumfilelocation, S3:: ACL_PUBLIC_READ);
			$this->s3->putObject($large, $this->bucket, $largefilelocation, S3:: ACL_PUBLIC_READ);


//TODO need to remove old folders
	$delpath = $this->config_base_path . $this->gallery_path;
	echo "delete ".$delpath;
	//temp disable delete cos s3 upload is borked
			//delete_files($delpath, true);
		redirect("admin/add_product/$id");
		}
	}

	function create_large_image() {
		//get all products images
		$allImages =$this->products_model->get_all_product_images();
		foreach($allImages as $row):
		$id = $row->product_id;
		$filename = $row->filename;
$product_image_id =  $row->product_image_id;
		$url = "https://s3-eu-west-1.amazonaws.com/".$this->bucket."/products/".$id."/".$filename;
		$largeurl = "https://s3-eu-west-1.amazonaws.com/".$this->bucket."/products/".$id."/large/".$filename;
		// Check to see if the file exists by trying to open it for read only


		if (fopen($url, "r")) {

			
				
			if (fopen($largeurl, "r")) {
				//echo " - large in place <br/>";
			} else {
				echo $id." ".$filename. " - File Exists";
				echo " - <a href='".base_url()."admin/test/".$product_image_id."'> need to convert</a><br/>";
			}

		} else {

			//echo " - Can't Connect to File <br/> ";

		}

		endforeach;

		//
	}
	
	function test() {
		$imageid = $this->uri->segment(3);
		$imagedata =$this->products_model->get_product_image_id($imageid);
		
		foreach($imagedata as $row):
		
		$filename =  $row->filename;
		$id = $row->product_id;
		if($this->gallery_model->make_large_file($id, $filename)) {
			echo " - complete <br/>";
		}
		
		$this->put_converted_file($id, $filename);
		endforeach;
		
	//	redirect('/admin/create_large_image');
		
	}
	
	function convert_now($id, $filename) {
		$id = $this->uri->segment(3);
		$filename =  $this->uri->segment(4);
		if($this->gallery_model->make_large_file($id, $filename)) {
			echo " - complete <br/>";
		}
	}

	function put_converted_file($id, $filename) {

		$this->gallery_path = "images/products";
		$base_path = $this->config_base_path."images/";
		$largeFile =$this->config_base_path . $this->gallery_path . '/' . $id . '/large/';
		$largefilelocation = 'products/' . $id . '/large/'.$filename;
		$large = file_get_contents($base_path.$largefilelocation, true);
		
		$this->s3->putObject($large, $this->bucket, $largefilelocation, S3:: ACL_PUBLIC_READ);
	}

	function convert_images_to_s3() {
			
		//get all products
		$allImages =$this->products_model->get_all_product_images();
			
		foreach($allImages as $row):
			
		$id = $row->product_id;
		$filename = $row->filename;
		$this->gallery_path = "images/products";
		//upload images to s3
		$base_path = $this->config_base_path."images/";
		$regularFile = $this->config_base_path . $this->gallery_path . '/' . $id . '/';
		$thumbFile =$this->config_base_path . $this->gallery_path . '/' . $id . '/thumbs/' ;
		$mediumFile =$this->config_base_path . $this->gallery_path . '/' . $id . '/medium/';
		$largeFile =$this->config_base_path . $this->gallery_path . '/' . $id . '/large/';
			
		$regularfilelocation =  'products/' . $id . '/'.$filename;
		$thumbfilelocation =  'products/' . $id . '/thumbs/'.$filename;
		$mediumfilelocation =  'products/' . $id . '/medium/'.$filename;
		$largefilelocation = 'products/' . $id . '/large/'.$filename;
			
		if(file_exists($base_path.$regularfilelocation)){
			$regular = file_get_contents($base_path.$regularfilelocation, true);
			echo "putObject(". $this->bucket." ".$regularfilelocation."<br/>";
			$this->s3->putObject($regular, $this->bucket, $regularfilelocation, S3:: ACL_PUBLIC_READ);
		} else {
			echo "no regular file<br/>".$id;
		}
			
		if(file_exists($base_path.$thumbfilelocation)){
			$thumb = file_get_contents($base_path.$thumbfilelocation, true);
			echo "putObject(". $this->bucket." ".$thumbfilelocation."<br/>";
			$this->s3->putObject($thumb, $this->bucket, $thumbfilelocation, S3:: ACL_PUBLIC_READ);
		} else {
			echo "no thumb file<br/>";
		}
			
		if(file_exists($base_path.$mediumfilelocation)){
			$medium = file_get_contents($base_path.$mediumfilelocation, true);
			echo "putObject(". $this->bucket." ".$mediumfilelocation."<br/>";
			$this->s3->putObject($medium, $this->bucket, $mediumfilelocation, S3:: ACL_PUBLIC_READ);
		} else {
			echo "no medium file<br/>";
		}

		if(file_exists($base_path.$largefilelocation)){
			$large = file_get_contents($base_path.$largefilelocation, true);
			echo "putObject(". $this->bucket." ".$largefilelocation."<br/>";
			$this->s3->putObject($large, $this->bucket, $largefilelocation, S3:: ACL_PUBLIC_READ);
		} else {
			echo "no large file<br/>";
		}

			
			
		endforeach;
	}

	/**
	 *
	 */
	function delete_image() {
		//set variables
		$product_id = $this->input->post('id');
		$image_id = $this->input->post('image_id');
		$this->gallery_path = "./images/products";

		//get image data first
		$this->db->from('product_images');
		$this->db->where('product_image_id', $image_id);
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();

		if ($query->num_rows == 1) {

			foreach ($query->result_array() as $row):

			$filename = $row['filename'];


			endforeach;
		}

		//delete image data
		$this->db->where('product_image_id', $image_id);
		$this->db->where('product_id', $product_id);
		$this->db->delete('product_images');

		//delete images from server

		unlink($this->gallery_path . '/' . $product_id . '/' . $filename . '');
		// unlink($this->gallery_path . '/' . $product_id . '/large/' . $filename . '');
		unlink($this->gallery_path . '/' . $product_id . '/medium/' . $filename . '');
		unlink($this->gallery_path . '/' . $product_id . '/thumbs/' . $filename . '');


		redirect("admin/add_product/$product_id");
	}

	/**
	 *
	 */
	function add_attribute() {
		$id = $this->input->post('product_id');
		$this->form_validation->set_rules('option_category', 'option category', 'trim|max_length[255]');
		$this->form_validation->set_rules('option', 'option', 'trim');
		$this->form_validation->set_rules('stock_level', 'stock level', 'trim|required');
		if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
			echo "stock level required";
		} else { // passed validation proceed to post success logic
			if ($this->products_model->add_attribute()) { // the information has therefore been successfully saved in the db
				$attribute_id = $this->db->insert_id();
				echo $attribute_id;   // or whatever logic needs to occur
			} else {
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
	}

	/**
	 *
	 */
	function add_menu() {
		$data['main_content'] = "admin/add_menu";
		$data['cats'] = $this->products_model->get_cats();
		$data['products'] = $this->products_model->get_all_products();
		$data['section2'] = 'global/links';
		if ($this->session->flashdata('message')) {
			$data['message'] = $this->session->flashdata('message');
		}

		$data['slideshow'] = 'header/slideshow';
		$this->load->vars($data);
		$this->load->view('template/main');
	}

	/*
	 *
	*/

	function view_menus() {
		$data['main_content'] = "admin/view_menus";
		$data['page'] = 'practices';
		$data['menus'] = $this->menu_model->get_menus();

		$data['slideshow'] = 'header/slideshow';
		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
	}

	/*
	 *
	*/

	function add_new_menu() {
		$this->menu_model->add_menu();
		return;
	}

	/*
	 *
	*/

	function update_menu() {
		echo $this->input->post('published');
		$this->menu_model->update_menu();
		//  return;
	}

	/*
	 *
	*/

	function edit_menu($id) {
		$data['main_content'] = "admin/edit_menu";
		$data['menudata'] = $this->menu_model->get_menu($id);
		$data['cats'] = $this->products_model->get_cats();
		$data['products'] = $this->products_model->get_all_products();
		$data['section2'] = 'global/links';
		if ($this->session->flashdata('message')) {
			$data['message'] = $this->session->flashdata('message');
		}

		$data['slideshow'] = 'header/slideshow';
		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
	}

	/*
	 *
	*/

	function do_upload() {
		if (isset($_FILES['file'])) {
			$file = read_file($_FILES['file']['tmp_name']);
			$name = basename($_FILES['file']['name']);
			$name = str_replace(' ', '_', $name);
			$name = str_replace(',', '', $name);
			write_file('uploads/' . $name, $file);

			$this->cases_model->add($name);
			redirect('cases/view');
		}

		else
			$this->load->view('upload');
	}

	/*
	 *
	*/

	function add_content() {
		$data['main_content'] = "admin/add_content";
		$data['pages'] = $this->content_model->get_all_content();

		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
	}


	/*
	 *
	*/

	function add_news_content() {
		$data['main_content'] = "admin/add_content";
		$data['pages'] = $this->content_model->get_all_content();
		$data['category'] = "news";
		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
	}
	
	
	function add_testimonial_content() {
		$data['main_content'] = "admin/add_testimonial";
		$data['pages'] = $this->content_model->get_all_content();
		$data['category'] = "testimonial";
		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
	}

	/*
	 *
	*/

	function list_products($cat = NULL) {
	
		$timeago = now() - 3600;
		if($timeago > $this->last_update) {
			// this may be broken
			//echo "Backing Up Database";
			//redirect('admin/s3backup');
		} else {
			//echo "don't backup";
		}
		
		//trim products with no data
		$this->products_model->trim_products();

		$data['main_content'] = "admin/list_products";
		$data['leftside'] = "admin/productlist_sidebox";

		$cat = $this->input->post('cats');
		$data['products'] = $this->content_model->get_all_products($cat);

		$data['category_parents'] = $this->products_model->get_all_product_parents();

		$data['categories'] = $this->products_model->get_all_product_cats();

		$this->load->vars($data);
		$this->load->view('template/sunncamp/admin');
		
	}

	/*
	 *
	*/

	function delete_product() {

		$product_id = $this->input->post('product_id');

		//delete product images
		$this->products_model->delete_product_images($product_id);

		//delete product options
		$this->products_model->delete_product_options($product_id);

		//delete category links
		$this->products_model->delete_product_category_link($product_id);

		//delete product
		$this->products_model->delete_product($product_id);
	}

	/*
	 *
	*
	*
	*/

	function is_logged_in() {
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if (!isset($is_logged_in) || $role != 1) {
			$data['message'] = "You don't have permission";
			redirect('welcome/login', 'refresh');
		} else {
			
		}
	}

}
