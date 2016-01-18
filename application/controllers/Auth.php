<?php 
class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('auth/auth_model');
	}

	function index(){
		$data['section_title'] = 'Login';
		$data['section'] = $this->load->view('/auth/login', '', true); 
		
		$this->load->view('/template/auth', $data);
	}

	function verify() {
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

		if($this->form_validation->run()) {
			redirect('/dashboard', 'refresh');
		}else{
			$data['section_title'] = 'Login';
			$data['section'] = $this->load->view('/auth/login', '', true); 
		
			$this->load->view('/template/auth', $data);
		}
	}

	function check_database($password){
		$name = $this->input->post('name');
		$password = $this->input->post('password');

		$result = $this->auth_model->login($name);

		if($result){
			$session_array = array();
			foreach($result as $row){
				if (crypt($password, $row->password) == $row->password){
				    $session_array = array(
						'user_id' => $row->id,
						'name' => $row->name,
						'is_super_administrator' => $row->is_super_administrator,
						'permissions' => $row->permissions
					);

					$this->session->set_userdata('logged_in', $session_array);
					return true;
				}else{
				    $this->form_validation->set_message('check_database', 'The password is invalid');
					return false;
				}
			}
		}else{
			$this->form_validation->set_message('check_database', 'The name is invalid');
			return false;
		}
	}

	function change_password(){
		autenticate();
		$data['section'] = '/auth/change_password';
		$this->load->view('/template/auth', $data);
	}

	function update_password(){
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean');
		if($this->form_validation->run()) {
			$user_id = $this->session->userdata('logged_in')['user_id'];
			$password = $this->input->post('password');
			$this->auth_model->change_password($user_id, $password);
			$data['success'] = 'La contraseña ha sido actualizada';
		}

		$data['section'] = '/login/change_password';
		$this->load->view('/template/auth', $data);
		
	}

	function forgotten_password(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		
		if($this->form_validation->run()) {
			$email = $this->input->post('email');

			$password = rand (19238312,1283719292318);
			$this->auth_model->forgotten_password($email, $password, $tipo);

			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from('not-reply@auto_forms.com', 'Auto_Forms');
			$this->email->to($email); 

			$this->email->subject('New password');
			$this->email->message('We have received a request for recovery password for access to our content manager.<br><br>Your new password is: '.$password.'<br><br> Remember, to access our module you must click on the following link (or copy it into the address bar of your browser) and type your username and new password.<br><br><a href="'.base_url().'/auto_forms">'.base_url().'/auto_forms</a><br><br>');	

			$this->email->send();

			$data['success'] = 'We sent an email with instructions income.';
		}

		$data['section'] = '/auth/login';
		$this->load->view('/template/auth', $data);
		
	}

	function logout(){
	   	$this->session->unset_userdata('logged_in');
	   	redirect('/auth', 'refresh');
	}
}
?>