<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        
	parent::__construct();
            
    }
    
    public function index() {
        
        $data['page_title'] = 'Home - Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('view');
        $this->load->view('templates/footer');
    }
} // END controller
