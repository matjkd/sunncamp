<?php

	if (!defined('BASEPATH'))
		exit('No direct script access allowed');

	class Manuals_model extends CI_Model
	{

		function __construct()
		{
			// Call the Model constructor
			parent::__construct();
		}

		function get_manual_cats()
		{

			$this -> db -> order_by('manual_order');
			$query = $this -> db -> get('manual_cats');

			return $query -> result();
		}

		function get_manuals()
		{

			$query = $this -> db -> get('manuals');

			return $query -> result();
		}

		function add_manual($filename)
		{
			$name = $this -> input -> post('catname');
			if ($name == 'Name')
			{
				$name = $filename;
			}
			$category = $this -> input -> post('man_cat');
			$new_manual_data = array(
				'manual_title' => $name,
				'manual_filename' => $filename,
				'manual_category' => $category
			);

			$this -> db -> insert('manuals', $new_manual_data);

		}

		function add_manual_category($value)
		{

			$new_manual_cat = array('manual_cat' => $value);

			$this -> db -> insert('manual_cats', $new_manual_cat);
		}

		function is_category_empty($id)
		{

			$this -> db -> where('manual_category', $id);
			$query = $this -> db -> get('manuals');

			if ($query -> num_rows > 0)
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}

		}

		function delete_manual_category($id)
		{

			$this -> db -> where('manual_cat_id', $id);
			$delete = $this -> db -> delete('manual_cats');
			return TRUE;
		}

		function move_manual($manual, $destination)
		{

			$manual_move = array('manual_category' => $destination);

			$this -> db -> where('manual_id', $manual);
			$update = $this -> db -> update('manuals', $manual_move);
			return $update;

		}

		function delete_manual($filename, $id)
		{

			$this -> db -> where('manual_id', $id);

			$this -> db -> delete('manuals');

			$this -> gallery_path = "./images/manuals";
			unlink($this -> gallery_path . '/' . $filename);
			return TRUE;

		}

	}
