<?php
Class Task_model extends CI_Model {

	function get_tasks($user_id) {
		$this->db->select('*');
		$this->db->from('task');
		$this->db->group_start(); 
		$this->db->where('is_private', '1');
		$this->db->where('administrator_id', $user_id);
		$this->db->group_end(); 
		$this->db->or_where('is_private', '0');
		$this->db->order_by('created_at', 'desc'); 

		$query = $this->db->get();
		return $query->result();
	}

	function get_task($task_id) {
		$this->db->select('*');
		$this->db->from('task');
		$this->db->or_where('id', $task_id);

		$query = $this->db->get();
		return $query->result_array();
	}

	function create_task($administrator_id, $description, $is_private){
		$this->db->set('created_at', date('Y-m-d h:i:s'));
		$this->db->set('administrator_id', $administrator_id);
		$this->db->set('is_private', $is_private);
		$this->db->set('description', $description);

		$this->db->insert('task');

		return $this->get_task($this->db->insert_id());
	}

	function edit_task($task_id, $description, $is_private){
		$this->db->set('updated_at', date('Y-m-d h:i:s'));
		$this->db->set('is_private', $is_private);
		$this->db->set('description', $description);
		$this->db->where('id', $task_id);

		$this->db->update('task');
	}

	function change_state_task($task_id, $state){
		$this->db->set('updated_at', date('Y-m-d h:i:s'));
		$this->db->set('state', $state);
		$this->db->where('id', $task_id);

		$this->db->update('task');
	}

	function delete_task($task_id){
		$this->db->where('id', $task_id);
		$this->db->delete('task');
	}
}