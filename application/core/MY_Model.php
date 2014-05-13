<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Generic model for entity class, CI AR.
 * @author PhuTv
 *
 */
class MY_Model extends CI_Model {
	var $table_name;

	function __construct() {

		parent::__construct();

	}

	/**
	 * Get max value by field name (eg: integer field).
	 * @param unknown $field
	 */
	function get_max_id($field) {
		$r = $this->db->select('max('.$field.') as '.$field)->from($this->table_name)->get()->row();
		return $r->$field;
	}
	
}