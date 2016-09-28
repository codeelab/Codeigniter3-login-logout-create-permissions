<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
		
	parent::__construct();
            $this->load->database();
		
    }
    
    //CREATE
    
    public function create_user($username, $first_name, $last_name, $email, $password) {
		
	$data = array(
            'username' => $username,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $this->hash_password($password),
            'created_at' => date('Y-m-j H:i:s'),
            'account_type' => 'local',
	);	
        
	return $this->db->insert('users', $data);
		
    }
    
    public function get_uid_from_username($username) {
		
	$this->db->select('uid');
	$this->db->from('users');
	$this->db->where('username', $username);

	return $this->db->get()->row('uid');
		
    }
    
    public function set_permissions($uid, $username) {
	
	return $this->db->insert('permissions', array('uid' => $uid, 'username' => $username));
		
    }
    
    private function hash_password($password) {
		
	return password_hash($password, PASSWORD_BCRYPT);
		
    }
    
    //LOGIN
    
    public function resolve_user_login($username, $password) {
		
	$this->db->select('password');
	$this->db->from('users');
	$this->db->where('username', $username);
	$hash = $this->db->get()->row('password');
		
	return $this->verify_password_hash($password, $hash);
        
    }
    
    public function get_permissions($uid) {
        
        $query = $this->db->get_where('permissions', array('uid' => $uid));
        return $query->result_array();

    }

    public function get_user($uid) {
		
	$this->db->from('users');
	$this->db->where('uid', $uid);
	return $this->db->get()->row();
		
    }
    
    private function verify_password_hash($password, $hash) {
		
	return password_verify($password, $hash);
		
    }    
    
    public function change_password($username, $password, $new_password) {
    
        $this->db->select('password');
	$this->db->from('users');
	$this->db->where('username', $username);
	$hash = $this->db->get()->row('password');
		
	if ($this->verify_password_hash($password, $hash)) {
            
            $data = array(
                'password' => $this->hash_password($new_password),
            );
            
            $this->db->where('username', $username);
            return $this->db->update('users', $data);
        
        }
    }
    
    public function change_user_password($username, $new_password) {
            
        $data = array(
            'password' => $this->hash_password($new_password),
        );
            
        $this->db->where('username', $username);
        return $this->db->update('users', $data);
    }
    
} // END model
