<?php 
class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		if ($this->session->userdata('logged_in'))
			redirect('dashboard', 'refresh');
		
		redirect('auth', 'refresh');
	}
}
?>