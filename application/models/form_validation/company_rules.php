<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Class Rules for Company Model
*/
class Company_rules
{
	function __construct()
	{
		# code...
	}

	/**
	 * [get_name_company_rules description]
	 * @return [array] [settings rules for register]
	 */
	public function get_company_rules_step_1()
	{
		$rules['register_rule'] = array(
			array(
					'field' => 'nm_company',
					'label' => 'Company ID',
					'rules' => 'trim|required|min_length[1]|alpha_numeric|max_length[50]|is_unique[t_company_info.nm_company]'
			),
			array(
					'field' => 'nm_respondent',
					'label' => 'Respondent Name',
					'rules' => 'trim|required|max_length[255]'
			),
			array(
					'field' => 'nm_designation',
					'label' => 'Designation',
					'rules' => 'trim|required|max_length[255]'
			),
			array(
					'field' => 'id_family_owned',
					'label' => 'Family Owned',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'n_revenue',
					'label' => 'Revenue Size',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'n_staff_size',
					'label' => 'Total staff size',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'n_hr_size',
					'label' => 'HR staff size',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'nm_industry',
					'label' => 'Company industry',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'nm_type',
					'label' => 'Company type',
					'rules' => 'trim|required'
			)

		);

		return $rules['register_rule'];
	}

	/**
	 * [get_name_company_rules description]
	 * @return [array] [settings rules for register]
	 */
	public function get_company_rules_step_2()
	{
		$rules['register_rule'] = array(
			array(
					'field' => 'step',
					'label' => 'Step',
					'rules' => 'trim|required|numeric'
			),
			array(
					'field' => 'ID_GS1',
					'label' => 'Answer',
					'rules' => 'trim|required|numeric'
			)

		);

		return $rules['register_rule'];
	}

	/**
	 * [get_name_company_rules description]
	 * @return [array] [settings rules for register]
	 */
	public function get_company_rules_step_3()
	{
			$rules['register_rule'] = array(
			array(
					'field' => 'step',
					'label' => 'Step',
					'rules' => 'trim|required|numeric'
			),
			array(
					'field' => 'ID_GS2',
					'label' => 'Answer',
					'rules' => 'trim|required|numeric'
			)

		);

		return $rules['register_rule'];
	}

	/**
	 * [get_name_company_rules description]
	 * @return [array] [settings rules for register]
	 */
	public function get_edit_company_rules_step_1()
	{
		$rules['register_rule'] = array(
			array(
					'field' => 'nm_company',
					'label' => 'Company Name',
					'rules' => 'trim|required|alpha_numeric|max_length[255]'
			),
			array(
					'field' => 'nm_respondent',
					'label' => 'Respondent Name',
					'rules' => 'trim|required|max_length[255]'
			),
			array(
					'field' => 'nm_designation',
					'label' => 'Designation',
					'rules' => 'trim|required|max_length[255]'
			),
			array(
					'field' => 'id_family_owned',
					'label' => 'Family Owned',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'n_revenue',
					'label' => 'Revenue Size',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'n_staff_size',
					'label' => 'Total staff size',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'n_hr_size',
					'label' => 'HR staff size',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'nm_industry',
					'label' => 'Company industry',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'nm_type',
					'label' => 'Company type',
					'rules' => 'trim|required'
			)

		);

		return $rules['register_rule'];
	}

	/**
	 * [get_name_company_rules description]
	 * @return [array] [settings rules for register]
	 */
	public function get_edit_company_rules_step_2()
	{
		$rules['register_rule'] = array(
			array(
					'field' => 'step',
					'label' => 'Step',
					'rules' => 'trim|required|numeric'
			),
			array(
					'field' => 'ID_GS1',
					'label' => 'Answer',
					'rules' => 'trim|required|numeric'
			)

		);

		return $rules['register_rule'];
	}



	/**
	 * [get_name_company_rules description]
	 * @return [array] [settings rules for register]
	 */
	public function get_edit_company_rules_step_3()
	{
		$rules['register_rule'] = array(
			array(
					'field' => 'step',
					'label' => 'Step',
					'rules' => 'trim|required|numeric'
			),
			array(
					'field' => 'ID_GS2',
					'label' => 'Answer',
					'rules' => 'trim|required|numeric'
			)

		);

		return $rules['register_rule'];
	}
}
