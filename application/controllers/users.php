<?php
/**
 * User controller.
 *
 */
class Users extends MY_Controller 
{

	function __construct() {

		/* 	Get parent construct method*/
		parent::__construct();

		/* 	Get parent configure method*/
		parent::__configure();

		$this->load->file("application/controllers/email.php", false); 

		$this->load->file("application/controllers/parse.php", false); 

		$this->load->file(APPPATH . 'models/form_validation/user_rules.php', false);

	}

	/**
	 * [index Check and redirect interface for user]
	 * @return [interface] [return interface follow with user role]
	 */
	public function index()
	{
		if($this->is_login()) {

			$this->redirect_login();

		}
		else{

			$segments = array($this->router->class, 'login');

			$this->redirect($segments);
			
		}

	}

	/**
	 * [check_login check data login]
	 * @return [type] [set session and redirect to view with user role]
	 * 
	 */
	public function check_login()
	{
		if(!$this->session->userdata(USER_SESSION_KEY)) {

			if($this->input->post()) {

				$this->load->library(array('form_validation'));

				$this->form_validation->set_rules(User_rules::get_login_rules());

				if ($this->form_validation->run() == TRUE) {

					$id_login = strtoupper(trim($this->input->post('ID_LOGIN')));

					$password = trim($this->input->post('EN_PASSWORD'));

					$this->load->model('T_user');

					$query_result = $this->T_user->get_data_by_property('*' , array("ID_LOGIN" => $id_login));

					if(count($query_result)) {

						$data = $query_result[0];

						if ($data['EN_PASSWORD'] == md5($password)) {

							if ($data['IN_ACTIVE'] == "0") {

								$this->session->set_userdata('title_mess_code', 'Warning message');

								$this->session->set_userdata('type_mess_code', WARNING_CLASS);

								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', "Your account does not active , Do you want<a href='".site_url('users/force_active_account')."'> active account </a>now ?");

								$this->session->set_userdata('ID_LOGIN', $id_login);

								$this->session->set_userdata('EN_PASSWORD', $password);

								$this->session->set_userdata('error_timeout', 30000);

								$segment = array($this->router->class, 'login');

								$this->redirect($segment);

							}
							else {

								$data['token']=$this->create_token();

								$this->save_session_login($data);

								$this->update_last_login($this->session->userdata[USER_SESSION_KEY]['ID_USER']);
								
								$segment = array($this->router->class, 'login');

								$this->session->set_userdata('ROLE', MY_Controller::get_user_role());

								$this->redirect($segment);

							}

						} 
						else if($data['TX_SECURITY_CODE'] == md5($password)) {
							
							$this->session->set_userdata('title_mess_code', 'Warning message');

							$this->session->set_userdata('type_mess_code', WARNING_CLASS);

							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));

							$this->session->set_userdata('TX_SECURITY_CODE', $password);

							$this->session->set_userdata('error_mess_code', "Your has request change your password. Do you want continue ? Please check your mailbox Or Click <a href='".site_url('users/force_change_password')."'> here </a> to change password");

							$this->session->set_userdata('EN_PASSWORD', $password);

							$segment = array($this->router->class, 'login');

							$this->redirect($segment);

						}
						else {

							$this->session->set_userdata('title_mess_code', 'Warning message');

							$this->session->set_userdata('type_mess_code', WARNING_CLASS);

							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Password does not match');

							$this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));

							$this->session->set_userdata('EN_PASSWORD', $password);

							$segment = array($this->router->class, 'login');

							$this->redirect($segment);

						}

					}
					else {

						$this->session->set_userdata('title_mess_code', 'Warning message');
						
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);

						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Username does not exits');

						$this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));

						$this->session->set_userdata('EN_PASSWORD', $password);

						$segment = array($this->router->class, 'login');

						$this->redirect($segment);

					}

				}
				else {

					$this->session->set_userdata('title_mess_code', 'Error message');

					$this->session->set_userdata('type_mess_code', ERROR_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', validation_errors());

					if ($this->input->post('ID_LOGIN')) {

						$temp=$this->input->post('ID_LOGIN');

						$this->session->set_userdata('ID_LOGIN', $temp);

					}

					if ($this->input->post('EN_PASSWORD')) {

						$temp=$this->input->post('EN_PASSWORD');

						$this->session->set_userdata('EN_PASSWORD', $temp);

					}

					$segments = array($this->router->class, 'login');

					$this->redirect($segments);

				}

			}
			else {

				$this->data['title'] = 'Error access !';

				$this->data['message'] = 'Page not found. You can not access this url !';

				$this->display_error($this->data);

			}

		}
		else {

			$this->redirect_login();

		}

	}

	/**
	 * [update_last_login description]
	 * @param  [type] $id [description]
	 * @return [type]  [description]
	 * Update DT_LAST_LOGIN for $id
	 */	
	
	public function update_last_login($id = null)
	{
		
		if(!empty($id)) {

			$this->load->model('T_user');

			$time = date("Y-m-d H:i:s");
			
			$this->T_user->update_data_by_property(array("DT_LAST_LOGIN" => $time) ,array("ID_USER" => $id) );

		}
		else {

			return false;

		}

	}

	/**
	 * [login description]
	 * @param  [type]  [description]
	 * @return [type]     [description]
	 */
	public function login($id_login = null) 
	{
		if($this->session->userdata(USER_SESSION_KEY)) {

			$this->redirect_login();

		}
		else {

			if(!empty($id_login)) {

				$this->session->set_userdata('ID_LOGIN', $id_login);

			}
			
			$this->set_page_title("LOGIN");

			$this->view('default', 'user/user_login_view', $this->data);

		}

	}
	

	


	/**
	 * [random_password description]
	 * @return string [description]
	 * format same : Abc1a5g - Lenght = 9
	 * with create active code 
	 */
	public function random_password()
	{
	   	mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.

	   	$charid = strtoupper(md5(uniqid(rand(), true)));

	   	$uuid = substr($charid, 0, 9);

	   	return $uuid;

	}

	public function logout()
	{
	   	if ($this->session->userdata(USER_SESSION_KEY)) {

	   		$this->session->sess_destroy();

	   		unset($this->session->userdata); 

	   		if (!$this->session->userdata(USER_SESSION_KEY)) {

	   			$this->session->set_userdata('title_mess_code', 'Warning message');

	   			$this->session->set_userdata('type_mess_code', WARNING_CLASS);

	   			$this->session->set_userdata('error_flag_code', 1);

	   			$this->session->set_userdata('error_mess_code', 'CAN\'T logout');
	        	
	   			$segment = array($this->router->class, 'login');

	   			$this->redirect($segment);

	   		}

	   		$segment = array($this->router->class, 'login');

	   		$this->redirect($segment);

	   	}
	   	else {

	   		$this->session->set_userdata('title_mess_code', 'Warning message');

	   		$this->session->set_userdata('type_mess_code', WARNING_CLASS);

	   		$this->session->set_userdata('error_flag_code', 1);

	   		$this->session->set_userdata('error_mess_code', 'Please Login');
        	
	   		$segment = array($this->router->class, 'login');

	   		$this->redirect($segment);

	   	}

	}

	/**
	  * [save_session_login description]
	  * @param  string $sessionArray [description]
	  * @return [type]               [description]
	  * save session
	  */
	public	function save_session_login ($session_array = null)
	{
	 	unset($session_array['EN_PASSWORD']);

	 	unset($session_array['TX_ACTIVE_CODE']);

	 	unset($session_array['TX_SECURITY_CODE']);		

	 	$this->session->set_userdata(USER_SESSION_KEY, $session_array);

	}


	/**
	 * [redirect_login description]
	 * @return [type] [description]
	 *  redirect to page from role
	 */
	public function redirect_login()
	{
		if($this->session->userdata(USER_SESSION_KEY)) {

			if($this->is_admin() || $this->is_consultant() || $this->is_user()) {

				$segment = array('home', 'index');

				$this->redirect($segment);

			}
			else {

				$this->session->sess_destroy();

				unset($this->session->userdata);

				$this->session->set_userdata('title_mess_code', 'Warning message');

				$this->session->set_userdata('type_mess_code', WARNING_CLASS);

				$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Unable to identify your account');

				$segment = array($this->router->class, 'login');

				$this->redirect($segment);

			}

		} 

	}

	/**
	 * [forgot_id description]
	 * @return [type] [description]
	 *  redirect to page forgot id
	 */
	public function forgot_id()
	{
		if($this->is_login()) {

			$segment = array($this->router->class, 'login');

			$this->redirect($segment);

		}
		else {

			$this->set_page_title("FORGOT ID");

			$this->view('default', 'user/user_forgot_id_view', $this->data);

		}

	}

	/**
	 * [forgot_id description]
	 * @return [type] [description]
	 *  redirect to page forgot password
	 */
	public function forgot_password()
	{

		if($this->is_login()) {

			$segment = array($this->router->class, 'login');

			$this->redirect($segment);

		}
		else {

			$this->set_page_title("FORGOT PASSWORD");

			$this->view('default', 'user/user_forgot_password_view', $this->data);

		}

	}

	/**
	 * [send_mail_contain_id description]
	 * @return [type] [description]
	 * Send email with id to usermail
	 */
	
	public function send_mail_contain_id()
	{
		if($this->is_login()) {

			$segment = array($this->router->class, 'login');

			$this->redirect($segment);

		}
		else {

			if($this->input->post()) {

				$this->load->library(array('form_validation'));

				$this->form_validation->set_rules(User_rules::get_email_rules());

				if ($this->form_validation->run() == TRUE) {

					$email = $this->input->post('TX_USEREMAIL');

					$this->load->model('T_user');

					$query_result=$this->T_user->get_data_by_property('*' , array("TX_USEREMAIL" => $email));
					
					if(count($query_result)) {

						$this->load->model('T_email_template');  
						
						$get_parse_email = new ParserCompany();

						$data = array("ID_LOGIN" => $query_result[0]['ID_LOGIN'] , "LINK_LOGIN" => site_url().'users/login/'.$query_result[0]['ID_LOGIN'] , "HOME_PAGE" => site_url() , "ALT_BODY" => ALT_BODY_FORGOT_PASSWORD);
						
						$get_parse_email->send_id($data);
						
						$parse_email = $get_parse_email->public_template['template'];

						$parse_subject = $get_parse_email->public_template['subject'];

						if (!empty($parse_email) && !empty($parse_subject)) {

							$sendemail = new Email();

							$arraymail = array('SUBJECT' => $parse_subject, 'TO' => $email , 'BODY' => $parse_email );

							$type = 'forgot_username';

							if($sendemail->send_mail($arraymail,null,$type)) {

								$this->session->set_userdata('title_mess_code', 'Success message');

								$this->session->set_userdata('type_mess_code', SUCCESS_CLASS);

								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', 'Your username has been sent to the your mailbox');

								$segment = array($this->router->class, 'login');

								$this->redirect($segment);

							}
							else {

								$this->session->set_userdata('title_mess_code', 'Warning message');

								$this->session->set_userdata('type_mess_code', WARNING_CLASS);

								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', 'Process to send email errors, please try again');

								$this->session->set_userdata('TX_USEREMAIL', $email);

								$segment = array($this->router->class, 'forgot_id');

								$this->redirect($segment);

							}

						}
						else {

							$this->session->set_userdata('title_mess_code', 'Warning message');

							$this->session->set_userdata('type_mess_code', WARNING_CLASS);

							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Process to send email errors, please try again');

							$this->session->set_userdata('TX_USEREMAIL', $email);

							$segment = array($this->router->class, 'forgot_id');

							$this->redirect($segment);

						}

					}
					else {

						$this->session->set_userdata('title_mess_code', 'Warning message');

						$this->session->set_userdata('type_mess_code', WARNING_CLASS);

						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Email Does Not Exits');

						$this->session->set_userdata('TX_USEREMAIL', $email);

						$segment = array($this->router->class, 'forgot_id');

						$this->redirect($segment);

					}

				}
				else {
					
					if($this->input->post('TX_USEREMAIL')) {

						$temp = $this->input->post('TX_USEREMAIL');

						$this->session->set_userdata('TX_USEREMAIL', $temp);

					}

					$this->session->set_userdata('title_mess_code', 'Error message');

					$this->session->set_userdata('type_mess_code', ERROR_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', validation_errors());

					$segments = array($this->router->class, 'forgot_id');

					$this->redirect($segments);

				}

			}
			else {

				$this->set_page_title("ERROR");
				
				$this->data['title'] = 'Error access !';

				$this->data['message'] = 'Page not found. You can not access this url !';

				$this->display_error($this->data);

			}

		}

	}


	/**
	 * [send_mail_contain_password description]
	 * @return [type] [description]
	 * Send email with password to usermail
	 */
	public function send_mail_contain_password()
	{
		if($this->is_login()) {

			$segment = array($this->router->class, 'login');

			$this->redirect($segment);

		}
		else {

			if($this->input->post()) {

				$this->load->library(array('form_validation'));

				$this->form_validation->set_rules(User_rules::get_email_rules_forgot_password());

				if ($this->form_validation->run() == TRUE) {

					$username = trim($this->input->post('TX_USEREMAIL'));

					$this->load->model('T_user');

					$query_result=$this->T_user->get_data_by_property('*' , array("TX_USEREMAIL" => $username));
					

					if (count($query_result) < 1) {

						$this->session->set_userdata('title_mess_code', 'Warning message');

						$this->session->set_userdata('type_mess_code', WARNING_CLASS);

						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Email Does Not Exits');

						$this->session->set_userdata('TX_USEREMAIL', $this->input->post('TX_USEREMAIL'));

						$segment = array($this->router->class, 'forgot_password');

						$this->redirect($segment);

						return;
					}


					$username = $query_result[0]['ID_LOGIN'];

					if(count($query_result)) {

						$this->load->model('T_email_template');
						
						$get_parse_email = new ParserCompany();

						$random_code=$this->random_password();

						$data = array("TX_SECURITY_CODE" => $random_code , "LINK_CHANGEPASSWORD" => site_url().'users/force_change_password/'.$username.'/'.$random_code , "TX_USERNAME" => $username , "HOME_PAGE" => site_url(), "ALT_BODY" => ALT_BODY_FORGOT_PASSWORD ,"LOGIN_PAGE" => site_url().'users/login' );
						
						$get_parse_email->send_password($data);

						$parse_email = $get_parse_email->public_template['template'];

						$parse_subject = $get_parse_email->public_template['subject'];

						if (!empty($parse_email) && !empty($parse_subject)) {

							$sendemail = new Email();

							$arraymail = array('SUBJECT' => $parse_subject,
												'TO' => $query_result[0]['TX_USEREMAIL'],
												'BODY' => $parse_email
												);

							$type = "forgot_password";

							if($sendemail->send_mail($arraymail,null,$type)) {
								
								if($this->T_user->update_data_by_property(array("TX_SECURITY_CODE" => md5($random_code) ) ,array("ID_LOGIN" => $username))) {
									
									$this->session->set_userdata('title_mess_code', 'Success message');

									$this->session->set_userdata('type_mess_code', SUCCESS_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'Please check your mailbox and follow the instructions');

									$this->session->set_userdata('ID_LOGIN', $username);

									$segment = array($this->router->class, 'login');

									$this->redirect($segment);

								}
								else {

									$this->session->set_userdata('title_mess_code', 'Warning message');

									$this->session->set_userdata('type_mess_code', WARNING_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'An error in the database, please try again after few minutes');

									$segment = array($this->router->class, 'login');

									$this->redirect($segment);

								}

							}
							else {

								$this->session->set_userdata('title_mess_code', 'Warning message');

								$this->session->set_userdata('type_mess_code', WARNING_CLASS);

								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', 'Process to send email errors, please try again');

								$this->session->set_userdata('TX_USEREMAIL', $this->input->post('TX_USEREMAIL'));

								$segment = array($this->router->class, 'forgot_password');

								$this->redirect($segment);

							}

						}
						else {

							$this->session->set_userdata('title_mess_code', 'Warning message');

							$this->session->set_userdata('type_mess_code', WARNING_CLASS);

							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Process to send email errors, please try again');

							$this->session->set_userdata('TX_USEREMAIL', $this->input->post('TX_USEREMAIL'));

							$segment = array($this->router->class, 'forgot_password');

							$this->redirect($segment);

						}

					}
					else {

						$this->session->set_userdata('title_mess_code', 'Warning message');

						$this->session->set_userdata('type_mess_code', WARNING_CLASS);

						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Email Does Not Exits');

						$this->session->set_userdata('ID_LOGIN', $this->input->post('ID_LOGIN'));

						$segment = array($this->router->class, 'forgot_password');

						$this->redirect($segment);

					}

				}
				else {

					if($this->input->post('TX_USEREMAIL')) {

						$temp = $this->input->post('TX_USEREMAIL');

						$this->session->set_userdata('TX_USEREMAIL', $temp);
					}

					$this->session->set_userdata('title_mess_code', 'Error message');

					$this->session->set_userdata('type_mess_code', ERROR_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', validation_errors());

					$segments = array($this->router->class, 'forgot_password');

					$this->redirect($segments);

				}

			}
			else {

				$this->set_page_title("ERROR");

				$this->data['title'] = 'Error access !';

				$this->data['message'] = 'Page not found. You can not access this url !';

				$this->display_error($this->data);

			}

		}

	}

	/**
	 * [force_change_password description]
	 * @return [type] [description]
	 * view change  password
	 */
	
	public function force_change_password($id_login = null , $active_code = null)
	{
		if($this->is_login()) {

			$segment = array($this->router->class, 'login');

			$this->redirect($segment);

		}
		else {

			if(!empty($active_code) && strlen($active_code) == 9 && !empty($id_login)) {

				$this->load->model('T_user');

				$query_result=$this->T_user->get_data_by_property('*' , array("ID_LOGIN" => $id_login));

				if(count($query_result)) {

					$data = $query_result[0];

					$id_login= strtoupper(trim($id_login));

					if($data['ID_LOGIN'] == $id_login && $data['TX_SECURITY_CODE'] == md5($active_code)) {

						$this->session->set_userdata('ID_LOGIN', $id_login);

						$this->session->set_userdata('TX_SECURITY_CODE', $active_code);

						$this->view('default', 'user/user_change_password_view', $this->data);

					}
					else {

						$this->data['title'] = 'Error access !';

						$this->data['message'] = 'Page not found. Please check the link again !';

						$this->display_error($this->data);

					}

				}
				else {

					$this->data['title'] = 'Error access !';

					$this->data['message'] = 'Page not found. You can not access this url !';

					$this->display_error($this->data);

				}

			}
			else if( isset($this->session->userdata['TX_SECURITY_CODE']) && isset($this->session->userdata['ID_LOGIN'])   &&  !empty($this->session->userdata['TX_SECURITY_CODE']) && !empty($this->session->userdata['ID_LOGIN'])) {

				$active_code = $this->session->userdata['TX_SECURITY_CODE'];

				$id_login = $this->session->userdata['ID_LOGIN'];		

				$this->load->model('T_user');

				$query_result = $this->T_user->get_data_by_property('*' , array("ID_LOGIN" => $id_login));

				if(count($query_result)) {

					$data = $query_result[0];

					if($data['ID_LOGIN'] == $id_login && $data['TX_SECURITY_CODE'] == md5($active_code)) {

						$this->session->set_userdata('ID_LOGIN', $id_login);

						$this->session->set_userdata('TX_SECURITY_CODE', $active_code);

						$this->view('default', 'user/user_change_password_view', $this->data);

					}
					else {

						$this->data['title'] = 'Error access !';

						$this->data['message'] = 'Page not found. Please check the link again !';

						$this->display_error($this->data);

					}

				}
				else {

					$this->data['title'] = 'Error access !';

					$this->data['message'] = 'Page not found. You can not access this url !';

					$this->display_error($this->data);

				}

			}
			else {

				$this->data['title'] = 'Error access !';

				$this->data['message'] = 'Page not found. You can not access this url !';

				$this->display_error($this->data);

			}

		}

	}

	/**
	 * [change_password description]
	 * @return [type] [description]
	 * CONTINUE.... 29/03/2014 19:16
	 * NEXT BEGIN : 21:00 current day
	 */
		
	public function change_password()
	{
		if($this->input->post()) {

			if($this->input->post('ID_LOGIN') && $this->input->post('TX_SECURITY_CODE')) {

				$username = strtoupper(trim($this->input->post('ID_LOGIN')));

				$security_code = $this->input->post('TX_SECURITY_CODE');

				$this->load->library(array('form_validation'));

				$this->form_validation->set_rules(User_rules::get_change_password_rules());

				if ($this->form_validation->run() == TRUE) {

					$id_login = $this->input->post('ID_LOGIN');

					$security_code = $this->input->post('TX_SECURITY_CODE');

					$new_password = $this->input->post('NEW_PASSWORD');

					$cofirm_password =  $this->input->post('CONFIRM_NEW_PASSWORD');

					if ($new_password == $cofirm_password) {

						$this->load->model('T_user');

						$query_result = $this->T_user->get_data_by_property('*' , array("ID_LOGIN" => $id_login));

						if (count($query_result)) {

							$data = $query_result[0];

							if ( $data['TX_SECURITY_CODE'] == md5($security_code)) {

								$this->load->model('T_user');

								$new_security_password = $this->random_password();

								if($this->T_user->update_data_by_property(array("EN_PASSWORD" => md5($new_password) , "TX_SECURITY_CODE" => md5($new_security_password)) , array("ID_LOGIN" => $id_login))) {

									$this->session->set_userdata('title_mess_code', 'Success message');

									$this->session->set_userdata('type_mess_code', SUCCESS_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'Change password success , please login');

									$this->session->set_userdata('ID_LOGIN', $id_login);

									$this->session->set_userdata('EN_PASSWORD', $new_password);

									$segment = array($this->router->class, 'login');

									$this->redirect($segment);

								}
								else {

									$this->session->set_userdata('ID_LOGIN', $username);

									$this->session->set_userdata('TX_SECURITY_CODE', $security_code);

									$this->session->set_userdata('title_mess_code', 'Warning message');

									$this->session->set_userdata('type_mess_code', WARNING_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'Change Password failed, please retry');

									$segment = array($this->router->class, 'force_change_password/'.$username.'/'.$security_code);

									$this->redirect($segment);

								}

							} 
							else {

								$this->session->set_userdata('title_mess_code', 'Warning message');

								$this->session->set_userdata('type_mess_code', WARNING_CLASS);

								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', 'The security code does not match');

								$this->session->set_userdata('ID_LOGIN', $username);

								$this->session->set_userdata('TX_SECURITY_CODE', $security_code);	

								$segment = array($this->router->class, 'force_change_password/'.$username.'/'.$security_code);

								$this->redirect($segment);

							}

						}
						else {

							$this->session->set_userdata('title_mess_code', 'Warning message');

							$this->session->set_userdata('type_mess_code', WARNING_CLASS);

							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Username does not exits');

							$this->session->set_userdata('ID_LOGIN', $username);

							$this->session->set_userdata('TX_SECURITY_CODE', $security_code);

							$segment = array($this->router->class, 'force_change_password/'.$username.'/'.$security_code);

							$this->redirect($segment);

						}

					} 
					else {

						$this->session->set_userdata('title_mess_code', 'Warning message');

						$this->session->set_userdata('type_mess_code', WARNING_CLASS);

						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('ID_LOGIN', $username);

						$this->session->set_userdata('TX_SECURITY_CODE', $security_code);

						$this->session->set_userdata('error_mess_code', 'Cofirm password does not match !');

						$segment = array($this->router->class, 'force_change_password/'.$username.'/'.$security_code);

						$this->redirect($segment);

					}
					
				}
				else {
					
					$this->session->set_userdata('title_mess_code', 'Warning message');

					$this->session->set_userdata('type_mess_code', WARNING_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('ID_LOGIN', $username);
					
					$this->session->set_userdata('TX_SECURITY_CODE', $security_code);

					$this->session->set_userdata('error_mess_code', validation_errors());

					$segment = array($this->router->class, 'force_change_password/'.$username.'/'.$security_code);

					$this->redirect($segment);
					
				}

			}
			else {

				$this->data['title'] = 'Error access !';

				$this->data['message'] = 'Data not valid. You can not access this url !';

				$this->display_error($this->data);

			}

		}
		else {

			$this->data['title'] = 'Error access !';

			$this->data['message'] = 'Page not found. You can not access this url !';

			$this->display_error($this->data);

		}

	}

}
