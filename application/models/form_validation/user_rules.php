<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Class Rules for User Model
*/
class User_rules
{
	function __construct()
	{
		# code...
	}

	/**
	 * [get_create_account_rules description]
	 * @return [array] [settings rules for register]
	 */
	public function get_register_rules()
	{
		$rules['register_rule'] = array(
			array(
					'field' => 'ID_LOGIN',
					'label' => 'Username',
					'rules' => 'trim|required|alpha_numeric|min_length[6]|max_length[50]|is_unique[t_user.ID_LOGIN]'
			),
			array(
					'field' => 'EN_PASSWORD',
					'label' => 'Password',
					'rules' => 'trim|required|max_length[50]|xss_clean'
			),
			array(
					'field' => 'NM_ORGANISATION',
					'label' => 'Organisation name',
					'rules' => 'trim|required|max_length[255]'
			),
			array(
					'field' => 'NM_USER',
					'label' => 'Name',
					'rules' => 'trim|max_length[50]'
			),
			array(
					'field' => 'TX_USEREMAIL',
					'label' => 'Email Address',
					'rules' => 'trim|required|max_length[100]|valid_email|xss_clean|is_unique[t_user.TX_USEREMAIL]'
			)
		);

		return $rules['register_rule'];
	}


	public function get_change_password_rules()
	{
		$rules['change_password_rule'] = array(
			array(
					'field' => 'ID_LOGIN',
					'label' => 'Username',
					'rules' => 'trim|required|min_length[6]|max_length[50]'
			),
			array(
					'field' => 'TX_SECURITY_CODE',
					'label' => 'Security Code',
					'rules' => 'trim|required|min_length[9]|max_length[9]|xss_clean'
			),
			array(
					'field' => 'NEW_PASSWORD',
					'label' => 'New password',
					'rules' => 'trim|required|min_length[6]|max_length[50]|xss_clean'
			),
			array(
					'field' => 'CONFIRM_NEW_PASSWORD',
					'label' => 'Confirm new password',
					'rules' => 'trim|required|min_length[6]|max_length[50]|xss_clean'
			)
		);

		return $rules['change_password_rule'];
	}

	public function get_login_rules()
	{
		$rules['login_rule'] = array(
			array(
					'field' => 'ID_LOGIN',
					'label' => 'Username',
					'rules' => 'trim|required|alpha_numeric|min_length[6]|max_length[50]'
			),
			array(
					'field' => 'EN_PASSWORD',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[6]|max_length[50]|xss_clean'
			)
		);

		return $rules['login_rule'];
	}

	public function get_id_login_rules()
	{
		$rules['id_login_rule'] = array(
			array(
					'field' => 'ID_LOGIN',
					'label' => 'Username',
					'rules' => 'trim|required|alpha_numeric|min_length[6]|max_length[50]'
			)
		);
		return $rules['id_login_rule'];
	}

	public function get_email_rules()
	{
		$rules['email_rule'] = array(
			array(
					'field' => 'TX_USEREMAIL',
					'label' => 'Email Address',
					'rules' => 'trim|required|max_length[100]|valid_email|xss_clean'
			)
		);
		return $rules['email_rule'];
	}

	public function get_email_rules_forgot_password()
	{
		$rules['email_rule'] = array(
			array(
					'field' => 'TX_USEREMAIL',
					'label' => 'Email Address',
					'rules' => 'trim|required|max_length[100]|valid_email|xss_clean'
			)
		);
		return $rules['email_rule'];
	}	

	public function get_active_code_rules()
	{
		$rules['active_code_rule'] = array(
			array(
					'field' => 'TX_ACTIVE_CODE',
					'label' => 'Active Code',
					'rules' => 'trim|required|min_length[9]|max_length[9]'
			)
		);
		return $rules['active_code_rule'];
	}

}
