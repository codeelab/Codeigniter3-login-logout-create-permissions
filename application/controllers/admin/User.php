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
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();
        $output = $crud->render();
        
        $data['page_title'] = 'Users - Dashboard';
        
        $this->load->view('templates/header.php', $data);
        $this->load->view('admin/user/view.php', $output);
        $this->load->view('templates/footer.php');
        $this->load->view('templates/table_assets.php', $output);
        
    }
    
    public function create_new () {
		
        $this->load->helper('form');
        $this->load->library('form_validation');

        // validation rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('first_name', 'First name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');

        if ($this->form_validation->run() === false) {

            $data['page_title'] = 'Create New User - Dashboard';

            $this->load->view('templates/header', $data);
            $this->load->view('admin/user/create_new/view');
            $this->load->view('templates/footer');

        } else {

            $username = $this->input->post('username');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if ($this->user_model->create_user($username, $first_name, $last_name, $email, $password)) {

                $uid = $this->user_model->get_uid_from_username($username);
                $this->user_model->set_permissions($uid);

                $data['page_title'] = 'New User Created - Dashboard';

                // user created
                $this->load->view('templates/header', $data);
                $this->load->view('admin/user/create_new/success');
                $this->load->view('templates/footer');

            } else {

                $data = new stdClass();
                $data->error = 'There was a problem creating your new account. Please try again.';

                // failed to create user
                $this->load->view('templates/header');
                $this->load->view('admin/user/create_new/view');
                $this->load->view('templates/footer');

            }	
        }
    } // END create
    
    public function change_user_password() {
		
        $this->load->helper('form');
        $this->load->library('form_validation');

        // validation rules
        $this->form_validation->set_rules('full_name', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('new_password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[new_password]');

        if ($this->form_validation->run() === false) {

            $data['page_title'] = 'Change User Password - Dashboard';

            $this->load->view('templates/header', $data);
            $this->load->view('admin/user/change_user_password/view');
            $this->load->view('templates/footer');

        } else {

            $username = $this->input->post('full_name');
            $new_password = $this->input->post('new_password');
            $new_password_confirm = $this->input->post('new_password_confirm');

            if ($this->user_model->change_user_password($username, $new_password)) {

                $data['page_title'] = 'Change User Password - Dashboard';

                $this->load->view('templates/header', $data);
                $this->load->view('admin/user/change_user_password/success');
                $this->load->view('templates/footer');

            } else {

                $data = new stdClass();
                $data->error = "User wasn't found. Please try again.";

                // failed to create user
                $this->load->view('templates/header', $data);
                $this->load->view('admin/user/change_user_password/view', $data);
                $this->load->view('templates/footer');

            }
        }
     } // END change password
} // END controller
