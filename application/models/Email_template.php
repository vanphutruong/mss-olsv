<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*T_User
*Description: model manage user
*@author quanhm
*/

Class Email_template extends MY_Model{

	function __construct() {

		parent::__construct();

		$this->table_name = 'email_template';
	}

	public function ($value = null) {
		# code...
	}

	/**
	 * [get_data_by_id description]
	 * @param  string $select [description]
	 * @param  [int] $id     [id mail template]
	 * @return [array]         [one record email_template]
	 */
	public function get_data_by_id($select = '*', $id = null) {

		//validate data
		if(!is_null($id) && is_numeric($id)) {

			$this->db->where("id_user = $id LIMIT 1");

		}
		else {

			return null;

		}

		//select data
		if(strcmp($select, '*') != 0) {

			$this->db->select($select);

		}
		else {

			$this->db->select();

		}

		//query db
		$query= $this->db->get($this->table_name);

		$query = $query->result_array();

		//return result
		return $query[0];

	}


	/**
	 * [get_data_by_property description]
	 * @param  [type] $select [description]
	 * @param  array  $where  [description]
	 * @return [type]         [description]
	 */
	public function get_data_by_property($select, $where = array()) {

		//validate data
		if(!is_null($where) && is_array($where)) {

			$this->db->where($where);

		}
		else {

			return null;

		}

		//select data
		if(strcmp($select, '*') != 0) {

			$this->db->select($select);

		}
		else {

			$this->db->select();

		}
		
		//query
		$query= $this->db->get($this->table_name);

		//return result
		return $query->result_array();

	}


	/**
	 * [set_data description]
	 * @param array   $data   [description]
	 * @param integer $result [description]
	 */
	public function set_data($data = array(), $result = 0) {

		if(is_null($data) || !is_array($data)) {

			return null;

		}
		
		//insert data
		$this->db->insert($this->table_name, $data);

		//get last id
		$id_user = $this->db->insert_id();

		//return result
		if($result == 0) {

			return $id_user;

		}
		else {

			$user = $this->get_data_by_id('*', $id_user);

			return $user;

		}

	}
	
	/**
	 * [update_data_by_id description]
	 * @param  array  $data [description]
	 * @param  [type] $id   [description]
	 * @return [type]       [description]
	 */
	public function update_data_by_id($data = array(), $id) {

		//validate data
		if(is_null($data) || !is_array($data)) {

			return null;

		}

		//get data by id
		$this->db->where('ID_USER', $id );

		//update
		$this->db->update($this->table_name, $data);
		
		//return result
		if($this->db->affected_rows() > 0) {

			return true;

		}
		else {

			return false;

		}

	}


	/**
	 * [update_data_by_property description]
	 * @param  array  $data  [description]
	 * @param  array  $where [description]
	 * @return [type]        [description]
	 */
	public function update_data_by_property ($data = array(), $where = array()) {

		//validate data
		if(is_null($data) || !is_array($data)) {

			return null;

		}

		if(is_null($where) || !is_array($where)) {

			return null;

		}

		//get data by condition where
		$this->db->where($where);

		//update data
		$this->db->update($this->table_name, $data);

		//return result
		if($this->db->affected_rows() > 0) {

			return true;

		}
		else {

			return false;

		}

	}
	
}
