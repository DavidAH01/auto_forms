<?php 
	class Administrators extends CI_Controller {

		function __construct(){
			parent::__construct();
			authenticate();

			$this->load->model('administrator_model');
			$this->load->model('activity_model');
		}

		function index(){
			only_super_administrator();
			$data['section_title'] = $this->lang->line('administrators');
			$data['administrators'] = $this->administrator_model->get_administrators();
			$data['section'] = $this->load->view('/administrators/list', $data, true); 
			
			$this->load->view('/template/index', $data);
		}

		function user(){
			$user_id = $this->uri->segment(3, 0);
			$data['section_title'] = $this->lang->line('administrators');
			$data['user'] = $this->administrator_model->get_administrator($user_id);
			$data['tables'] = $this->administrable_table_model->get_tables();
			$data['section'] = $this->load->view('/administrators/user', $data, true); 
			
			$this->load->view('/template/index', $data);
		}

		function create(){
			$data['section_title'] = $this->lang->line('administrators');
			$data['tables'] = $this->administrable_table_model->get_tables();
			$data['section'] = $this->load->view('/administrators/user', $data, true); 
			
			$this->load->view('/template/index', $data);
		}

		function new_administrator(){	
			if ($this->is_valid_email()) {
				$this->administrator_model->new_administrator( $this->input->post() );
			}else{
        		return_json(array('error' => true, 'msg' => $this->lang->line('email_registered')));
			}
		}

		function edit_administrator(){
			$email_in_db = $this->administrator_model->get_email_administrator( $this->input->post('id') );
			if ($email_in_db == $this->input->post('email')) {
				$this->administrator_model->edit_administrator( $this->input->post() );
				return_json(array('error' => false, 'msg' => $this->lang->line('information_updated')));
			}else{
				if ($this->is_valid_email()) {
					$this->administrator_model->edit_administrator( $this->input->post() );
					return_json(array('error' => false, 'msg' => $this->lang->line('information_updated')));
				}else{
					return_json(array('error' => true, 'msg' => $this->lang->line('email_registered')));
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
			$this->activity_model->delete_activity($user_id);

			redirect('administrators', 'refresh');
		}

		function delete_administrators(){
			$users = $this->input->post('users');
			for ($i=0; $i < count($users); $i++) { 
				$this->administrator_model->delete_administrator($users[$i]);
				$this->activity_model->delete_activity($users[$i]);
			}
		}
	}
?>