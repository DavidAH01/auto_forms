<?php 
	class Users extends CI_Controller {

		function __construct(){
			parent::__construct();
			//$this->load->model('auth/auth_model');
		}

		function index(){
			$data['section_title'] = 'Administrators';
			$data['section'] = $this->load->view('/administrators/list', '', true); 
			
			$this->load->view('/template/index', $data);
		}

		function user(){
			$data['section_title'] = 'Administrators';
			$data['section'] = $this->load->view('/administrators/user', '', true); 
			
			$this->load->view('/template/index', $data);
		}
	}
?>