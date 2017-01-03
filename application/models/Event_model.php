<?php
Class Event_model extends CI_Model {

	function get_events() {
		$this->db->select('*');
		$this->db->from('event');

		$query = $this->db->get();
		return $query->result();
	}

	function add_event($data) {
		$this->db->insert('event', $data);
		return $this->db->insert_id();
	}

	function update_event($data){
		$event = $data['event_id'];
		unset($data['event_id']);

		$this->db->where('id', $event);
		$this->db->update('event', $data);
	}

	function delete_event($data){
		$event = $data['event_id'];
		unset($data['event_id']);
		
		$this->db->where('id', $event);
		$this->db->delete('event');
	}
}