<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('only_logged_in')){

    function only_logged_in(){
    	$CI = & get_instance();
    	$user = $CI->session->userdata('logged_in');

    	if (empty($user['name']) || empty($user['user_id']) )
        	redirect('/auth', 'refresh');
    }   
} 

?>