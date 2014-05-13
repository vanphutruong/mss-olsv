<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*T_User
*Description: model manage vwaccess_currentversion
*@author quanhm
*/

Class Vwaccess_currentversion extends MY_Model{

	function __construct() { 
		parent::__construct();

		$this->table_name = 'vwaccess_currentversion';
	}

/**
*function get_data_by_id
*
*Get data by id
*@param: 
*	param 1 : field list need get
*	param 2 : id
*@return array|null
*@author quanhm
*
**/
	function get_data_by_id($select = '*', $id = null){
		//validate data
		if(!is_null($id) && is_numeric($id)){
			$this->db->where("id = $id LIMIT 1");
		}else{
			return null;
		}

		//select data
		if(strcmp($select, '*') != 0){
			$this->db->select($select);
		}else{
			$this->db->select();
		}

		//query db
		$query= $this->db->get($this->table_name);

		$query = $query->result_array();

		//return result
		return $query[0];
	}

/**
*function get_data_by_property
*
*Get data by property
*@param: 
*	param 1 : field list to take
*	param 2 : condition
*@return array|null
*@author quanhm
*
**/
	function get_data_by_property($select, $where = array()){
		//validate data
		if(!is_null($where) && is_array($where)){
			$this->db->where($where);
		}else{
			return null;
		}

		//select data
		if(strcmp($select, '*') != 0){
			$this->db->select($select);
		}else{
			$this->db->select();
		}
		
		//query
		$query= $this->db->get($this->table_name);

		//return result
		return $query->result_array();
	}


/**
*function set_data
*
*Set data vwaccess_currentversion
*@param: 
*	param 1 : array data vwaccess_currentversion
*	param 2 : result return condition
*@return id_vwaccess_currentversion|object vwaccess_currentversion|null
*@author quanhm
*
**/
	function set_data($data = array(), $result = 0){
		if(is_null($data) || !is_array($data))
		{
			return null;
		}
		
		//insert data
		$this->db->insert($this->table_name, $data);

		//get last id
		$id_last = $this->db->insert_id();

		//return result
		if($result == 0){
			return $id_last;
		}else{
			$vwaccess_currentversion = $this->get_data_by_id('*', $id_last);
			return $vwaccess_currentversion;
		}
	}
	
/**
*function update_data_by_id
*
*Update data vwaccess_currentversion by id
*@param: 
*	param 1 : array data vwaccess_currentversion
*	param 2 : id vwaccess_currentversion
*@return true|false
*@author quanhm
*
**/

	function update_data_by_id($data = array(), $id){
		//validate data
		if(is_null($data) || !is_array($data)){
			return null;
		}

		//get data by id
		$this->db->where('id', $id );

		//update
		$this->db->update($this->table_name, $data);
		
		//return result
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}	
	}


/**
*function update_data_by_property
*
*Update data vwaccess_currentversion by property
*@param: 
*	param 1 : array data vwaccess_currentversion
*	param 2 : condition
*@return true|false
*@author quanhm
*
**/
	function update_data_by_property ($data = array(), $where = array()){
		//validate data
		if(is_null($data) || !is_array($data)){
			return null;
		}

		if(is_null($where) || !is_array($where)){
			return null;
		}

		//get data by condition where
		$this->db->where($where);

		//update data
		$this->db->update($this->table_name, $data);

		//return result
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}

	}
}
