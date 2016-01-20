<?php 
class Administrable_tables extends CI_Controller {

	function __construct(){
		parent::__construct();
		authenticate();
	}

	function view(){
		$table = $this->uri->segment(3, 0);
		$data['table'] = $table;
		$data['fields'] = $this->fields($table, true);
		$data['records'] = $this->administrable_table_model->get_records_table($table);
		$data['section_title'] = ucfirst(str_replace('_', ' ', $table));
		$data['administrable_table'] = true;
		$data['section'] = $this->load->view('/administrable_tables/list', $data, true); 
		
		$this->load->view('/template/index', $data);
	}

	function create(){
		$table = $this->uri->segment(3, 0);
		$data['table'] = $table;
		$data['list_fields'] = $this->list_fields();
		$data['fields'] = $this->fields($table);
		$data['section_title'] = ucfirst(str_replace('_', ' ', $table));
		$data['administrable_table'] = true;
		$data['section'] = $this->load->view('/administrable_tables/table', $data, true); 
		
		$this->load->view('/template/index', $data);
	} 

	function edit(){
		$table = $this->uri->segment(3, 0);
		$record = $this->input->get('record');
		$data['list_fields'] = $this->list_fields();
		$data['record_id'] = $record;
		$data['table'] = $table;
		$data['record'] = $this->administrable_table_model->get_record_table($table, $record);
		$data['section_title'] = ucfirst(str_replace('_', ' ', $table));
		$data['administrable_table'] = true;
		$data['section'] = $this->load->view('/administrable_tables/table', $data, true); 
		
		$this->load->view('/template/index', $data);
	}

	function fields($table, $for_view = false){
		$fields = $this->administrable_table_model->get_fields_table($table);
		$data['fields'] = array();
		foreach ($fields as $field) {
			$complete_name_field = $field->Field;
            $field = explode('_', $complete_name_field);
            if (count($field) > 1) {
                $type_field = $field[ count($field)-1 ];
                unset($field[ count($field)-1 ]);
                $name_field = ucfirst(implode(' ', $field));
                if ($for_view) {
                	if ($type_field != 'textarea' && $type_field != 'relation' && $type_field != 'multirelation' && $type_field != 'gallery' && $type_field != 'file' && $type_field != 'order' && $type_field != 'administrator' && $type_field != 'maps' && $type_field != 'at') {
	                    array_push($data['fields'], array('complete_name' => $complete_name_field, 'name' => $name_field, 'type' => $type_field));
	                }
                }else{
                	array_push($data['fields'], array('complete_name' => $complete_name_field, 'name' => $name_field, 'type' => $type_field));
                }        
            }
        }

        return $data['fields'];
	}

	function list_fields(){
		$list_fields = new stdClass();
		$list_fields->text_field = '/administrable_tables/fields/text';
		$list_fields->textarea_field = '/administrable_tables/fields/textarea';
		$list_fields->number_field = '/administrable_tables/fields/number';

		return $list_fields;
	}
}
?>

