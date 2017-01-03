<?php 
class Auto_forms extends CI_Controller {

	function __construct(){
		parent::__construct();
		authenticate();
		only_super_administrator();
	}

	function index(){
		$data['section_title'] = $this->lang->line('tables');
		$data['adminsitrable_tables'] = $this->administrable_table_model->get_tables();
		$data['section'] = $this->load->view('/auto_forms/list', $data, true); 
		
		$this->load->view('/template/index', $data);
	}

	function edit(){
		$table = $this->uri->segment(3, 0);
		$data['table'] = $table;
		$data['administrable_id'] = $this->input->get('administrable');
		$data['section_title'] = $this->lang->line('tables');
		$fields = $this->administrable_table_model->get_fields_table($table);

		$i = 0;
		foreach ($fields as $field) {
			if ($field->Field == 'id' || $field->Field == 'id_administrator' || $field->Field == 'record_order' || $field->Field == 'created_at' || $field->Field == 'updated_at') {
				unset($fields[$i]);
			}else{
				$field_name = $field->Field;
				$field_name = explode('_', $field_name);
				$field->Component = $field_name[count($field_name)-1];
				unset($field_name[count($field_name)-1]);
				$field->Name = implode(' ', $field_name);
			}
			$i++;
		}
		$data['fields'] = $fields;
		$data['section'] = $this->load->view('/auto_forms/form', $data, true); 
		
		$this->load->view('/template/index', $data);
	}
}
?>