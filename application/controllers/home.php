<?php
/**
 * Home controller.
 * @author PhuTv
 *
 */
class Home extends MY_Controller {

	function __construct() {

		parent::__construct();

		parent::__configure();
		
	}

	/**
	 * [index description]
	 * @return [interface] [Home page]
	 */
	public function index()
	{

		if (MY_Controller::is_login()) {

			$this->view('default', 'home/home_page_view', $this->data);

		}
		else {

			$this->session->set_userdata('title_mess_code', 'Warning message');
									
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			            
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Access is deny. Please login !');	

			$segment = array('users', 'login');

			$this->redirect($segment);

		}

	}
	
}