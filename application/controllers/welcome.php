<?php

	if (!defined('BASEPATH'))
		exit('No direct script access allowed');

	class Welcome extends MY_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this -> load -> model('captcha_model');
			$this -> load -> model('products_model');
		}

		/**
		 * do something about this index cos it duplicates welcome/home
		 */
		public function index()
		{
			$segment_active = $this -> uri -> segment(2);
			if ($segment_active != NULL)
			{
				$data['menu'] = $this -> uri -> segment(2);
			}
			else
			{
				$data['menu'] = 'home';
			}

			$data['content'] = $this -> content_model -> get_content($data['menu']);
			$data['captcha'] = $this -> captcha_model -> initiate_captcha();
			$data['seo_links'] = $this -> content_model -> get_seo_links();
			$data['categories'] = $this -> products_model -> get_all_product_cats();
			$data['category_parents'] = $this -> products_model -> get_all_product_parents();
			foreach ($data['content'] as $row)
			:

				$data['title'] = $row -> title;
				$data['sidebox'] = $row -> sidebox;
				$data['metatitle'] = $row -> meta_title;
				$data['meta_description'] = $row -> meta_desc;
				$data['slideshow'] = $row -> slideshow;

			endforeach;

			$data['main_content'] = "global/" . $this -> config_theme . "/content";

			$data['section2'] = 'global/links';
			if ($this -> session -> flashdata('message'))
			{
				$data['message'] = $this -> session -> flashdata('message');
			}

			$old_visitor = $this -> session -> userdata('visitor');
			if ($old_visitor == NULL)
			{
				$data['notice'] = "<strong>IMPORTANT NOTICE DUE TO THE EXTREME UNSEASONAL COLD WEATHER CONDITIONS</strong>
 
<p>Modern lightweight materials such as window plastic are not designed to withstand extreme cold temperatures.
If equipment has been stored in a very cold environment, folded in its bag, it may require warming up before it is unpacked and erected.
This will prevent windows from cracking or shattering when they are unfolded, where material has been creased.
This is not a manufacturing fault. Damage caused by this is not deemed a warranty claim.</p>";
				
				
			}
		

			$this -> load -> vars($data);
			$this -> load -> view('template/main');
		}

function hideNotice() {
	
	$sessiondata = array('visitor' => 1);
	$this -> session -> set_userdata($sessiondata);
}

		/**
		 * the main page layout controller
		 */
		function home()
		{

			$segment_active = $this -> uri -> segment(3);
			if ($segment_active != NULL)
			{
				$data['menu'] = $this -> uri -> segment(3);
			}
			else
			{
				$data['menu'] = $this -> uri -> segment(1);
			}

			if (isset($this -> extra))
			{
				$data['extra'] = $this -> extra;
			}
			else
			{

			}
			if (isset($this -> extra2))
			{
				$data['extra2'] = $this -> extra2;
			}
			else
			{

			}

			if ($data['menu'] == 'news')
			{
				$data['news'] = $this -> content_model -> get_content_cat('news');
			}
			if ($data['menu'] == 'testimonials')
			{
				$data['testimonial'] = $this -> content_model -> get_content_cat('testimonial');
			}
			if ($data['menu'] == 'stockists')
			{
				$data['stockists'] = $this -> content_model -> get_stockists();

				$data['stockist_cats'] = $this -> content_model -> get_categories_with_stockists();
			}
			$data['content'] = $this -> content_model -> get_content($data['menu']);
			$data['captcha'] = $this -> captcha_model -> initiate_captcha();
			foreach ($data['content'] as $row)
			:

				$data['title'] = $row -> title;
				$data['sidebox'] = $row -> sidebox;
				$data['metatitle'] = $row -> meta_title;
				$data['meta_description'] = $row -> meta_desc;
				$data['slideshow'] = $row -> slideshow;

			endforeach;
			$data['sidebar'] = "sidebox/side";
			$data['categories'] = $this -> products_model -> get_all_product_cats();
			$data['category_parents'] = $this -> products_model -> get_all_product_parents();
			$data['main_content'] = "global/" . $this -> config_theme . "/content";

			$data['section2'] = 'global/links';
			$data['seo_links'] = $this -> content_model -> get_seo_links();
			if ($this -> session -> flashdata('message'))
			{
				$data['message'] = $this -> session -> flashdata('message');
			}

			$this -> load -> vars($data);
			$this -> load -> view('template/main');
		}

		function instruction_manuals()
		{

			$this -> load -> model('manuals_model');
			$this -> extra = $this -> manuals_model -> get_manuals();
			$this -> extra2 = $this -> manuals_model -> get_manual_cats();

			$this -> home();
		}

		function trade_reviews()
		{

			$this -> load -> model('tradereviews_model');
			$this -> extra = $this -> tradereviews_model -> get_trade_reviews();

			$this -> home();
		}

		function login()
		{
			if ($this -> session -> flashdata('message'))
			{
				$data['message'] = $this -> session -> flashdata('message');
			}
			$id = 'login';
			$data['content'] = $this -> content_model -> get_content($id);
			$data['categories'] = $this -> products_model -> get_all_product_cats();
			$data['category_parents'] = $this -> products_model -> get_all_product_parents();
			$data['main_content'] = "user/login_form";
			$data['title'] = "Login to SunnCamp";

			$data['page'] = "login";
			$this -> load -> vars($data);
			$this -> load -> view('template/main');
		}

	}

	/* End of file welcome.php */
	/* Location: ./application/controllers/welcome.php */
