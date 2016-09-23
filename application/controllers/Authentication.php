<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

    public function __construct() {
        
	parent::__construct();
            $this->load->model('user_model');
            
    }
        
    public function login() {
        
        if (isset($_SESSION['logged_in']) === TRUE) {
            
            redirect('/');
            
        } else {
		
            $this->load->helper('form');
            $this->load->library('form_validation');

            // validation rules
            $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == false) {

                $data['page_title'] = 'Login - Dashboard';

                $this->load->view('templates/header', $data);
                $this->load->view('templates/login');
                $this->load->view('templates/footer');

            } else {

                $username = $this->input->post('username');
                $password = $this->input->post('password');

                if ($this->user_model->resolve_user_login($username, $password)) {

                    // login successful
                    $uid = $this->user_model->get_uid_from_username($username);
                    $user = $this->user_model->get_user($uid);

                    $_SESSION['uid'] = (int)$user->uid;
                    $_SESSION['username'] = (string)$user->username;
                    $_SESSION['logged_in'] = (bool)true;
                    $_SESSION['permissions'] = $this->user_model->get_permissions($uid);
                    
                    redirect('/');

                } else {

                    // login failed
                    $data = new stdClass();
                    $data->error = 'Wrong username or password.';

                    $this->load->view('templates/header');
                    $this->load->view('templates/login', $data);
                    $this->load->view('templates/footer');

                }
            }
        } // END if loggedin
    } // END login
    
    public function logout() {
		
	if (isset($_SESSION['logged_in']) === FALSE) {
            
            redirect('/');         
            
        } else {
			
            // clear session
            foreach ($_SESSION as $key => $value) {
		unset($_SESSION[$key]);
            }
            
            redirect('/');
			
        }
    } // END logout	
} // END controller
