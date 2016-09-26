<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Force_Admin {

    public function __construct() {
        
	parent::__construct();
            $this->load->library('grocery_CRUD');
            $this->load->model('user_model');
            
    }
    
    
    public function index() {
        
        $this->grocery_crud->set_table('users');
        $output = $this->grocery_crud->render();

        echo "<pre>";
        print_r($output);
        echo "</pre>";
        die();
        
    }
} // END controller
