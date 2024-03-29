<?php

	if (!defined('BASEPATH'))
		exit('No direct script access allowed');

	class Cart_model extends CI_Model
	{

		function __construct()
		{
			// Call the Model constructor
			parent::__construct();
		}

		function update_stock($user_id, $option_id, $sum)
		{
			//get the current stock value

			$this -> db -> where('option_id', $option_id);
			$current_stock = $this -> db -> get('product_options');
			$row1 = $current_stock -> row();
			$oldstockvalue = $row1 -> stock_level;
			$this -> db -> flush_cache();

			//get cart value
			if ($this -> check_cart($user_id, $option_id))
			{

				$this -> db -> where('cart_option_id', $option_id);
				$this -> db -> where('cart_user_id', $user_id);
				$this -> db -> where('order_id', 0);
				$current_value = $this -> db -> get('cart');

				$row = $current_value -> row();
				$oldcartvalue = $row -> quantity;
				$this -> db -> flush_cache();
			}
			else
			{
				$oldcartvalue = 0;
			}

			if ($sum == "plus")
			{

				if ($oldcartvalue > 0)
				{
					$newstockvalue = intval($oldstockvalue) + 1;
					$newcartvalue = intval($oldcartvalue) - 1;
				}
				else
				{
					$newstockvalue = intval($oldstockvalue);
					$newcartvalue = intval($oldcartvalue);
				}
			}

			if ($sum == "minus")
			{
				if ($oldstockvalue > 0)
				{
					$newstockvalue = intval($oldstockvalue) - 1;
					$newcartvalue = intval($oldcartvalue) + 1;
				}
				else
				{
					$newstockvalue = intval($oldstockvalue);
					$newcartvalue = intval($oldcartvalue);
				}
			}

			$stock_update = array('stock_level' => $newstockvalue);

			//update stock
			$this -> db -> where('option_id', $option_id);
			$update = $this -> db -> update('product_options', $stock_update);

			$this -> db -> flush_cache();

			//update cart
			if ($this -> check_cart($user_id, $option_id))
			{
				$cart_update = array('quantity' => $newcartvalue);

				$this -> db -> where('cart_option_id', $option_id);
				$this -> db -> where('cart_user_id', $user_id);
				$this -> db -> where('order_id', 0);
				$update = $this -> db -> update('cart', $cart_update);
			}
			else
			{
				$form_data = array(
					'cart_user_id' => $user_id,
					'quantity' => $newcartvalue,
					'cart_option_id' => $option_id
				);

				$insert = $this -> db -> insert('cart', $form_data);
			}
		}

		/*
		 *
		 */

		function set_stock($option_id, $value)
		{

			$content_update = array('stock_level' => $value);

			$this -> db -> where('option_id', $option_id);
			$update = $this -> db -> update('product_options', $content_update);
			return;
		}

		/**
		 *
		 * @param type $option_id
		 * @param type $value
		 * @return type
		 */
		function change_stock($option_id, $sum)
		{

			//get the current stock value

			$this -> db -> where('option_id', $option_id);
			$current_value = $this -> db -> get('product_options');

			$row = $current_value -> row();
			$oldvalue = $row -> stock_level;

			if ($sum == "plus")
			{
				$newvalue = $oldvalue + 1;
			}

			if ($sum == "minus" && $oldvalue > 0)
			{
				$newvalue = $oldvalue - 1;
			}

			$content_update = array('stock_level' => $newvalue);

			$this -> db -> where('option_id', $option_id);
			$update = $this -> db -> update('product_options', $content_update);
			return $update;
		}

		/**
		 *
		 * @param type $option_id
		 * @param type $user_id
		 * @param type $value
		 * @return type
		 */
		function update_cart($option_id, $user_id, $sum)
		{

			//check cart item exists
			if ($this -> check_cart($user_id, $option_id))
			{

				//get the current cart value

				$this -> db -> where('cart_option_id', $option_id);
				$this -> db -> where('cart_user_id', $user_id);
				$this -> db -> where('order_id', 0);
				$current_value = $this -> db -> get('cart');

				$row = $current_value -> row();
				$oldvalue = $row -> quantity;

				if ($sum == "plus")
				{
					$newvalue = $oldvalue + 1;
				}

				if ($sum == "minus" && $oldvalue > 0)
				{
					$newvalue = $oldvalue - 1;
				}

				$content_update = array('quantity' => $newvalue);

				$this -> db -> where('cart_option_id', $option_id);
				$this -> db -> where('cart_user_id', $user_id);
				$this -> db -> where('order_id', 0);
				$update = $this -> db -> update('cart', $content_update);
				return $update;
			}
			else
			{
				//add new row to cart table
				$form_data = array(
					'cart_user_id' => $user_id,
					'quantity' => 1,
					'cart_option_id' => $option_id
				);

				$insert = $this -> db -> insert('cart', $form_data);
				return $insert;
			}

			return;
		}

		/**
		 *
		 * @param type $user_id
		 * @param type $option_id
		 * @return type
		 */
		function check_cart($user_id, $option_id)
		{
			$this -> db -> where('cart_status', 0);
			$this -> db -> where('order_id', 0);
			$this -> db -> where('cart_user_id', $user_id);
			$this -> db -> where('cart_option_id', $option_id);
			$query = $this -> db -> get('cart');
			if ($query -> num_rows == 1)
			{
				return $query -> result();
			}

			return FALSE;
		}

		/**
		 *
		 * @return type
		 */
		function get_my_cart($user_id)
		{
			$this -> db -> where('cart_status', 0);
			$this -> db -> where('order_id', 0);
			$this -> db -> where('cart_user_id', $user_id);
			$query = $this -> db -> get('cart');
			if ($query -> num_rows > 0)
			{
				return $query -> result();
			}

			return FALSE;
		}

		/*
		 *
		 */
		function list_cart_contents($user_id, $status = 0)
		{

			$this -> db -> join('cart', 'cart.cart_option_id = product_options.option_id');
			$this -> db -> join('products', 'products.product_id = product_options.product_id');
			$this -> db -> where('cart.cart_user_id', $user_id);
			$this -> db -> where('cart_status', $status);
			$this -> db -> where('cart.quantity >', 0);
			$query = $this -> db -> get('product_options');
			if ($query -> num_rows > 0)
			{
				return $query -> result();
			}
			return FALSE;
		}

		/*
		 *
		 */
		function list_order_contents($user_id, $status = 1)
		{

			$this -> db -> join('cart', 'cart.cart_option_id = product_options.option_id');
			$this -> db -> join('products', 'products.product_id = product_options.product_id');
			$this -> db -> join('order', 'order.order_id = cart.order_id');
			$this -> db -> where('cart.cart_user_id', $user_id);
			$this -> db -> where('cart_status >', 0);
			$this -> db -> where('cart.quantity >', 0);
			$query = $this -> db -> get('product_options');
			if ($query -> num_rows > 0)
			{
				return $query -> result();
			}
			return FALSE;
		}

		function list_orders($user_id)
		{
			$this->db->join('order', 'order.order_id = cart.order_id');
			$this->db->join('order_status', 'order_status.status_id = order.orderstatus');
			$this->db->join('product_options', 'product_options.option_id = cart.cart_option_id');
			$this -> db -> join('products', 'products.product_id = product_options.product_id');
			
			$this->db->where('cart.order_id >', 0);
			$this -> db -> where('order.user_id', $user_id);
			$query = $this -> db -> get('cart');
			if ($query -> num_rows > 0)
			{
				return $query -> result();
			}
			return FALSE;
			
		}

function order_ids($user_id) {
	$this->db->join('order_status', 'order_status.status_id = order.orderstatus');
			$this -> db -> where('user_id', $user_id);
			$query = $this -> db -> get('order');
			if ($query -> num_rows > 0)
			{
				return $query -> result();
			}
			return FALSE;
}

		function list_all_carts()
		{

			$this -> db -> join('users', 'users.user_id = cart.cart_user_id');
			$this -> db -> group_by('cart.cart_user_id');
			$this -> db -> where('cart.quantity !=', 0);
			$query = $this -> db -> get('cart');
			if ($query -> num_rows > 0)
			{
				return $query -> result();
			}
			return FALSE;
		}

		function create_order($user_id, $ref, $status)
		{

			$new_cat_parent = array(
				'user_id' => $user_id,
				'date_created' => time(),
				'paypalref' => $ref,
				'orderstatus' => $status
			);

			$insert = $this -> db -> insert('order', $new_cat_parent);
			return $insert;
		}

		function convert_cart_to_order($user_id, $order_id)
		{
				
				
			$this->freeze_prices($user_id);

			$update_cart = array(
				'order_id' => $order_id,
				'cart_status' => 1
			);
			$this -> db -> where('cart_user_id', $user_id);
			$this -> db -> where('cart_status', 0);
			$update = $this -> db -> update('cart', $update_cart);
			return $update;
		}
		
		
		private function freeze_prices($user_id) {
			
			$cart = $this->list_cart_contents($user_id);
			foreach($cart as $row):
				
				$update_cart = array(
				'orderedprice' => $row->price
			);
			$this->db->where('cart_id', $row->cart_id);
			$this -> db -> where('cart_user_id', $user_id);
			$this -> db -> where('cart_status', 0);
			$update = $this -> db -> update('cart', $update_cart);
				
			endforeach;
			
			return TRUE;
			
		}

		function delete_cart($user_id)
		{
			$this -> db -> where('cart_status', 0);
			$this -> db -> where('cart_user_id', $user_id);
			$query = $this -> db -> delete('cart');

			return;
		}

	}
