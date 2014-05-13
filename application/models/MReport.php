<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*T_User
*Description: model manage t_survey_benchmark_dtl
*@author quanhm
*/

Class MReport extends MY_Model{

	function __construct() {

		parent::__construct();

	}
	
	function get_category() {

		$this->db->distinct();

		$this->db->select('NM_CATEGORY');

		$this->table_name = "T_survey_question";

		$query= $this->db->get($this->table_name);

		$query = $query->result_array();

		return $query;
		
	}

	public function get_point_blue($id_survey = 0) {

		$this->db->select('*');

		$this->table_name = "t_survey_response_dtl";
		
		$this->db->where("ID_SURVEY = $id_survey");

		$query= $this->db->get($this->table_name);

		$query = $query->result_array();

		if (count($query)) {

			return $query;

		}

		return null;
		
	}

	public function get_point_red($id_gs1 = 0) {

		if($id_gs1 == 0)
		{
			return null;
		}

		$id_gs1 += 1;

		$this->db->select('*');

		$this->table_name = "t_survey_benchmark_dtl INNER JOIN T_survey_option ON t_survey_benchmark_dtl.ID_ANSWER = T_survey_option.ID_ANSWER AND  t_survey_benchmark_dtl.ID_QUESTION = T_survey_option.ID_QUESTION";
		
		$this->db->where("t_survey_benchmark_dtl.ID_MATURITY = $id_gs1");

		$query= $this->db->get($this->table_name);

		$query = $query->result_array();

	
		if (count($query)) {

			return $query;

		}

		return null;	

	}

	function get_data_by_id($id_company = null, $id_survey = null) {

		if(is_null($id_company) || is_null($id_survey)) {

			return null;

		}
		else {

			// GET 34 ANSWER 
			// IMPORTAN 'IN_POINT'
			
			$this->db->select('*');

			$this->table_name = "t_survey_response_dtl INNER JOIN T_survey_option ON t_survey_response_dtl.ID_ANSWER = T_survey_option.ID_ANSWER ";
			
			$this->db->where("t_survey_response_dtl.ID_SURVEY = $id_survey");

			$query= $this->db->get($this->table_name);

			$query = $query->result_array();

			$array['DRAW_ANSWER'] = $query;


			
			// GET COMPANY_INFO
			 
			$this->db->select('*');

			$this->table_name = "T_company_info";
			
			$this->db->where("ID_COMPANY = $id_company");

			$query= $this->db->get($this->table_name);

			$query = $query->result_array();

			$array['COMPANY_INFO'] = $query;

			$id_gs1 = $query[0]['ID_GS1'];	

			// GET VALUE FOR INDUSTRY
			
			$this->db->select('*');

			$this->table_name = "T_dropdown";
			
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

			$query= $this->db->get($this->table_name);

			$query = $query->result_array();

			$array['T_DROPDOWN'] = $query;
			

			
			// GET 34 BENCHMARK 
			// IMPORTAN 'IN_POINT'			
			// DEPEND ON 'ID_MATURITY' ( TERMS JOIN )  T_COMPANY_INFO.'ID_GS1'

			
			$this->db->select('*');

			$this->table_name = "t_survey_benchmark_dtl INNER JOIN T_survey_option ON t_survey_benchmark_dtl.ID_ANSWER = T_survey_option.ID_ANSWER AND  t_survey_benchmark_dtl.ID_QUESTION = T_survey_option.ID_QUESTION";
			
			$this->db->where("t_survey_benchmark_dtl.ID_MATURITY = $id_gs1");

			$query= $this->db->get($this->table_name);

			$query = $query->result_array();

			$array['DRAW_BENCHMARK'] = $query;


			// GET TABLE T_SURVEY_RESPONSE_HDR
			
			
			$this->db->select('INT_PT');

			$this->table_name = "t_survey_response_hdr";

			$query= $this->db->get($this->table_name);

			$query = $query->result_array();

			$id_gs1 = (float) $query[0]['INT_PT'];		

			if($id_gs1 < 1.9) {	

				$level = 1;

				$this->db->select('SUM(INT_PT)');

				$this->table_name = "t_survey_response_hdr";
				
				$this->db->where("INT_PT < 2");

				$query= $this->db->get($this->table_name);

				$query = $query->result_array();

				$array['TOTAL_CURRENT'] = $query;

			}
			else if($id_gs1 < 2.9) {

				$level = 2;

				$this->db->select('SUM(INT_PT)');

				$this->table_name = "t_survey_response_hdr";
				
				$this->db->where("INT_PT < 3 AND INT_PT >= 2");

				$query= $this->db->get($this->table_name);

				$query = $query->result_array();

				$array['TOTAL_CURRENT'] = $query;

			}
			else if($id_gs1 < 3.9) {

				$level = 3;

				$this->db->select('SUM(INT_PT)');

				$this->table_name = "t_survey_response_hdr";
				
				$this->db->where("INT_PT < 4 AND INT_PT >= 3");

				$query= $this->db->get($this->table_name);

				$query = $query->result_array();

				$array['TOTAL_CURRENT'] = $query;

			}
			else {

				$level = 4;

				$this->db->select('SUM(INT_PT)');

				$this->table_name = "t_survey_response_hdr";
				
				$this->db->where("INT_PT >= 4");

				$query= $this->db->get($this->table_name);

				$query = $query->result_array();

				$array['TOTAL_CURRENT'] = $query;

			}

			$this->db->select('SUM(INT_PT) , DT_SURVEY_COMPLETE, DT_SURVEY_START ');

			$this->table_name = "t_survey_response_hdr";
			
			$query= $this->db->get($this->table_name);

			$query = $query->result_array();

			$array['TOTAL'] = $query;

			$array['HRMM_LEVEL'] = $level;

			// GET INT_CAT
			
			$this->db->select('INT_CAT1,INT_CAT2,INT_CAT3,INT_CAT4,INT_CAT5,INT_CAT6,INT_CAT7,INT_CAT8,INT_CAT9,INT_CAT10,INT_CAT11,INT_PT');

			$this->table_name = "t_survey_response_hdr";

			$this->db->where("ID_SURVEY = $id_survey");
			
			$query= $this->db->get($this->table_name);

			$query = $query->result_array();

			$array['POINT'] = $query;

			return $array;

		}
		
	}

}
