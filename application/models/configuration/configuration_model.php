<?php 
Class Configuration_model extends CI_Model {

	function get_configuration(){
		$this->db->select('*');
		$this->db->from('configuration');
		$this->db->where('id', '1');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
	}

	function edit_configuration($data){
		$this->db->set($data);
		$this->db->where('id', 1);

		$this->db->update('configuration');
	}
}
?>
	