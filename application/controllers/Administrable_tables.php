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
			$configuration_field = $field->Comment;
			$options_field = $field->Type;
            $field = explode('_', $complete_name_field);
            if (count($field) > 1) {
                $type_field = $field[ count($field)-1 ];
                unset($field[ count($field)-1 ]);
                $name_field = ucfirst(implode(' ', $field));
                if ($type_field == 'select' || $type_field == 'multiselect' || $type_field == 'radio' || $type_field == 'checkbox' ) {
                    $options_field = str_replace(array('set',"'",'"','(',')'), array('','','','',''), $options_field);
                    $options_field = explode(',', $options_field);
                }elseif ($type_field == 'relation' || $type_field == 'multirelation') {
                	$options_field = $this->relation_fields($name_field);
                }
                if ($for_view) {
                	if ($type_field != 'textarea' && $type_field != 'relation' && $type_field != 'multirelation' && $type_field != 'gallery' && $type_field != 'file' && $type_field != 'order' && $type_field != 'administrator' && $type_field != 'maps' && $type_field != 'at') {
	                    array_push($data['fields'], array('complete_name' => $complete_name_field, 'name' => $name_field, 'type' => $type_field, 'configuration' => $configuration_field, 'options' => $options_field));
	                }
                }else{
                	array_push($data['fields'], array('complete_name' => $complete_name_field, 'name' => $name_field, 'type' => $type_field, 'configuration' => $configuration_field, 'options' => $options_field));
                }        
            }
        }

        return $data['fields'];
	}

	function relation_fields($field){
		$table = str_replace(' ', '_', $field);
		$fields = $this->administrable_table_model->get_fields_table($table);
		$records = $this->administrable_table_model->get_table($table);
		$options = array();
		$i = 0;
		foreach ($fields as $field) {
			if ($i == 1) {
				foreach ($records as $record) {
					array_push($options, array('id' => $record->id, 'name' => $record->{$field->Field}));
				}
			}
			$i++;
		}
		return $options;
	}

	function list_fields(){
		$list_fields = new stdClass();
		$list_fields->text_field = '/administrable_tables/fields/text';
		$list_fields->textarea_field = '/administrable_tables/fields/textarea';
		$list_fields->number_field = '/administrable_tables/fields/number';
		$list_fields->datetime_field = '/administrable_tables/fields/datetime';
		$list_fields->slider_field = '/administrable_tables/fields/slider';
		$list_fields->select_field = '/administrable_tables/fields/select';
		$list_fields->multiselect_field = '/administrable_tables/fields/multiselect';
		$list_fields->radio_field = '/administrable_tables/fields/radio';
		$list_fields->checkbox_field = '/administrable_tables/fields/checkbox';
		$list_fields->administrator_field = '/administrable_tables/fields/administrator';
		$list_fields->file_field = '/administrable_tables/fields/file';
		$list_fields->map_field = '/administrable_tables/fields/map';
		$list_fields->gallery_field = '/administrable_tables/fields/gallery';
		$list_fields->relation_field = '/administrable_tables/fields/relation';
		$list_fields->multirelation_field = '/administrable_tables/fields/multirelation';

		return $list_fields;
	}

	function gallery(){
		$table = $this->uri->segment(3, 0);
		$gallery = $this->input->get('gallery');
		$data['table'] = $table;
		$data['gallery'] = $gallery;
		$data['images'] = $this->administrable_table_model->get_images_gallery($gallery);
		$data['section_title'] = ucfirst(str_replace('_', ' ', $table));
		$data['administrable_table'] = true;
		$data['section'] = $this->load->view('/administrable_tables/gallery', $data, true); 
		
		$this->load->view('/template/index', $data);
	}
}
?>