<?php 
	class Administrators extends CI_Controller {

		function __construct(){
			parent::__construct();
			authenticate();

			$this->load->model('administrator/administrator_model');
		}

		function index(){
			only_super_administrator();
			$data['section_title'] = 'Administrators';
			$data['administrators'] = $this->administrator_model->get_administrators();
			$data['section'] = $this->load->view('/administrators/list', $data, true); 
			
			$this->load->view('/template/index', $data);
		}

		function user(){
			$user_id = $this->uri->segment(3, 0);
			$data['section_title'] = 'Administrators';
			$data['user'] = $this->administrator_model->get_administrator($user_id);
			$data['tables'] = $this->administrable_table_model->get_tables();
			$data['section'] = $this->load->view('/administrators/user', $data, true); 
			
			$this->load->view('/template/index', $data);
		}

		function create(){
			$data['section_title'] = 'Administrators';
			$data['tables'] = $this->administrable_table_model->get_tables();
			$data['section'] = $this->load->view('/administrators/user', $data, true); 
			
			$this->load->view('/template/index', $data);
		}

		function new_administrator(){	
			if ($this->is_valid_email()) {
				$this->administrator_model->new_administrator( $this->input->post() );
			}else{
				$this->output
        			->set_content_type('application/json')
        			->set_output(json_encode(array('error' => true)));
			}
		}

		function edit_administrator(){
			$email_in_db = $this->administrator_model->get_email_administrator( $this->input->post('id') );
			if ($email_in_db == $this->input->post('email')) {
				$this->administrator_model->edit_administrator( $this->input->post() );
			}else{
				if ($this->is_valid_email()) {
					$this->administrator_model->new_administrator( $this->input->post() );
				}else{
					$this->output
	        			->set_content_type('application/json')
	        			->set_output(json_encode(array('error' => true)));
				}
			}			
		}

		function is_valid_email(){
			$return = $this->administrator_model->verify_email( $this->input->post('email') );
			if($return)
				return false;

			return true;
		}

		function delete(){
			$user_id = $this->uri->segment(3, 0);
			$this->administrator_model->delete_administrator($user_id);

			redirect('administrators', 'refresh');
		}

		function delete_administrators(){
			$users = $this->input->post('users');
			for ($i=0; $i < count($users); $i++) { 
				$this->administrator_model->delete_administrator($users[$i]);
			}
		}
	}
?>












