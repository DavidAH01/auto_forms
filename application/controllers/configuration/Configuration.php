<?php 
	class Configuration extends CI_Controller {

		function __construct(){
			parent::__construct();
			//$this->load->model('auth/auth_model');
		}

		function index(){
			$data['section_title'] = 'Configuration';
			$data['section'] = $this->load->view('/configuration/configuration', '', true); 
			
			$this->load->view('/template/index', $data);
		}
	}
?>