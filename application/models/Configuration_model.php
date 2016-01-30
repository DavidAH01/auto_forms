<?php 
Class Configuration_model extends CI_Model {

	function get_configuration(){
		$this->db->select('*');
		$this->db->from('configuration');
		$this->db->where('id', '1');

		$query = $this->db->get();
		return $query->row();
	}

	function edit_configuration($data){
		$data['updated_at'] = date('Y-m-d h:i:s');
		$this->db->set($data);
		$this->db->where('id', 1);
		$this->db->update('configuration');
	}
}
	