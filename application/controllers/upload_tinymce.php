<?php 
class Upload_tinymce extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		$config['upload_path']          = './uploads/tinymce/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;

        $this->load->library('upload', $config);

        if ( !$this->upload->do_upload('file')){
                $error = array('error' => $this->upload->display_errors());
                $this->returnJson(array('error' => $error));
        }else{
                $data = array('upload_data' => $this->upload->data());
                $this->returnJson(array('error' => false,'path' => base_url().'uploads/tinymce/'.$data['upload_data']['file_name']));
        }
	}

	function returnJson($response){
		$this->output
        			->set_content_type('application/json')
        			->set_output(json_encode($response));
	} 
}
?>