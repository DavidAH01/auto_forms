<?php 
	class Configuration extends CI_Controller {

		function __construct(){
			parent::__construct();
			only_logged_in();
			//$this->load->model('auth/auth_model');
		}

		function index(){
			$data['section_title'] = 'Configuration';
			$data['section'] = $this->load->view('/configuration/index', '', true); 
			
			$this->load->view('/template/index', $data);
		}
	}
?>