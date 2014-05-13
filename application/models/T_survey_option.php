<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*T_User
*Description: model manage t_survey_option
*@author quanhm
*/

Class T_survey_option extends MY_Model{

	function __construct() { 
		parent::__construct();

		$this->table_name = 't_survey_option';
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
			$this->db->where("id_survey = $id LIMIT 1");
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
*Set data t_dropdown
*@param: 
*	param 1 : array data t_dropdown
*	param 2 : result return condition
*@return id_t_dropdown|object t_dropdown|null
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
			$t_dropdown = $this->get_data_by_id('*', $id_last);
			return $t_dropdown;
		}
	}
	
/**
*function update_data_by_id
*
*Update data t_dropdown by id
*@param: 
*	param 1 : array data t_dropdown
*	param 2 : id t_dropdown
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
		$this->db->where('id_survey', $id );

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
*Update data t_dropdown by property
*@param: 
*	param 1 : array data t_dropdown
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
	 * [get_sum_point description]
	 * @return [type] int|false [description]
	 */
	public function get_sum_point($id_survey = -1, $in = array())
	{

		if( $in ){

			$size = count($in);

			$id_string = "";

			for( $i = 0; $i < $size -1; $i++ ){

				$id_string .= $in[$i]['id_question'] .',';

			}

			$id_string .= $in[$size -1]['id_question'];

		}else{

			return false;

		}

		$query = $this->db->query("select distinct sum(`in_point`) as sum from `t_survey_option` left join `t_survey_response_dtl` on `t_survey_option`.`id_question` = `t_survey_response_dtl`.`id_question` and `t_survey_option`.`id_answer` = `t_survey_response_dtl`.`id_answer` where `t_survey_response_dtl`.`id_survey` = $id_survey and `t_survey_option`.`id_question` in ($id_string)");

		if( $query->result_array() ){

			return $query->result_array();

		}else{

			return false;

		}
	}
}
