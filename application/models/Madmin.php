<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class Madmin extends CI_Model {
        
        

    public function __construct() {

        parent::__construct();
        
    }

    public function get_categories() {

        $query = $this->db->get('cateoffice');
        $return = array();

        foreach ($query->result() as $category)
        {
            $return[$category->id_cateoffice] = $category;
            $return[$category->id_cateoffice]->subs = $this->get_sub_categories($category->id_cateoffice); // Get the categories sub categories
        }

        return $return;
    }

    public function get_sub_categories($category_id) {

        $this->db->where('fk_cateoffice', $category_id);
        $query = $this->db->get('subcateoffice');
        return $query->result();
    }
        
}