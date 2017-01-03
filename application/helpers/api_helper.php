<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('api_get')){
    function api_get($data){
    	$CI = & get_instance();
    	$DB = $CI->load->database();

    	if (isset($data->select) && !empty($data->select))
    		$DB->select($data->select);
    	else
    		$DB->select('*');

    	$DB->from($data->table);

    	for ($i=0; $i < count($data->where); $i++) { 
    		$DB->where($data->where[$i]);
    	}

    	for ($i=0; $i < count($data->order); $i++) { 
    		$DB->where($data->order[$i]);
    	}

    	$query = $DB->get();

    	if ($data->all)
    		return $query->result();
    	
    	return $query->row();
    }   
}
?>