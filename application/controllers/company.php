<?php
/**
 * User controller.
 *
 */

class Company extends MY_Controller {

	function __construct() {

		parent::__construct();

		parent::__configure();

		parent::_unset();

		$this->load->model('T_company_info');

		$this->load->model("T_growth_stage");

		$this->load->model("T_dropdown");

		$this->load->model('T_survey_response_hdr');

		$this->load->helper('form');

		$this->load->library(array('form_validation'));

    	$this->load->file(APPPATH . 'models/form_validation/company_rules.php', false);


	}
	/**
	 * Display view.
	 */
	public function index()
	{
		if ($this->is_login()) {

			$this->view('default', 'company/manage_company_view', $this->data);

		}
		else {

			$this->require_login();

		}

	}

	public function load_view_question()
	{
		$query = $this->T_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_1'));

		// Check data
		if( $query ) {

			$this->data['question'] = $query;

		}
		else {

			$this->session->set_userdata('title_mess_code', 'Warning message');
					
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			            
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'The question not found');

			$segment = array($this->router->class, 'create',$this->data);

			$this->redirect($segment);
		}
		
		if (isset($this->session->userdata['STEP_2'])) {
			
			if(count($this->session->userdata['STEP_2']))
			{
				$data_sess_step_2 = $this->session->userdata('STEP_2');

				$this->data['ID_GS1'] = $data_sess_step_2['ID_GS1'];

			}				
		} 
		
		$this->view('default', 'company/company_create_view_step_2', $this->data);
	}

	public function processing_create()
	{
		if ($this->input->post()) {

			$data_post = $this->input->post();

			if (isset($data_post['step'])) {
				$current_step = $data_post['step'];
			} else {
				
				$this->session->set_userdata('title_mess_code', 'Error message');
	
				$this->session->set_userdata('type_mess_code', WARNING_CLASS);
		       	
		       	$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Deny Access ! Please Try Again');

				$segment = array($this->router->class, 'create');

				$this->redirect($segment);
			}
			


			if ($data_post['submit'] == 'NEXT') {

				if($current_step == 1) {

					$this->form_validation->set_rules(Company_rules::get_company_rules_step_1());

					
					if ($this->form_validation->run() == TRUE) {

						$this->session->set_userdata('STEP_1',$data_post);

						$this->load_view_question();
					} 
					else {
						

						$this->session->set_userdata('title_mess_code', 'Warning message');
									
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
						            
						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', validation_errors());

						unset($this->session->userdata['STEP_1']);

						if(!isset($this->session->userdata['STEP_1']))
						{

							$this->session->set_userdata('STEP_1',$this->input->post());

						}

						$segment = array($this->router->class, 'create',$this->data);

						$this->redirect($segment);
					}
					

					
				}
				else if ($current_step == 2) {

					$this->form_validation->set_rules(Company_rules::get_company_rules_step_2());

					if ($this->form_validation->run() == TRUE) {
						
						$this->session->set_userdata('STEP_2',$data_post);

						$query = $this->T_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_2'));

						// Check data
						if( $query ) {

							$this->data['question'] = $query;

						}

						if(isset($this->session->userdata['STEP_3']))
						{
							if($this->session->userdata['STEP_3'])
							{
								$data_sess_step_3 = $this->session->userdata('STEP_3');

								$this->data['ID_GS2'] = $data_sess_step_3['ID_GS2'];

							}
						}



						$this->view('default', 'company/company_create_view_step_3', $this->data);
					} 
					else {
						

						$this->session->set_userdata('title_mess_code', 'Warning message');
									
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
						            
						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', validation_errors());

						$this->load_view_question();
					}

				}
				else
				{
					$this->session->set_userdata('title_mess_code', 'Error message');
		
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			       	
			       	$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Deny Access ! Please Try Again');

					$segment = array($this->router->class, 'create');

					$this->redirect($segment);
				}



				
			} else if($data_post['submit'] == 'BACK') {

				if($current_step == 2) {

					$this->form_validation->set_rules(Company_rules::get_company_rules_step_2());

					if ($this->form_validation->run() == TRUE) {

							$this->session->set_userdata('STEP_2',$data_post);

							$this->create();
					}
					else
					{
						$this->create();
					}
				}
				else if($current_step == 3) {

					$this->form_validation->set_rules(Company_rules::get_company_rules_step_3());

					if ($this->form_validation->run() == TRUE) {

						$this->session->set_userdata('STEP_3',$data_post);

						$this->load_view_question();

							
					}
					else
					{
						$this->load_view_question();
					}

				}
				else
				{
					$this->session->set_userdata('title_mess_code', 'Error message');
		
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			       	
			       	$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Access Deny');

					$segment = array($this->router->class, 'create');

					$this->redirect($segment);
				}
				
			}
			else if ($data_post['submit'] == 'SAVE') {

				$this->form_validation->set_rules(Company_rules::get_company_rules_step_3());

					
				if ($this->form_validation->run() == TRUE) {

					$this->session->set_userdata('STEP_3',$this->input->post());
				}
				else
				{


					$this->session->set_userdata('title_mess_code', 'Error message');
		
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			       	
			       	$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', validation_errors());


					$query = $this->T_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_2'));

						// Check data
						if($query) {

							$this->data['question'] = $query;

						}

						if(isset($this->session->userdata['STEP_3']))
						{
							if($this->session->userdata['STEP_3'])
							{
								$data_sess_step_3 = $this->session->userdata['STEP_3'];

								$this->data['ID_GS2'] = $data_sess_step_3['ID_GS2'];

							}
						}


					$this->view('default', 'company/company_create_view_step_3', $this->data);

					return;
				}

				if (isset($this->session->userdata['STEP_1']) && isset($this->session->userdata['STEP_2']) && isset($this->session->userdata['STEP_3'])) {
					
					if (count($this->session->userdata['STEP_1']) && count($this->session->userdata['STEP_2']) && count($this->session->userdata['STEP_3'])) {
						
						$step_1 = $this->session->userdata['STEP_1'];

						$step_2 = $this->session->userdata['STEP_2'];

						$step_3 = $this->session->userdata['STEP_3'];

						$array_data_set = array(
							'NM_COMPANY' => $step_1['nm_company'], 
							'NM_RESPONDENT' => $step_1['nm_respondent'], 
							'NM_DESIGNATION' => $step_1['nm_designation'], 
							'ID_FAMILY_OWNED' => $step_1['id_family_owned'],
							'N_REVENUE' => $step_1['n_revenue'], 
							'N_STAFF_SIZE' => $step_1['n_staff_size'],
							'N_HR_SIZE' => $step_1['n_hr_size'], 
							'NM_INDUSTRY' => $step_1['nm_industry'],
							'NM_TYPE' => $step_1['nm_type'], 
							'TX_REMARKS' => ' ',
							'ID_CONSULTANT' => $this->session->userdata[USER_SESSION_KEY]['ID_LOGIN'], 
							'ID_CONSULTANT_ORG' => $this->session->userdata[USER_SESSION_KEY]['NM_ORGANISATION'],
							'ID_GS1' => $step_2['ID_GS1'], 
							'ID_GS2' => $step_3['ID_GS2']
						);	


						$id_insert = $this->T_company_info->set_data($array_data_set);

						// insert sucessful
						if($id_insert) {

							// init data for t_survey_response_hdr table
							
							$array = array('ID_COMPANY' => $step_1['nm_company'], 'CONSULTANT_ID' => $this->session->userdata[USER_SESSION_KEY]['ID_USER']);
							
							$query = $this->T_survey_response_hdr->set_data($array);

							unset($this->session->userdata['STEP_1']);

							unset($this->session->userdata['STEP_2']);

							unset($this->session->userdata['STEP_3']);

							$this->session->set_userdata('title_mess_code', 'Success message');
									
							$this->session->set_userdata('type_mess_code', SUCCESS_CLASS);
							            
							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Create Company Success');

							$segment = array($this->router->class, 'index');

							$this->redirect($segment);

						}
						else {
							
							$this->session->set_userdata('title_mess_code', 'Warning message');
									
							$this->session->set_userdata('type_mess_code', WARNING_CLASS);
							            
							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Create Company Fail ! Try Again');

							$segment = array($this->router->class, 'create');

							$this->redirect($segment);

						}

					}
					else
					{
						
						$this->session->set_userdata('title_mess_code', 'Error message');
				
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
				       	
				       	$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Data Empty');

						$segment = array($this->router->class, 'create');

						$this->redirect($segment);
					}
					  
					
				} 
				else {
					
						$this->session->set_userdata('title_mess_code', 'Error message');
				
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
				       	
				       	$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Data Empty');

						$segment = array($this->router->class, 'create');

						$this->redirect($segment);
				}

			}
			else
			{

				$this->session->set_userdata('title_mess_code', 'Error message');
		
				$this->session->set_userdata('type_mess_code', WARNING_CLASS);
		       	
		       	$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Wrong method access');

				$segment = array($this->router->class, 'create');

				$this->redirect($segment);
			}
			
		}
		else {

			$this->session->set_userdata('title_mess_code', 'Error message');
		
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
	       	
	       	$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Wrong method access 123');

			$segment = array($this->router->class, 'create');

			$this->redirect($segment);

		}
	}


	public function create(){

		if(!$this->is_login()){

			$this->require_login();
		}

		if(!$this->is_manage()){
			
			$this->session->set_userdata('title_mess_code', 'Warning message');
									
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			            
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Access is deny. You have not permission to access !');

			$segment = array('home', 'index');

			$this->redirect($segment);

		}

		//dropdown revenue
		
		$revenue_list = $this->T_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Revenue'));
		
		if(count($revenue_list) > 0){

			$this->data['revenue_list'] = $revenue_list;

		}

		//dropdown TOTAL STAFF SIZE
		
		$total_staff_list = $this->T_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Total_Staff'));
		
		if(count($total_staff_list) > 0){

			$this->data['total_staff_list'] = $total_staff_list;

		}

		//dropdown HR STAFF SIZE
		
		$hr_staff_list = $this->T_dropdown->get_data_by_property('*', array('NM_TYPE' => 'HR_Staff'));

		if(count($hr_staff_list) > 0){

			$this->data['hr_staff_list'] = $hr_staff_list;

		}


		//dropdown Company_Industry
		
		$company_industry_list = $this->T_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Company_Industry'));

		if(count($company_industry_list) > 0){

			$this->data['company_industry_list'] = $company_industry_list;

		}


		//dropdown Company_Type
		
		$company_type_list = $this->T_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Company_Type'));

		if(count($company_type_list) > 0){

			$this->data['company_type_list'] = $company_type_list;

		}

		if ($this->session->userdata('STEP_1')) {

			$data_sess_step_1 = $this->session->userdata('STEP_1');

			if (count($data_sess_step_1) > 0) {

				foreach ($data_sess_step_1 as $key => $data) {

					$this->data[$key] = $data;

				}

			}

		}
		else {

			$this->data['key_page'] = $this->create_token();

		}


		$this->view('default', 'company/company_create_view_step_1', $this->data);

	}

	public function edit_page_1()
	{
		

		if(!$this->is_login()){

			$this->require_login();
		}

		if(!$this->is_manage()){
			
			$this->session->set_userdata('title_mess_code', 'Warning message');
									
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			            
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Access is deny. You have not permission to access !');

			$segment = array('home', 'index');

			$this->redirect($segment);

		}

		//dropdown revenue
		
		$revenue_list = $this->T_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Revenue'));
		
		if(count($revenue_list) > 0){

			$this->data['revenue_list'] = $revenue_list;

		}

		//dropdown TOTAL STAFF SIZE
		
		$total_staff_list = $this->T_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Total_Staff'));
		
		if(count($total_staff_list) > 0){

			$this->data['total_staff_list'] = $total_staff_list;

		}

		//dropdown HR STAFF SIZE
		
		$hr_staff_list = $this->T_dropdown->get_data_by_property('*', array('NM_TYPE' => 'HR_Staff'));

		if(count($hr_staff_list) > 0){

			$this->data['hr_staff_list'] = $hr_staff_list;

		}


		//dropdown Company_Industry
		
		$company_industry_list = $this->T_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Company_Industry'));

		if(count($company_industry_list) > 0){

			$this->data['company_industry_list'] = $company_industry_list;

		}


		//dropdown Company_Type
		
		$company_type_list = $this->T_dropdown->get_data_by_property('*', array('NM_TYPE' => 'Company_Type'));

		if(count($company_type_list) > 0){

			$this->data['company_type_list'] = $company_type_list;

		}

		if ($this->session->userdata('STEP_1')) {

			$data_sess_step_1 = $this->session->userdata('STEP_1');

			if (count($data_sess_step_1) > 0) {

				foreach ($data_sess_step_1 as $key => $data) {

					$this->data[$key] = $data;

				}

			}

		}

		$this->view('default', 'company/company_edit_view_step_2', $this->data);
	}

	public function edit_page_2()
	{
		if(!$this->is_login()){

			$this->require_login();
		}

		if(!$this->is_manage()){
			
			$this->session->set_userdata('title_mess_code', 'Warning message');
									
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			            
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Access is deny. You have not permission to access !');

			$segment = array('home', 'index');

			$this->redirect($segment);

		}

		$query = $this->T_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_1'));

		// Check data
		if( $query ) {

			$this->data['question'] = $query;

		}
		else {

			$this->session->set_userdata('title_mess_code', 'Warning message');
					
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			            
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'The question not found');

			$segment = array($this->router->class, 'index');

			$this->redirect($segment);

			return;
		}

		if (isset($this->session->userdata['STEP_2']['ID_GS1'])) {

			$this->data['ID_GS1'] = $this->session->userdata['STEP_2']['ID_GS1'];

		}

		$this->view('default', 'company/company_edit_view_step_3', $this->data);
		

	}

	public function edit_page_3()
	{
		if(!$this->is_login()){

			$this->require_login();
		}

		if(!$this->is_manage()){
			
			$this->session->set_userdata('title_mess_code', 'Warning message');
									
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			            
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Access is deny. You have not permission to access !');

			$segment = array('home', 'index');

			$this->redirect($segment);

		}

			$query = $this->T_growth_stage->get_data_by_property('*', array('NM_TYPE' => 'QUESTION_2'));

			// Check data
			if( $query ) {

				$this->data['question'] = $query;

			}

			if(isset($this->session->userdata['STEP_3']))
			{
				if($this->session->userdata['STEP_3']['ID_GS2'])
				{
					$this->data['ID_GS2'] = $this->session->userdata['STEP_3']['ID_GS2'];

				}
			}

		$this->view('default', 'company/company_edit_view_step_4', $this->data);
		
	}

	public function processing_edit()
	{

		if ($this->input->post()) {

			$data_post = $this->input->post();

			if (isset($data_post['step'])) {

				$current_step = $data_post['step'];

			} else {
				
				$this->session->set_userdata('title_mess_code', 'Error message');
	
				$this->session->set_userdata('type_mess_code', WARNING_CLASS);
		       	
		       	$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Deny Access ! Please Try Again');

				$segment = array($this->router->class, 'create');

				$this->redirect($segment);

				return;
			}
			


			if ($data_post['submit'] == 'NEXT') {

				if($current_step == 1) {

					$this->form_validation->set_rules(Company_rules::get_edit_company_rules_step_1());

					
					if ($this->form_validation->run() == TRUE) {

						$this->session->set_userdata('STEP_1',$data_post);

						$this->edit_page_2();
					} 
					else {

						$this->session->set_userdata('title_mess_code', 'Warning message');
									
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
						            
						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', validation_errors());

						$this->edit_page_1();
					}
					

					
				}
				else if ($current_step == 2) {

					$this->form_validation->set_rules(Company_rules::get_edit_company_rules_step_2());

					if ($this->form_validation->run() == TRUE) {
						
						$this->session->set_userdata('STEP_2',$data_post);

						$this->edit_page_3();
					} 
					else {
						

						$this->session->set_userdata('title_mess_code', 'Warning message');
									
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
						            
						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', validation_errors());

						$this->edit_page_2();
					}

				}
				else
				{
					$this->session->set_userdata('title_mess_code', 'Error message');
		
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			       	
			       	$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Deny Access ! Please Try Again');

					$segment = array($this->router->class, 'index');

					$this->redirect($segment);
				}



				
			} else if($data_post['submit'] == 'BACK') {

				if($current_step == 2) {

					$this->form_validation->set_rules(Company_rules::get_edit_company_rules_step_2());

					if ($this->form_validation->run() == TRUE) {

							$this->session->set_userdata('STEP_2',$data_post);

							$this->edit_page_1();
					}
					else
					{
						$this->edit_page_1();
					}
				}
				else if($current_step == 3) {

					$this->form_validation->set_rules(Company_rules::get_edit_company_rules_step_3());

					if ($this->form_validation->run() == TRUE) {

						$this->session->set_userdata('STEP_3',$this->input->post());

						$this->edit_page_2();
							
					}
					else
					{
						$this->edit_page_2();
					}

				}
				else
				{
					$this->session->set_userdata('title_mess_code', 'Error message');
		
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			       	
			       	$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Access Deny');

					$segment = array($this->router->class, 'create');

					$this->redirect($segment);
				}
				
			}
			else if ($data_post['submit'] == 'SAVE') {

				$this->form_validation->set_rules(Company_rules::get_edit_company_rules_step_3());

					
				if ($this->form_validation->run() == TRUE) {

					$this->session->set_userdata('STEP_3',$this->input->post());
				}
				else
				{


					$this->session->set_userdata('title_mess_code', 'Error message');
		
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			       	
			       	$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', validation_errors());

					$this->edit_page_3();
			
					return;
				}

				if (isset($this->session->userdata['STEP_1']) && isset($this->session->userdata['STEP_2']) && isset($this->session->userdata['STEP_3'])) {
					
					if (count($this->session->userdata['STEP_1']) && count($this->session->userdata['STEP_2']) && count($this->session->userdata['STEP_3'])) {
						
						$step_1 = $this->session->userdata['STEP_1'];

						$step_2 = $this->session->userdata['STEP_2'];

						$step_3 = $this->session->userdata['STEP_3'];

						$array_data_set = array(
							'NM_COMPANY' => $step_1['nm_company'], 
							'NM_RESPONDENT' => $step_1['nm_respondent'], 
							'NM_DESIGNATION' => $step_1['nm_designation'], 
							'ID_FAMILY_OWNED' => $step_1['id_family_owned'],
							'N_REVENUE' => $step_1['n_revenue'], 
							'N_STAFF_SIZE' => $step_1['n_staff_size'],
							'N_HR_SIZE' => $step_1['n_hr_size'], 
							'NM_INDUSTRY' => $step_1['nm_industry'],
							'NM_TYPE' => $step_1['nm_type'], 
							'TX_REMARKS' => $step_1['tx_remarks'],
							'ID_GS1' => $step_2['ID_GS1'], 
							'ID_GS2' => $step_3['ID_GS2']
						);	

						unset($this->session->userdata['STEP_1']);

						unset($this->session->userdata['STEP_2']);

						unset($this->session->userdata['STEP_3']);

					
						if($this->T_company_info->update_data_by_property($array_data_set, array('NM_COMPANY' => $step_1['nm_company'] ))) {

							$this->session->set_userdata('title_mess_code', 'Success message');
									
							$this->session->set_userdata('type_mess_code', SUCCESS_CLASS);
							            
							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Update company profile success !');

							$segment = array($this->router->class, 'index');

							$this->redirect($segment);

						}
						else {
							
							$this->session->set_userdata('title_mess_code', 'Warning message');
									
							$this->session->set_userdata('type_mess_code', WARNING_CLASS);
							            
							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Edit Company Fail ! Try Again');

							$segment = array($this->router->class, 'index');

							$this->redirect($segment);

						}

					}
					else
					{
						
						$this->session->set_userdata('title_mess_code', 'Error message');
				
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
				       	
				       	$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Data eror');

						$segment = array($this->router->class, 'create');

						$this->redirect($segment);
					}
					  
					
				} 
				else {
					
						$this->session->set_userdata('title_mess_code', 'Error message');
				
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
				       	
				       	$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Data Empty');

						$segment = array($this->router->class, 'create');

						$this->redirect($segment);
				}

			}
			else
			{

				$this->session->set_userdata('title_mess_code', 'Error message');
		
				$this->session->set_userdata('type_mess_code', WARNING_CLASS);
		       	
		       	$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Wrong method access');

				$segment = array($this->router->class, 'index');

				$this->redirect($segment);
			}
			
		}
		else {

			$this->session->set_userdata('title_mess_code', 'Error message');
		
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
	       	
	       	$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Wrong method access');

			$segment = array($this->router->class, 'index');

			$this->redirect($segment);

		}
	}
	
	public function search($key=''){

		if(!$this->is_login()) {

			$this->require_login();

		}

		if(!$this->is_manage()) {

			$this->session->set_userdata('title_mess_code', 'Warning message');
									
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			            
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Access is deny. You have not permission to access !');

			$segment = array('home', 'index');

			$this->redirect($segment);

		}
		else {

		if (!empty($key)) {

			if ($key=='edit') {

				if($this->input->post())
				{
					if($this->input->post()) {

						$this->data['data_search'] = $this->input->post();

						if($this->session->userdata[USER_SESSION_KEY]['IN_ADMIN'] == 1) {

							$this->data['result_search'] = $this->T_company_info->get_data_by_property('*',array('NM_COMPANY LIKE' => '%'. $this->data['data_search']['NM_COMPANY'] .'%'));

						}
						else {

							$this->data['result_search'] = $this->T_company_info->get_data_by_property('*',array("ID_CONSULTANT" =>$this->session->userdata[USER_SESSION_KEY]['ID_LOGIN'],'NM_COMPANY LIKE' => '%'. $this->data['data_search']['NM_COMPANY'] .'%'));
	
						}
						
						$this->view('default', 'company/company_edit_view_step_1', $this->data);
					
					}
					else {

						$this->echo_error('Error access !', 'Page not found. You can not access this url !');
					}
				}
				else
				{

					$this->session->set_userdata('title_mess_code', 'Error message');
			
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			       	
			       	$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Wrong method access 123');

					$segment = array($this->router->class, 'index');

					$this->redirect($segment);

				}
				
			} else {

				$this->session->set_userdata('title_mess_code', 'Error message');
		
				$this->session->set_userdata('type_mess_code', WARNING_CLASS);
		       	
		       	$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Deny access');

				$segment = array($this->router->class, 'index');

				$this->redirect($segment);
			}
			
		
		} else {
			
			$this->view('default', 'company/company_edit_view_step_1', $this->data);
		
		}
		
					

		}
		
	}
	

	public function edit($id_company=0)
	{
		if(!$this->is_login())
		{
			$this->require_login();
		}
		else
		{
			if($this->is_manage())
			{
				$query = $this->T_company_info->get_data_by_id('*',$id_company);

				if(isset($this->session->userdata['STEP_1']))
				{
					unset($this->session->userdata['STEP_1']);
				}
				if(isset($this->session->userdata['STEP_2']))
				{
					unset($this->session->userdata['STEP_2']);
				}
				if(isset($this->session->userdata['STEP_3']))
				{
					unset($this->session->userdata['STEP_3']);
				}

				if (count($query) > 0 ) {

					$array_step_1 = array(
						'id_company' => $query['ID_COMPANY'],
						'nm_company' => $query['NM_COMPANY'],
						'nm_respondent' => $query['NM_RESPONDENT'],
						'nm_designation' => $query['NM_DESIGNATION'],		
						'id_family_owned' => $query['ID_FAMILY_OWNED'],
						'n_revenue' => $query['N_REVENUE'],
						'n_staff_size' => $query['N_STAFF_SIZE'],
						'n_hr_size' => $query['N_HR_SIZE'],	
						'nm_industry' => $query['NM_INDUSTRY'],
						'nm_type' => $query['NM_TYPE'],
						'tx_remarks' => $query['TX_REMARKS'],
						'id_consultant' => $query['ID_CONSULTANT'],	
						'id_consultant_org' => $query['ID_CONSULTANT_ORG']															
					);

					$array_step_2 = array('ID_GS1' =>  $query['ID_GS1'] );

					$array_step_3 = array('ID_GS2' =>  $query['ID_GS2'] );

					$this->session->set_userdata('STEP_1',$array_step_1);

					$this->session->set_userdata('STEP_2',$array_step_2);

					$this->session->set_userdata('STEP_3',$array_step_3);

					$this->edit_page_1();

				} else {
					$this->session->set_userdata('title_mess_code', 'Warning message');
									
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
					            
					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'The company not found !');

					$segment = array('home', 'index');

					$this->redirect($segment);
				}
				
			}
			else
			{
				$this->session->set_userdata('title_mess_code', 'Warning message');
									
				$this->session->set_userdata('type_mess_code', WARNING_CLASS);
				            
				$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Access is deny. You have not permission to access !');

				$segment = array('home', 'index');

				$this->redirect($segment);
			}
		}
	}
	
}