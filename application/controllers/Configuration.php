<?php 
class Configuration extends CI_Controller {

	function __construct(){
		parent::__construct();
		authenticate();
		only_super_administrator();

		$this->load->model('configuration_model');
	}

	function index(){
		$data['section_title'] = $this->lang->line('configuration');
		$data['configuration'] = $this->configuration_model->get_configuration(); 
		$data['section'] = $this->load->view('/configuration/index', $data, true); 
		
		$this->load->view('/template/index', $data);
	}

	function edit_configuration(){
		$this->configuration_model->edit_configuration($this->input->post());
		return_json(array('msg' => $this->lang->line('configuration_updated')));
	}
}
?>