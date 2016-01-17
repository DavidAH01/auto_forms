<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged_in')){

    function is_logged_in(){
    	$CI = & get_instance();
    	$user = $CI->session->userdata();

    	if (!empty($user['name']) && !empty($user['role']) )
        	return true;

        return false;
    }   
} 

?>