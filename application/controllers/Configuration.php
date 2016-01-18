<?php 
	class Configuration extends CI_Controller {

		function __construct(){
			parent::__construct();
			authenticate();
			$this->load->model('configuration/configuration_model');
		}

		function index(){
			$data['configuration'] = $this->configuration_model->get_configuration(); 

			$data['section_title'] = 'Configuration';
			$data['section'] = $this->load->view('/configuration/index', $data, true); 
			
			$this->load->view('/template/index', $data);
		}

		function edit_configuration(){
			$this->configuration_model->edit_configuration( $this->input->post() ); 
		}
	}
?>