<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*T_User
*Description: model manage t_survey_question
*@author quanhm
*/

Class T_survey_question extends MY_Model{

	function __construct() { 
		parent::__construct();

		$this->table_name = 't_survey_question';		
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
			$this->db->where("id_question = $id LIMIT 1");
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
*Set data t_survey_question
*@param: 
*	param 1 : array data t_survey_question
*	param 2 : result return condition
*@return id_t_survey_question|object t_survey_question|null
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
			$t_survey_question = $this->get_data_by_id('*', $id_last);
			return $t_survey_question;
		}
	}
	
/**
*function update_data_by_id
*
*Update data t_survey_question by id
*@param: 
*	param 1 : array data t_survey_question
*	param 2 : id t_survey_question
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
		$this->db->where('id_question', $id );

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
*Update data t_survey_question by property
*@param: 
*	param 1 : array data t_survey_question
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

	/**
	 * [get_first_data_order_by_id description]
	 * @return [int] [id of first element]
	 */
	public function get_data_order_by_id( $index = 0 )
	{
		$this->db->select('id_question, nm_question, nm_category');

		$this->db->order_by('ID_QUESTION ASC');

		$query = $this->db->get($this->table_name);

		$query = $query->result_array();

		if( count($query) > $index ){

			return $query[$index];			
		}

		return -1;
	}

	public function get_max_id_question()
	{
		$this->db->select('id_question');

		$this->db->order_by('ID_QUESTION DESC');

		$query = $this->db->get($this->table_name);

		$query = $query->result_array();

		return $query[0];
	}
}
