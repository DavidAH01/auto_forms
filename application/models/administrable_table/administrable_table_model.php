<?php 
Class Administrable_table_model extends CI_Model {

	function get_tables(){
		$this->db->select('*');
		$this->db->from('Administrable_table');

		$query = $this->db->get();
		return $query->result();
	}

	function get_table($table){
		$this->db->select('*');
		$this->db->from($table);

		$query = $this->db->get();
		return $query->result();
	}

	function get_fields_table($table){
		$sql = "SHOW FULL COLUMNS FROM ".$table;
		$query = $this->db->query($sql);
		return $query->result();			
	}

	function get_records_table($table){
		$this->db->select('*');
		$this->db->from($table);

		$query = $this->db->get();
		return $query->result();
	}

	function get_record_table($table, $record){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('id', $record);

		$query = $this->db->get();
		return $query->result();
	}

	function get_images_gallery($gallery){
		$this->db->select('*');
		$this->db->from('upload');
		$this->db->where('gallery_id', $gallery);

		$query = $this->db->get();
		return $query->result();
	}

	function save_table($table, $record, $data){
		unset($data['current_table']);
		unset($data['record_id']);

		if (is_null($record)) {
			$data['created_at'] = date('Y-m-d h:i:s',time());
			$this->db->insert($table, $data);
		}else{
			$data['updated_at'] = date('Y-m-d h:i:s',time());
			$this->db->where('id', $record);
			$this->db->update($table, $data);
		}
	}
}
?>