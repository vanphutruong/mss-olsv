<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*T_User
*Description: model manage user
*@author quanhm
*/

Class T_email_template extends MY_Model{

	function __construct() { 
		parent::__construct();

		$this->table_name = 'email_template';
	}

/**
*function get_data_by_id
*
*Get data by id
*@param: 
*	param 1 : field list need get
*	param 2 : id user
*@return array|null
*@author quanhm
*
**/

	function get_data_by_id($select = '*', $id = null){
		//validate data
		if(!is_null($id) && is_numeric($id)){
			$this->db->where("ID = $id LIMIT 1");
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
*Set data user
*@param: 
*	param 1 : array data user
*	param 2 : result return condition
*@return id_user|object user|null
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
		$id_user = $this->db->insert_id();

		//return result
		if($result == 0){
			return $id_user;
		}else{
			$user = $this->get_data_by_id('*', $id_user);
			return $user;
		}
	}
	
/**
*function update_data_by_id
*
*Update data user by id
*@param: 
*	param 1 : array data user
*	param 2 : id_user
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
		$this->db->where('ID', $id );

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
*Update data user by property
*@param: 
*	param 1 : array data user
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
