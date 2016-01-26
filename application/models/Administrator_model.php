<?php 
Class Administrator_model extends CI_Model {

	function get_administrators(){
		$this->db->select('*');
		$this->db->from('administrator');

		$query = $this->db->get();
		return $query->result();
	}

	function get_administrator($administrator_id){
		$this->db->select('*');
		$this->db->from('administrator');
		$this->db->where('id', $administrator_id);

		$query = $this->db->get();
		return $query->row();
	}

	function new_administrator($data){
		$password = $data['password'];
		$password = $this->encrypt_password($password);
		$data['password'] = $password;
		$data['created_at'] = date('Y-m-d h:i:s');
		$this->db->insert('administrator', $data); 
	}

	function edit_administrator($data){
		$user_id = $data['id'];
		unset($data['id']);
		
		if (!empty($data['password'])) {
			$password = $data['password'];
			$password = $this->encrypt_password($password);
			$data['password'] = $password;
		}else{
			unset($data['password']);
		}
		
		$data['updated_at'] = date('Y-m-d h:i:s');
		$this->db->where('id', $user_id);
		$this->db->update('administrator', $data); 
	}

	function verify_email($email){
		$this->db->select('email');
		$this->db->from('administrator');
		$this->db->where('email', $email);

		$query = $this->db->get();
		return $query->num_rows();
	}

	function encrypt_password($password){
		$salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
		$salt = strtr($salt, array('+' => '.')); 

		$hash = crypt($password, '$2y$10$' . $salt);
		return $hash;
	}

	function delete_administrator($user_id){
		$this->db->where('id', $user_id);
		$this->db->delete('administrator'); 
	}

	function get_email_administrator($user_id){
		$this->db->select('email');
		$this->db->from('administrator');
		$this->db->where('id', $user_id);

		$query = $this->db->get();
		$query = $query->row();
		return $query->email;
	}
}