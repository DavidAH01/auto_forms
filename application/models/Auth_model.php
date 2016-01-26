<?php
Class Auth_model extends CI_Model {

	function login($name) {
		$this->db->select('id, name, password, is_super_administrator, permissions');
		$this->db->from('administrator');
		$this->db->where('name', $name);
		$this->db->where('state', '1');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

	function get_user_by_email($email){
		$this->db->select('id, name');
		$this->db->from('administrator');
		$this->db->where('email', $email);

		$query = $this->db->get();
		return $query->row();
	}

	function recover_password($email, $hash){
		$recovery_date = strtotime ('+5 day', strtotime(date('Y-m-d h:i:s')));
		$recovery_date = date('Y-m-d h:i:s', $recovery_date);

		$this->db->set('updated_at', date('Y-m-d h:i:s'));
		$this->db->set('recovery_hash', $hash);
		$this->db->set('recovery_date', $recovery_date);

		$this->db->where('email', $email);
		$this->db->update('administrator');
	}

	function verify_recovery($user, $hash){
		$this->db->select('id');
		$this->db->from('administrator');
		$this->db->where('id', $user);
		$this->db->where('recovery_hash', $hash);
		$this->db->where('recovery_date >=', date('Y-m-d h:i:s'));

		$query = $this->db->get();
		if ($query->num_rows() > 0)
			return true;

		return false;
	}
}