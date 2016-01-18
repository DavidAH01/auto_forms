<?php 
class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		only_logged_in();
	}

	function index(){
		$data['section_title'] = 'Dashboard';
		$data['section'] = $this->load->view('/dashboard/index', '', true); 
		
		$this->load->view('/template/index', $data);
	}
}
?>