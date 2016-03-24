<?php 
class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('administrator_model');
		$this->load->model('activity_model');
	}

	function index(){
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
			foreach($result as $row){
				if (crypt($password, $row->password) == $row->password){
				    $session_array = array(
						'user_id' => $row->id,
						'name' => $row->name,
						'is_super_administrator' => $row->is_super_administrator,
						'permissions' => $row->permissions,
						'time_zone' => $this->input->post('time-zone')
					);
					$this->session->set_userdata('logged_in', $session_array);
					date_default_timezone_set($this->session->userdata('logged_in')['time_zone']);
					$this->activity_model->add_activity(array('administrator_id' => $this->session->userdata('logged_in')['user_id'], 'type' => 'a_1'));
					return true;
				}else{
				    $this->form_validation->set_message('check_database', $this->lang->line('password_invalid'));
					return false;
				}
			}
		}else{
			$this->form_validation->set_message('check_database', $this->lang->line('name_invalid'));
			return false;
		}
	}

	function update_password(){
		$user = $this->session->userdata('logged_in');
    	if (empty($user['name']) || empty($user['user_id']) && !empty($this->input->get('token'))){
     		$token = explode('/-/', base64_decode($this->input->get('token')));
     		$data['id'] = $token[0];
     		$data['hash'] = $token[1];
     		$verify = $this->auth_model->verify_recovery($data['id'], $data['hash']);
     		if ($verify) {
     			$data['section'] = $this->load->view('/auth/update_password', $data, true);
				$this->load->view('/template/auth', $data);
     		}else{
     			redirect('main', 'refresh');
     		}
		}else{
			redirect('main', 'refresh');		
		}
	}

	function save_password(){
		$verify = $this->auth_model->verify_recovery($this->input->post('id'), $this->input->post('hash'));
 		if ($verify) {
 			$data['id'] = $this->input->post('id');
 			$data['password'] = $this->input->post('password');
 			$this->administrator_model->edit_administrator($data);
			return_json(array('error' => false, 'msg' => $this->lang->line('passsword_updated')));
 		}else{
 			return_json(array('error' => true, 'msg' => $this->lang->line('not_allowed_change_passsword')));
 		}
	}

	function recover_password(){
		$data['email'] = $this->input->post('email');
		$data['hash'] = urlencode(substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22));
		$data['hash'] = strtr($data['hash'], array('+' => '.', '/' => '.', '%' => '.')); 
		$user = $this->auth_model->get_user_by_email($data['email']);
		if ($user) {
			$data['id'] = $user->id;
			$data['name'] = $user->name;
			$this->auth_model->recover_password($data['email'], $data['hash']);
			$this->load->library('email', config_mail());
			$this->email->set_mailtype("html");
			$this->email->from('no-reply@autoforms.com', 'Auto Forms');
			$this->email->to($data['email']); 
			$this->email->subject('Reset password - Auto_Foms');
			$this->email->message($this->load->view('mail/recover_password',$data,true));	
			$this->email->send();
			return_json(array('error' => false, 'msg' => $this->lang->line('send_recover_email')));
		}else{
			return_json(array('error' => true, 'msg' => $this->lang->line('email_not_registered')));
		}
	}

	function logout(){
		$this->activity_model->add_activity(array('administrator_id' => $this->session->userdata('logged_in')['user_id'], 'type' => 'a_2'));
	   	$this->session->unset_userdata('logged_in');
	   	redirect('/auth', 'refresh');
	}
}
?>