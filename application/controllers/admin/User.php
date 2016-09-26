<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Force_Admin {

    public function __construct() {
        
	parent::__construct();
            $this->load->library('grocery_CRUD');
            $this->load->model('user_model');
            
    }
    
    public function index() {
        
        $crud = new grocery_CRUD();
     // $crud->set_theme('flexigrid'); SET DEFAULT IN CONFIG
        $crud->set_table('users');
        $crud->set_subject('User', 'Users');
        $crud->columns('uid','username', 'first_name', 'last_name','email','account_type', 'created_at');
        $crud->display_as('uid','User ID');
        $output = $crud->render();
        
        $data['page_title'] = 'Users - Dashboard';
        
        $this->load->view('templates/header.php', $data);
        $this->load->view('admin/user/view.php', $output);
        $this->load->view('templates/footer.php');
        $this->load->view('templates/table_assets.php', $output);
        
    }
} // END controller
