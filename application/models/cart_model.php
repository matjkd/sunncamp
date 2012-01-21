<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     *
     * @param type $option_id
     * @param type $value
     * @return type 
     */
    function change_stock($option_id, $value) {

        $content_update = array(
            'stock_level' => $value
        );


        $this->db->where('option_id', $option_id);
        $update = $this->db->update('product_options', $content_update);
        return $update;
    }

    /**
     *
     * @param type $option_id
     * @param type $user_id
     * @param type $value
     * @return type 
     */
    function update_cart($option_id, $user_id, $value) {

        //check cart item exists
        if ($this->check_cart($user_id, $option_id)) {
            $content_update = array(
                'quantity' => $value
            );

            $this->db->where('cart_option_id', $option_id);
            $this->db->where('cart_user_id', $user_id);
            $update = $this->db->update('cart', $content_update);
            return $update;
        } else { //add new row to cart table
            $form_data = array(
                'cart_user_id' => $user_id,
                'quantity' => $value,
                'cart_option_id' => $option_id
            );

            $insert = $this->db->insert('cart', $form_data);
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
    function check_cart($user_id, $option_id) {

        $this->db->where('cart_user_id', $user_id);
        $this->db->where('cart_option_id', $option_id);
        $query = $this->db->get('cart');
        if ($query->num_rows == 1) {
            return $query->result();
        }

        return FALSE;
    }

    /**
     *
     * @return type 
     */
    function get_my_cart($user_id) {

        $this->db->where('cart_user_id', $user_id);
        $query = $this->db->get('cart');
        if ($query->num_rows > 0) {
            return $query->result();
        }

        return FALSE;
    }

}