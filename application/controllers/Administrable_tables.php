<?php 
class Administrable_tables extends CI_Controller {

	function __construct(){
		parent::__construct();
		authenticate();

		$this->load->model('activity_model');
	}

	function view(){
		$table = $this->uri->segment(3, 0);
		$data['table'] = $table;
		$data['current_table'] = $table;
		$data['fields'] = $this->fields($table, true);
		$data['records'] = $this->administrable_table_model->get_records_table($table);
		$data['section_title'] = ucfirst(str_replace('_', ' ', $table));
		$data['administrable_table'] = true;
		$data['section'] = $this->load->view('/administrable_tables/list', $data, true); 

		$this->load->view('/template/index', $data);
	}

	function order_records(){
		$record = $this->input->post('id');
		$table = $this->input->post('table');
		$order = $this->input->post('record_order');
		$this->administrable_table_model->order_records_table($record, $table, $order);
	}

	function create(){
		$table = $this->uri->segment(3, 0);
		$data['current_table'] = $table;
		$data['record_id'] = '';
		$data['list_fields'] = $this->list_fields();
		$data['fields'] = $this->fields($table);
		$data['section_title'] = ucfirst(str_replace('_', ' ', $table));
		$data['administrable_table'] = true;
		$data['section'] = $this->load->view('/administrable_tables/form', $data, true); 
		
		$this->load->view('/template/index', $data);
	}

	function insert_table(){
		$data = $this->input->post();
		$table = $this->input->post('current_table');
		$indicate_files = array();
		if(isset($_FILES) && !empty($_FILES)){
			foreach ($_FILES as $file) {
				foreach ($file['name'] as $key => $value) {
					$field_name = $key;
					$file_name = date("YmdHis").$value;
					$data[$field_name] = $file_name;
					array_push($indicate_files, $field_name);
				}
			}
			$this->upload_file($indicate_files, 'files');
		}
		$record_id = $this->administrable_table_model->save_table($table, null, $data);
		$this->activity_model->add_activity(array('administrator_id' => $this->session->userdata('logged_in')['user_id'], 'type' => 't_1', 'table' => $table, 'record_id' => $record_id));
	}

	function edit(){
		$table = $this->uri->segment(3, 0);
		$record = $this->input->get('record');
		$data['fields'] = $this->fields($table);
		$data['list_fields'] = $this->list_fields();
		$data['record_id'] = $record;
		$data['current_table'] = $table;
		$data['stored_data'] = $this->administrable_table_model->get_record_table($table, $record);
		$data['section_title'] = ucfirst(str_replace('_', ' ', $table));
		$data['administrable_table'] = true;
		$data['section'] = $this->load->view('/administrable_tables/form', $data, true); 
		
		$this->load->view('/template/index', $data);
	}

	function update_table(){
		$data = $this->input->post();
		$table = $this->input->post('current_table');
		$record = $this->input->post('record_id');
		$indicate_files = array();
		if(isset($_FILES) && !empty($_FILES)){
			foreach ($_FILES as $file) {
				foreach ($file['name'] as $key => $value) {
					$field_name = $key;
					$file_name = date("YmdHis").$value;
					$data[$field_name] = clear($file_name);
					array_push($indicate_files, $field_name);
				}
			}
			$this->upload_file($indicate_files, 'files');
		}
		$this->administrable_table_model->save_table($table, $record, $data);
		$this->activity_model->add_activity(array('administrator_id' => $this->session->userdata('logged_in')['user_id'], 'type' => 't_2', 'table' => $table, 'record_id' => $record));
		return_json(array('msg' => $this->lang->line('information_updated')));
	}

	function delete(){
		$table = $this->uri->segment(3, 0);
		$record = $this->input->get('record');
		$this->administrable_table_model->delete_record_table($table, $record);
		$this->activity_model->add_activity(array('administrator_id' => $this->session->userdata('logged_in')['user_id'], 'type' => 't_3', 'table' => $table));
		
		redirect('administrable_tables/view/'.$table, 'refresh');
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
                	if ($type_field != 'textarea' && $type_field != 'multiselect'  && $type_field != 'multirelation' && $type_field != 'gallery' && $type_field != 'order' && $type_field != 'administrator' && $type_field != 'steps' && $type_field != 'list' && $type_field != 'maps' && $type_field != 'at') {
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
		$list_fields->color_field = '/administrable_tables/fields/color';
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
		$list_fields->steps_field = '/administrable_tables/fields/steps';
		$list_fields->list_field = '/administrable_tables/fields/list';

		return $list_fields;
	}

	function gallery(){
		$table = $this->uri->segment(3, 0);
		$gallery = $this->input->get('gallery');
		$data['current_table'] = $table;
		$data['gallery'] = $gallery;
		$data['files'] = $this->administrable_table_model->get_files_gallery($gallery);
		$data['section_title'] = ucfirst(str_replace('_', ' ', $table));
		$data['administrable_table'] = true;
		$data['no_header_no_footer'] = true;
		$data['section'] = $this->load->view('/administrable_tables/gallery', $data, true); 
		
		$this->load->view('/template/index', $data);
	}

	function save_files_gallery(){
		$table = $this->input->post('table');
		$gallery = $this->input->post('gallery');
		$indicate_files = array();
		if(isset($_FILES) && !empty($_FILES)){
			foreach ($_FILES as $file) {
				foreach ($file['name'] as $key => $value) {
					$field_name = $key;
					$file_name = date("YmdHis").$value;
					$data[$field_name] = $file_name;
					array_push($indicate_files, $field_name);
					$this->administrable_table_model->save_files_gallery($gallery, $table, $file_name);
				}
			}
			$this->upload_file($indicate_files, $table);
		}
		redirect('/administrable_tables/gallery/'.$table.'?gallery='.$gallery, 'refresh');
	}

	function upload_file($indicate_files, $folder){
		$this->load->library('upload');
	    $files = $_FILES;
	    $count = count($_FILES['file']['name']);
	    for($i=0; $i<$count; $i++){          
	        $_FILES['file']['name'] = date("YmdHis").clear($files['file']['name'][ $indicate_files[$i] ]);
	        $_FILES['file']['type'] = $files['file']['type'][ $indicate_files[$i] ];
	        $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][ $indicate_files[$i] ];
	        $_FILES['file']['error'] = $files['file']['error'][ $indicate_files[$i] ];
	        $_FILES['file']['size'] = $files['file']['size'][ $indicate_files[$i] ];    

	        $this->upload->initialize($this->set_upload_options($folder));
	        if(!$this->upload->do_upload('file')){
	        	print_r($this->upload->display_errors());
	        	exit();
	        }

	    }
	}

	private function set_upload_options($folder){   
	    if (!file_exists('./uploads/'.$folder.'/')) 
		    mkdir('./uploads/'.$folder.'/', 0777, true);

	    $config['upload_path'] = './uploads/'.$folder.'/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10000; // Maximun size 10mb
        $config['overwrite'] = true;

	    return $config;
	}

	function delete_file(){
		$this->administrable_table_model->delete_files_gallery($this->input->post('id'));
		return_json(array('msg' => $this->lang->line('file_deleted')));
	}

	function order_files(){
		$this->administrable_table_model->order_files_gallery($this->input->post());
	}

	function delete_records(){
		$table = $this->input->post('table');
		$records = $this->input->post('records');
		for ($i=0; $i < count($records); $i++) { 
			$this->administrable_table_model->delete_record_table($table, $records[$i]);
		}
	}
}
?>