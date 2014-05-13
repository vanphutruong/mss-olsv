<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*T_User
*Description: model manage t_company_info
*@author quanhm
*/

Class T_company_info extends MY_Model{

	function __construct() { 
		parent::__construct();

		$this->table_name = 't_company_info';
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
			$this->db->where("id_company = $id LIMIT 1");
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
		if (count($query)) {

			return $query[0];
			
		} else {
			
			return null;
		}
		
		
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
*Set data t_company_info
*@param: 
*	param 1 : array data t_company_info
*	param 2 : result return condition
*@return id_t_company_info|object t_company_info|null
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

			$t_company_info = $this->get_data_by_id('*', $id_last);

			return $t_company_info;
		}
	}
	
/**
*function update_data_by_id
*
*Update data t_company_info by id
*@param: 
*	param 1 : array data t_company_info
*	param 2 : id t_company_info
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
		$this->db->where('id_company', $id );

		//update
		$this->db->update($this->table_name, $data);
		
		//return result
		// if($this->db->affected_rows() > 0){

		// 	return true;

		// }else{
			
		// 	return false;
		// }
		return true;	
	}
/**
*function update_data_by_property
*
*Update data t_company_info by property
*@param: 
*	param 1 : array data t_company_info
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
		// if($this->db->affected_rows() > 0){

		// 	return true;

		// }else{
			
		// 	return false;
		// }
		return true;

	}

	/**
	 * [get_data_by_id_login description]
	 * @param  [type] $id_login [id_login of user]
	 * @param  [type] $search   [field need take]
	 * @return [aray]           [description]
	 */
	public function get_data_by_id_login( $search, $id_login = '')
	{
		$this->db->select('t_company_info.id_company,t_survey_response_hdr.id_survey, t_survey_response_hdr.tx_status, nm_company, t_survey_response_hdr.consultant_id');
		
		$this->db->from($this->table_name);

		$this->db->join('t_survey_response_hdr', "$this->table_name.nm_company = t_survey_response_hdr.id_company", 'left' );

		if( $id_login ){

			$this->db->where(array('NM_COMPANY LIKE' => '%' . $search . '%' ,'ID_CONSULTANT' => $id_login));
			
		}else{
			
			$this->db->where(array('NM_COMPANY LIKE' => '%' . $search . '%'));
			
		}

		$query = $this->db->get();

		return $query->result_array();
	}


	public function get_survey_by_id_login($id_login = '')
	{
		$this->db->select('t_company_info.id_company,t_survey_response_hdr.id_survey, t_survey_response_hdr.tx_status, nm_company, t_survey_response_hdr.consultant_id');
		
		$this->db->from($this->table_name);

		$this->db->join('t_survey_response_hdr', "$this->table_name.nm_company = t_survey_response_hdr.id_company", 'left' );

		$this->db->where(array('NM_COMPANY' => $id_login));

		$query = $this->db->get();

		return $query->result_array();
	}


	public function get_data_to_update_survey($nm_company = '',$id_company = '')
	{
		if(!empty($nm_company) && !empty($id_company))
		{
			//GET INFORMATION COMPANY
			$this->db->select('*');

			$this->db->from($this->table_name);

			$this->db->where("nm_company = '$nm_company'");

			$query = $this->db->get();

			$query = $query->result_array();

			$array['T_COMPANY'] = $query;

			// GET MATURITY
			 
			$this->db->select('INT_PT,DT_SURVEY_COMPLETE,TX_STATUS');

			$this->db->from('T_survey_response_hdr');

			$this->db->where(array('id_company' => $nm_company));

			$query= $this->db->get();

			$query = $query->result_array();

			$array['T_SURVEY_RESPONSE_HDR'] = $query;			

			//GET DROPDOWN
			
			$this->db->select('*');

			$this->db->from('T_dropdown');

			$this->db->where("T_dropdown.ID_DROPDOWN IN 
				(SELECT NM_INDUSTRY  FROM  T_company_info WHERE T_company_info.ID_COMPANY = $id_company ) 
				 OR T_dropdown.ID_DROPDOWN IN 
				 (SELECT NM_TYPE  FROM  T_company_info WHERE T_company_info.ID_COMPANY = $id_company ) 
				 OR T_dropdown.ID_DROPDOWN IN 
				 (SELECT N_REVENUE  FROM  T_company_info WHERE T_company_info.ID_COMPANY = $id_company )
				  OR T_dropdown.ID_DROPDOWN IN 
				 (SELECT N_STAFF_SIZE  FROM  T_company_info WHERE T_company_info.ID_COMPANY = $id_company )
				 OR T_dropdown.ID_DROPDOWN IN 
				 (SELECT N_HR_SIZE  FROM  T_company_info WHERE T_company_info.ID_COMPANY = $id_company )
				 ");

			$query= $this->db->get();

			$query = $query->result_array();

			$array['T_DROPDOWN'] = $query;

			return $array;


		}
		else
		{
			return null;
		}
	}
}
