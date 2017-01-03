<?php
Class Activity_model extends CI_Model {

	function get_activities() {
		$this->db->select('activity.*, administrator.name');
		$this->db->from('activity, administrator');
		$this->db->where('activity.administrator_id = administrator.id');
		$this->db->order_by('created_at', 'DESC');

		$query = $this->db->get();
		return $query->result();
	}

	function add_activity($data) {
		$this->db->set('created_at', date('Y-m-d h:i:s'));
		$this->db->set($data);
		$this->db->insert('activity');
	}

	function delete_activity($user) {
		$this->db->where('administrator_id', $user);
		$this->db->delete('activity');
	}
}