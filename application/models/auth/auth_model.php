<?php
Class Auth_model extends CI_Model {

	function login($email, $password, $type) {
		
		if ($type == 1) {
			$this->db->select('cliente_id, razon_social, password');
			$this->db->from('cliente');
		}else if ($type == 2) {
			$this->db->select('administrador_id, nombre, password, tipo');
			$this->db->from('administrador');
		}else{
			return false;
		}
		$this->db->where('email', $email);
		$this->db->where('password', MD5($password));
		$this->db->limit(1);

		$query = $this->db->get();

		if($query -> num_rows() == 1){
			return $query->result();
		}else{
			return false;
		}
	}

	function changePassword($user_id, $tipo, $password){
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

	function forgottenPassword($email, $password, $tipo){
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