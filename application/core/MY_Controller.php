<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_Force_Login extends CI_Controller {

    function __construct(){
	parent::__construct();
        
        if (isset($_SESSION['logged_in']) === FALSE) {
            
            $this->session->set_userdata('after_login_redirect', current_url());
            redirect('login');
            
        }
    }
}

class My_Force_Admin extends My_Force_Login {

    function __construct(){
	parent::__construct();
        $this->load->library('session');
	
	if (isset($_SESSION['permissions'][0]['admin']) === '0') {
                    
            //redirect('admin/permissions');
            $this->load->view('templates/header');
                    
	}
    }
}

