<?php
Class Auth_model extends CI_Model {

	function login($name) {
		$this->db->select('id, name, password, is_super_administrator, permissions');
		$this->db->from('administrator');
		
		$this->db->where('name', $name);
		$this->db->where('state', '1');
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1){
			return $query->result();
		}else{
			return false;
		}
	}

	function change_password($user_id, $password){
		$this->db->set('updated_at', date('Y-m-d h:i:s',time()));
		$this->db->set('password', md5($password));
		if ($tipo == "admin") {
			$this->db->where('administrador_id', $user_id);
			$this->db->update('administrador');
		}else{
			$this->db->where('cliente_id', $user_id);
			$this->db->update('cliente');
		}
	}

	function forgotten_password($email, $password){
		$this->db->set('updated_at', date('Y-m-d h:i:s',time()));
		$this->db->set('password', md5($password));
		if ($tipo == 1) {
			$this->db->where('email', $email);
			$this->db->update('cliente');
		}else{
			$this->db->where('email', $email);
			$this->db->update('administrador');
		}
	}
}
?>