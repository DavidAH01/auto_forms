<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('config_mail')){
    function config_mail(){
    	return $config = array(
    			//'protocol' => 'smtp',
			    //'smtp_host' => 'ssl://smtp.googlemail.com',
			    //'smtp_port' => '465',
			    //'smtp_user' => 'xxxx@gmail.com',
			    //'smtp_pass' => 'xxxxxx',
			    'wordwrap' => TRUE,
				'charset' => 'iso-8859-1',
				'mailtype' => 'html'
			);
    }   
}

?>