<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('authenticate')){
    function authenticate(){
    	$CI = & get_instance();
    	$user = $CI->session->userdata('logged_in');

    	if (empty($user['name']) || empty($user['user_id']) )
        	redirect('/auth', 'refresh');
    }   
}

if ( ! function_exists('is_super_administrator')){

    function is_super_administrator(){
    	$CI = & get_instance();
    	$user = $CI->session->userdata('logged_in');

    	if ($user['is_super_administrator'] == 1)
        	return true;

    	return false;
    }   
}

if ( ! function_exists('only_super_administrator')){

    function only_super_administrator(){
        $CI = & get_instance();
        $user = $CI->session->userdata('logged_in');

        if ($user['is_super_administrator'] != 1)
            redirect('/dashboard', 'refresh');
    }   
}

?>