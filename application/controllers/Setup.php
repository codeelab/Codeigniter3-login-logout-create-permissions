<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    public function __construct() {
        
	parent::__construct();
            $this->load->model('user_model');
            
    }
    
    public function index() {
		
        $this->load->helper('form');
        $this->load->library('form_validation');

        // validation rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');

        if ($this->form_validation->run() === false) {

            $data['page_title'] = 'Setup - Dashboard';

            $this->load->view('templates/header', $data);
            $this->load->view('setup');
            $this->load->view('templates/footer');

        } else {

            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if ($this->user_model->create_user($username, $email, $password)) {

                $uid = $this->user_model->get_uid_from_username($username);
                $this->user_model->set_permissions($uid);

                $data['page_title'] = 'Setup - Dashboard';

                // user created
                redirect('/');

            } else {

                $data = new stdClass();
                $data->error = 'There was a problem creating your new account. Please try again.';

                // failed to create user
                $this->load->view('templates/header');
                $this->load->view('setup');
                $this->load->view('templates/footer');

            }	
        }
    } // END register
} // END controller
