<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Class Rules for User Model
*/
class Survey_rules
{
	function __construct()
	{
		# code...
	}

	/**
	 * [get_create_account_rules description]
	 * @return [array] [settings rules for register]
	 */
	public function get_survey_rules()
	{
		$rules['survey_rule'] = array(
			array(
					'field' => 'nm_category',
					'label' => 'Category',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'id_question',
					'label' => 'Id question',
					'rules' => 'trim|required|numeric'
			),
			array(
					'field' => 'id_answer',
					'label' => 'Id answer',
					'rules' => 'trim|numeric'
			),
			array(
					'field' => 'submit_id_survey',
					'label' => 'submit_id_survey',
					'rules' => 'trim|required|numeric'
			),
			array(
					'field' => 'submit',
					'label' => 'submit',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'nm_company',
					'label' => 'nm_company',
					'rules' => 'trim|required'
			)

		);

		return $rules['survey_rule'];
	}

	public function get_goto_rules()
	{
		
		$rules['survey_rule'] = array(

			array(
					'field' => 'no_question',
					'label' => 'Question Number',
					'rules' => 'required|is_natural_no_zero|less_than[35]'
			),
			array(
					'field' => 'submit',
					'label' => 'Button Search',
					'rules' => 'trim|required'
			)
			
		);

		return $rules['survey_rule'];
	}

}
