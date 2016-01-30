<?php 
class Upload_tinymce extends CI_Controller {

	function __construct(){
	   parent::__construct();
       authenticate();
	}

	function index(){
        if (!file_exists('./uploads/tinymce/'))
            mkdir('./uploads/tinymce/', 0777, true);

		$config['upload_path']          = './uploads/tinymce/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000; // Maximun size 10mb

        $this->load->library('upload', $config);

        if ( !$this->upload->do_upload('file')){
                $error = array('error' => $this->upload->display_errors());
                return_json(array('error' => $error));
        }else{
                $data = array('upload_data' => $this->upload->data());
                return_json(array('error' => false, 'path' => base_url().'uploads/tinymce/'.$data['upload_data']['file_name']));
        }
	}
}
?>