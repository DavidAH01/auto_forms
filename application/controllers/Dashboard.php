<?php 
class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		authenticate();

		$this->load->model('dashboard/task_model');
	}

	function index(){
		$data['tasks'] = $this->task_model->get_tasks( $this->session->userdata('logged_in')['user_id'] ); 

		$data['section_title'] = 'Dashboard';
		$data['section'] = $this->load->view('/dashboard/index', $data, true); 

		$this->load->view('/template/index', $data);
	}

	function create_task(){
		$task = $this->task_model->create_task( $this->session->userdata('logged_in')['user_id'], $this->input->post('description'), $this->input->post('is_private') ); 
		$this->output
        			->set_content_type('application/json')
        			->set_output(json_encode($task));
	}

	function edit_task(){
		$this->task_model->edit_task( $this->input->post('id'), $this->input->post('description'), $this->input->post('is_private') ); 
	}

	function change_state_task(){
		$this->task_model->change_state_task( $this->input->post('id'), $this->input->post('state') ); 
	}

	function delete_task(){
		echo $this->input->post('id');
		$this->task_model->delete_task( $this->input->post('id')  ); 
	}
}
?>