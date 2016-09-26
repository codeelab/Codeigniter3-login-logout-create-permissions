<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_Force_Login {
    
    public function __construct() {
	parent::__construct();
            
    }
    
    public function index() {
        
        $data['page_title'] = 'Home - Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('home/view');
        $this->load->view('templates/footer');
    }
    
    public function permissions() {
        
        $data['page_title'] = 'Admin - Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/permission-denied');
        $this->load->view('templates/footer');
    }
} // END controller
