<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('adminsitrable_tables')){
    function adminsitrable_tables(){
    	$CI = & get_instance();
    	$user = $CI->session->userdata('logged_in');
    	$tables = $CI->administrable_table_model->get_tables();

    	if ($user['is_super_administrator']) {
    		return $tables;
    	}else{
    		$permissions = explode(',', $user['permissions']);
    		$tables_allowed = array();
    		foreach ($tables as $table) {
    			if (in_array($table->name, $permissions)) {
    				array_push($tables_allowed, $table);
    			}
    		}
    		return $tables_allowed;
    	}
    }   
}
?>