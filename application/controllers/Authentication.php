<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

    public function __construct() {
        
	parent::__construct();
            $this->load->library('encryption');
            $this->load->model('user_model');
            
    }
    
    public function index() {
        redirect('home');
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
                    
                    redirect($_SESSION['after_login_redirect']);

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
    
    public function change_password() {
        
        if (isset($_SESSION['logged_in']) === FALSE) {
            
            $this->session->set_userdata('after_login_redirect', current_url());
            redirect('login');
            
        } else {
		
            $this->load->helper('form');
            $this->load->library('form_validation');

            // validation rules
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('new_password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[new_password]');

            if ($this->form_validation->run() === false) {

                $data['page_title'] = 'Create New User - Dashboard';

                $this->load->view('templates/header', $data);
                $this->load->view('admin/user/change_password/view');
                $this->load->view('templates/footer');

            } else {

                $username = $_SESSION['username'];
                $password = $this->input->post('password');
                $new_password = $this->input->post('new_password');
                $new_password_confirm = $this->input->post('new_password_confirm');

                if ($this->user_model->change_password($username, $password, $new_password)) {

                    $data['page_title'] = 'Create New User - Dashboard';

                    $this->load->view('templates/header', $data);
                    $this->load->view('admin/user/change_password/success');
                    $this->load->view('templates/footer');

                } else {

                    $data = new stdClass();
                    $data->error = 'Current password incorrect. Please try again.';

                    // failed to create user
                    $this->load->view('templates/header', $data);
                    $this->load->view('admin/user/change_password/view', $data);
                    $this->load->view('templates/footer');

                }
            } // END if logged in
        }
     } // END change password
} // END controller
