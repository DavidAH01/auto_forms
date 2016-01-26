<?php 
class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		authenticate();

		$this->load->model('task_model');
	}

	function index(){
		$data['section_title'] = $this->lang->line('dashboard');
		$data['tasks'] = $this->task_model->get_tasks( $this->session->userdata('logged_in')['user_id'] ); 
		$data['section'] = $this->load->view('/dashboard/index', $data, true); 

		$this->load->view('/template/index', $data);
	}

	function create_task(){
		$task = $this->task_model->create_task($this->session->userdata('logged_in')['user_id'], $this->input->post('description'), $this->input->post('is_private')); 
        return_json(array('task' => $task, 'msg' => $this->lang->line('task_created')));
	}

	function edit_task(){
		$this->task_model->edit_task($this->input->post('id'), $this->input->post('description'), $this->input->post('is_private')); 
	}

	function change_state_task(){
		$this->task_model->change_state_task($this->input->post('id'), $this->input->post('state')); 
	}

	function delete_task(){
		$this->task_model->delete_task($this->input->post('id'));
		return_json(array('msg' => $this->lang->line('task_deleted')));
	}
}
?>