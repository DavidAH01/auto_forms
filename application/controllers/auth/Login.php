<?php 
class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('auth/auth_model');
	}

	function index(){
		$data['section_title'] = 'Dashboard';
		$data['section'] = $this->load->view('/dashboard/dashboard', '', true); 
		
		$this->load->view('/template/index', $data);
	}

	function verify() {

		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean|callback_check_database');
		$type = $this->input->post('type');

		if($this->form_validation->run()) {
			if ($type == 1) {
				redirect('/orden_visible', 'refresh');
			}else if ($type == 2) {
				redirect('/cliente', 'refresh');
			}else{
				$data['content'] = '/login/index';
				$this->load->view('/includes/template', $data);
			}
		}else{
			$data['content'] = '/login/index';
			$this->load->view('/includes/template', $data);
		}
	}

	function check_database($password){

		$email = $this->input->post('email');
		$type = $this->input->post('type');

		$result = $this->login_model->login($email, $password, $type);

		if($result){
			$sess_array = array();
			foreach($result as $row){
				if ($type == 1) {
					$sess_array = array(
						'user_id' => $row->cliente_id,
						'nombre' => $row->razon_social,
						'tipo' => 'cliente'
					);
				}else if ($type == 2) {
					$sess_array = array(
						'user_id' => $row->administrador_id,
						'nombre' => $row->nombre,
						'tipo' => 'admin',
						'clase' => $row->tipo
					);
				}else{
					return false;
				}
				
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return true;
		}else{
			$this->form_validation->set_message('check_database', 'El email o la contraseña son invalidos');
			return false;
		}
	}

	function change_password(){
		autenticate();
		$data['content'] = '/login/change_password';
		$this->load->view('/includes/template', $data);
	}

	function changePassword(){
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean');
		if($this->form_validation->run()) {
			$user_id = $this->session->userdata('logged_in')['user_id'];
			$tipo = $this->session->userdata('logged_in')['tipo'];
			$password = $this->input->post('password');
			$this->login_model->changePassword($user_id, $tipo, $password);
			$data['success'] = 'La contraseña ha sido actualizada';
		}

		$data['content'] = '/login/change_password';
		$this->load->view('/includes/template', $data);
		
	}

	function forgotten_password(){
		$data['content'] = '/login/forgotten_password';
		$this->load->view('/includes/template', $data);
	}

	function forgottenPassword(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('type', 'Tipo de usuario', 'trim|required|xss_clean');
		if($this->form_validation->run()) {
			$email = $this->input->post('email');
			$tipo = $this->input->post('type');
			$password = rand (19238312,1283719292318);
			$this->login_model->forgottenPassword($email, $password, $tipo);

			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from('not-reply@alfonsosenior.com', 'Alfonso Senior');
			$this->email->to($email); 

			$this->email->subject('Recuperación contraseña Módulo de Seguimiento de Ordenes');
			$this->email->message('Hemos recibido una solicitud de recuperación de contraseña para el acceso a nuestro <strong>Módulo de Seguimiento de Ordenes.</strong><br><br>Su nueva contraseña es: '.$password.'<br><br> Recuerde, para acceder a nuestro módulo usted deberá hacer clic en el siguiente enlace (o copiarlo en la barra de direcciones de su navegador) y digitar su usuario y nueva contraseña: <br><br><a href="www.alfonsosenior.com/clientes">www.alfonsosenior.com/clientes</a><br><br>Usuario: '.$email.' <br><br>Cordial saludo, <br><br>Departamento Comercial<br>Agencia Aduanera Alfonso Senior & CIA S.A. Nivel 2');	

			$this->email->send();


			$data['success'] = 'Te enviemos un email con las instrucciones de ingreso.';
		}

		$data['content'] = '/login/forgotten_password';
		$this->load->view('/includes/template', $data);
		
	}

	function logout(){
	   	$this->session->unset_userdata('logged_in');
	   	redirect('login', 'refresh');
	}
}
?>