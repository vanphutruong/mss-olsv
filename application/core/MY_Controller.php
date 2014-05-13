<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Generic and override CI controller class. Please add common functions here.
 * @author PhuTv
 *
*/
class MY_Controller extends CI_Controller {


	var $page_title;

	var $data;

	var $manager_role;

	var $admin_role;

	public function __construct() {

		parent::__construct();

		$this->data = array();

		$this->manager_role = array( ADMIN_ROLE , CONSULTANT_ROLE);

		$this->admin_role = ADMIN_ROLE;

		include_once("application/core/MY_Output.php"); 

		$this->output->nocache();

	}

	/**
	 * [__configure description]
	 * @return [type] [description]
	 */
	protected function __configure()
	{
		// Write total config here
	}

	/**
	 * [__unset unset session or other things]
	 */
	protected function _unset()
	{
		if ($this->router->method != 'create') {
			
			$this->session->unset_userdata('data_step_1');

			$this->session->unset_userdata('data_step_2');

			$this->session->unset_userdata('data_step_3');

		}

		if($this->router->method != 'edit'){

			$this->session->unset_userdata('edit_step_1');

			$this->session->unset_userdata('edit_step_2');

			$this->session->unset_userdata('edit_step_3');

			$this->session->unset_userdata('id_company');

			$this->session->unset_userdata('is_admin');

			$this->session->unset_userdata('nm_company');
		}

		if ($this->router->method != 'take_survey') {
			
			$this->session->unset_userdata('take_survey');

			$this->session->unset_userdata('time_take_survey');

			$this->session->unset_userdata('time_flag');

			$this->session->unset_userdata('survey_data_answer');

			$this->session->unset_userdata('id_company');

		}


		if ($this->router->method != 'update_survey') {
			
			$this->session->unset_userdata('update_survey');

			$this->session->unset_userdata('time_take_survey_update');

			$this->session->unset_userdata('time_flag_update');

			$this->session->unset_userdata('survey_data_update');

		}
	}

	public function set_page_title($title='')
	{
		if(!empty($title))
		{

			$this->page_title = $title.PREFIX_SUB_PAGE.SUB_PAGE;

		}
		else
		{
			$title = "HOME PAGE";

			$this->page_title = $title.PREFIX_SUB_PAGE.SUB_PAGE;
		}
	}
	
	/**
	 * [view description]
	 * @param  string $template    [dir of template]
	 * @param  [type] $dir         [dir of view]
	 * @param  [type] $layout_data [data parse]
	 * @return [interface]              [interface]
	 */
	protected function view($template = 'default', $dir, $layout_data) {
	

		if (strlen($dir) > 0) {

			$dir_explode = explode('/', $dir);

			if (count($dir_explode) > 1) {
				$dir = null;

				for ($i = 0; $i < count($dir_explode); $i++) {
					
					if ($i == (count($dir_explode) - 2)) {

						$dir .= $dir_explode[$i];
						
						break;

					}
					else{

						$dir .= $dir_explode[$i].'/';

					}

				}

				$content = $this->load->view($dir.'/'.$dir_explode[count($dir_explode) - 1], $this->data, true);

				$content_css = $this->load->view($dir.'/'.$dir_explode[count($dir_explode) - 1].'_css', $this->data, true);

				$content_js = $this->load->view($dir.'/'.$dir_explode[count($dir_explode) - 1].'_js', $this->data, true);
			}
			else{

				$content = $this->load->view($dir, $this->data, true);

				if (file_exists($dir.'_css'.'.php')) {

					$content_css = $this->load->view($dir.'_css', $this->data, true);

				}
				else{

					$content_css = '';

				}

				if (file_exists($dir.'_js'.'.php')) {

					$content_js = $this->load->view($dir.'_js', $this->data, true);

				}
				else{

					$content_js = '';

				}

			}

			$layout_data['template_name'] = $template;

			$layout_data['content'] = $content;

			$layout_data['content_css'] = $content_css;

			$layout_data['content_js'] = $content_js;

			$this->load->view("template/$template/main", $layout_data);

		}
		else{

        	$this->session->set_userdata('title_mess_code', 'Warning message');

			$this->session->set_userdata('type_mess_code', WARNING_CLASS);

        	$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', "Cant not load file $dir");
		}
	}

	/**
	 * [redirect description]
	 * @param  [array] $segments [config controller name, method, param]
	 * @return [interface]           [interface follow url parse from $segments]
	 */
	protected function redirect($segments = null)
	{
		$url = site_url();

		if (!empty($segments) && (count($segments) > 0)) {

			foreach ($segments as $key => $value) {

				$url .= '/'.$value;

			}

		}

		redirect($url);

	}
	
	/**
	 * [is_login description]
	 * @return boolean [check user login]
	 */
	public function is_login()
	{
		return $this->session->userdata(USER_SESSION_KEY);
	}

	/**
	 * [require_login description]
	 * @return [type] [Required user login before access a method]
	 */
	public function require_login()
	{

		$this->session->set_userdata('title_mess_code', 'Warning message');

		$this->session->set_userdata('type_mess_code', WARNING_CLASS);

    	$this->session->set_userdata('error_flag_code', 1);

		$this->session->set_userdata('error_mess_code', 'Please login !');

        $segments = array('users', 'login');

		$this->redirect($segments);

	}


	
	/**
	 * [display_error description]
	 * @param  array  $data [array data setting]
	 * @return [interface]       [error page notify]
	 */
	public function display_error($data = array())
	{
		$this->view('default', 'error/error_page_view', $data);
	}

	/**
	 * [url_not_found description]
	 * @param  array  $data [data set or using parse]
	 * @return [type]       [load view error url]
	 */
	public function url_not_found($data = array())
	{
		$this->view('default', 'error/error_url_view', $data);
	}
	
	public function get_user_role()
	{

		$this->load->model('T_user');

		$user = $this->session->userdata(USER_SESSION_KEY);

		$user_property = $this->T_user->get_data_by_id('*', $user['ID_USER']);

		if ($user_property['IN_ADMIN'] == 1) {

			return ADMIN_ROLE;

		} elseif ($user_property['IN_CONSULTANT']) {

			return CONSULTANT_ROLE;

		} elseif ($user_property['IN_USER']) {

			return USER_ROLE;

		}
		else {

			return null;

		}
		
	}

	/**
	 * [is_manage check user is manage account]
	 * @return boolean [true|false]
	 * @author PhuTv
	 */
	public function is_manage()
	{

		if ($this->is_login()) {

			$user = $this->session->userdata(USER_SESSION_KEY);

			$role_manage = array(IN_ADMIN, IN_CONSULTANT);

			$this->load->model('T_user');

			$user_property = $this->T_user->get_data_by_id('*', $user['ID_USER']);

			if (in_array($user_property['IN_ADMIN'], $role_manage) || in_array($user_property['IN_CONSULTANT'], $role_manage)) {

				return true;

			}
			else{

				return false;

			}

		}

	}

	/**
	 * [is_admin check user is admin account]
	 * @return boolean [true|false]
	 * @author PhuTv
	 */
	public function is_admin()
	{

		if ($this->is_login()) {

			$user = $this->session->userdata(USER_SESSION_KEY);

			$this->load->model('T_user');

			$user_property = $this->T_user->get_data_by_id('*', $user['ID_USER']);

			if ($user_property['IN_ADMIN'] == IN_ADMIN) {

				return true;

			}
			else{

				return false;

			}

		}

	}

	/**
	 * [is_consultant check user is consultant account]
	 * @return boolean [true|false]
	 * @author PhuTv
	 */
	public function is_consultant()
	{

		if ($this->is_login()) {
			$user = $this->session->userdata(USER_SESSION_KEY);

			$this->load->model('T_user');

			$user_property = $this->T_user->get_data_by_id('*', $user['ID_USER']);

			if ($user_property['IN_CONSULTANT'] == IN_CONSULTANT) {

				return true;

			}
			else{

				return false;
				
			}

		}

	}

	/**
	 * [is_user check user mormal]
	 * @return boolean [true|false]
	 * @author PhuTv
	 */
	public function is_user()
	{

		if ($this->is_login()) {
			
			$user = $this->session->userdata(USER_SESSION_KEY);

			$this->load->model('T_user');

			$user_property = $this->T_user->get_data_by_id('*', $user['ID_USER']);

			if ($user_property['IN_USER'] == IN_USER) {

				return true;

			}
			else{

				return false;
				
			}

		}

	}

	/**
	 * [create_token description]
	 * @return string [description]
	 * format same : {16B0815F-589B-4F28-7A29-0B5A53DBD402}
	 */
	public function create_token()	
	{
	   	mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.

	   	$charid = strtoupper(md5(uniqid(rand(), true)));

	   	$hyphen = chr(45); // "-"

	   	$uuid = substr($charid, 0, 8)

	   	.substr($charid, 8, 4)

	   	.substr($charid, 12, 4)

	   	.substr($charid, 16, 4)

	   	.substr($charid, 20, 12);

	    return $uuid;
	    // return example : {16B0815F-589B-4F28-7A29-0B5A53DBD402}
	}
}