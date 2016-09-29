<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
		
	parent::__construct();
            $this->load->database();
            $this->load->library('encryption');
		
    }
    
    public function create_user($username, $first_name, $last_name, $email, $password) {
		
	$data = array(
            'username' => $username,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $this->encryption->encrypt($password),
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
    
    public function resolve_user_login($username, $password) {
		
	$this->db->select('password');
	$this->db->from('users');
	$this->db->where('username', $username);
	$decrypt = $this->db->get()->row('password');
        
	$hash = $this->encryption->decrypt($decrypt);
        
	return password_verify($password, password_hash($hash, PASSWORD_BCRYPT));
        
    }

    public function get_user($uid) {
		
	$this->db->from('users');
	$this->db->where('uid', $uid);
	return $this->db->get()->row();
		
    } 
    
    public function set_permissions($uid, $username) {
	
	return $this->db->insert('permissions', array('uid' => $uid, 'username' => $username));
		
    }
    
    public function get_permissions($uid) {
        
        $query = $this->db->get_where('permissions', array('uid' => $uid));
        return $query->result_array();

    }
    
    // OTHER
    
    public function change_password($username, $password, $new_password) {
    
        $this->db->select('password');
	$this->db->from('users');
	$this->db->where('username', $username);
	$decrypt = $this->db->get()->row('password');
        
        $hash = $this->encryption->decrypt($decrypt);
		
	if (password_verify($password, password_hash($hash, PASSWORD_BCRYPT))) {
            
            $data = array(
                'password' => $this->encryption->encrypt($new_password),
            );
            
            $this->db->where('username', $username);
            return $this->db->update('users', $data);
        
        }
    }
    
    public function change_user_password($username, $new_password) {
            
        $data = array(
            'password' => $this->encryption->encrypt($new_password),
        );
            
        $this->db->where('username', $username);
        return $this->db->update('users', $data);
    }
    
} // END model