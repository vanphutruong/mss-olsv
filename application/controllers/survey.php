<?php
	/**
	 * User controller.
	 * @author GiamPQ
	 *
	 */
	class Survey extends MY_Controller {

		function __construct() {

			parent::__construct();

			parent::__configure();

			parent::_unset();

			$this->load->model('T_survey_question');

			$this->load->model('T_survey_option');

			$this->load->model('T_survey_response');

			$this->load->model('T_survey_response_dtl');

			$this->load->model('T_survey_response_hdr');

			$this->load->model('MReport');

			$this->load->model('T_company_info');

			$this->load->model('T_dropdown');

			$this->load->model('T_user');

			$this->load->helper('form');

			$this->load->library(array('form_validation'));

			$this->load->file(APPPATH . 'models/form_validation/survey_rules.php', false);

		}
		/**
		 * [index load view page survey with user role]
		 * @return [none] []
		 * @author [DEV] GIAMPQ  [Member PHP Team]
		 */
		public function index()
		{
			if ($this->is_login()) {

				$this->view('default', 'survey/manage_survey_view', $this->data);

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

		/**
		 * [search search company to take|update survey]
		 * @param  [string] $key   [value match 'take'|'update']
		 * @param  [string] $value [value match 'company'|null]
		 * @return [none]
		 * @author [DEV] GIAMPQ  [Member PHP Team]        
		 */
		public function search($key = null , $value = null)
		{
			if(!$this->is_login()){

				$this->require_login();
			}
			else
			{
				if(!empty($key)  && !is_null($key))
				{
					if ($key == 'take') {
						if ($value == 'company') {

							if ($this->input->post()) {

								$this->data['data_search'] = $this->input->post();

								$query = null;

								if($this->is_admin())
								{
									$query = $this->T_company_info->get_data_by_id_login( $this->data['data_search']['NM_COMPANY']);
								}
								else if($this->is_consultant())
								{
									$query = $this->T_company_info->get_data_by_id_login( $this->data['data_search']['NM_COMPANY'], $this->session->userdata[USER_SESSION_KEY]['ID_LOGIN']);
								}
								else if($this->is_user())
								{
									$query = null;
								}
								else
								{
									$this->session->set_userdata('title_mess_code', 'Warning message');

									$this->session->set_userdata('type_mess_code', WARNING_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'Access is deny. Please login !');	

									$this->session->sess_destroy();

	   								unset($this->session->userdata); 

									$segment = array('users', 'login');

									$this->redirect($segment);
								}

								if($query){

									foreach ($query as $key => $value) {

										if(!$value['consultant_id'] || !$value['tx_status']){

											$query[$key]['consultant_id'] = $this->session->userdata[USER_SESSION_KEY]['ID_USER'];
											
											$query[$key]['tx_status'] = 'Not Completed';

											$array = array('ID_COMPANY' => $value['nm_company'], 'CONSULTANT_ID' => $this->session->userdata[USER_SESSION_KEY]['ID_USER']);

											$query = $this->T_survey_response_hdr->set_data($array);
										}
									}	

								}


								$this->data['result_search'] = $query;

								$this->session->set_userdata('result_search',$query);

								$this->view('default', 'survey/take_survey_view_step_1', $this->data);

							} else {

								$this->session->set_userdata('title_mess_code', 'Warning message');

								$this->session->set_userdata('type_mess_code', WARNING_CLASS);

								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', 'Access is deny !');	

								$segment = array($this->router->class, 'index');

								$this->redirect($segment);
							}
							

						} else {

								$this->view('default', 'survey/take_survey_view_step_1', $this->data);
						}
					} else if ($key == 'update') {

						if($this->is_admin())
						{
							if ($value == 'company') {

								if ($this->input->post()) {

									$this->data['data_search'] = $this->input->post();

									$query = null;

									$query = $this->T_company_info->get_data_by_id_login( $this->data['data_search']['NM_COMPANY']);

									$array_data = array();
									

									if($query){

										foreach ($query as $key => $value) {

											//var_dump($query);

											$query_full = $this->T_company_info->get_data_to_update_survey($query[$key]['nm_company'],$query[$key]['id_company']);



											if($query_full)
											{	
												

												if($query_full['T_COMPANY'][0])
												{
													$array_data[$key]['NM_COMPANY'] = $query_full['T_COMPANY'][0]['NM_COMPANY'];
													$array_data[$key]['NM_DESIGNATION'] = $query_full['T_COMPANY'][0]['NM_DESIGNATION'];
													$array_data[$key]['ID_CONSULTANT']= $query_full['T_COMPANY'][0]['ID_CONSULTANT'];

												}
												if($query_full['T_SURVEY_RESPONSE_HDR'][0])
												{
													$point = $query_full['T_SURVEY_RESPONSE_HDR'][0]['INT_PT'];

													if($point < 1.9)
													{
														$array_data[$key]['HRMM_LEVEL'] = 'HRMM LEVEL I';
													}
													else if($point <= 2.9)
													{
														$array_data[$key]['HRMM_LEVEL'] = 'HRMM LEVEL II';
													}
													else if($point <=3.9)
													{
														$array_data[$key]['HRMM_LEVEL'] = 'HRMM LEVEL III';
													}
													else
													{
														$array_data[$key]['HRMM_LEVEL'] = 'HRMM LEVEL IV';
													}

													$array_data[$key]['DT_SURVEY_COMPLETE'] = $query_full['T_SURVEY_RESPONSE_HDR'][0]['DT_SURVEY_COMPLETE'];

													$array_data[$key]['TX_STATUS'] = $query_full['T_SURVEY_RESPONSE_HDR'][0]['TX_STATUS'];

												}
												if($query_full['T_DROPDOWN'][0])
												{
													$array_data[$key]['INDUSTRY'] = $query_full['T_DROPDOWN'][0]['VALUE'];
													$array_data[$key]['TYPE'] = $query_full['T_DROPDOWN'][1]['VALUE'];
													$array_data[$key]['REVENUE'] = $query_full['T_DROPDOWN'][2]['VALUE'];
													$array_data[$key]['TOTAL_STAFF'] = $query_full['T_DROPDOWN'][3]['VALUE'];
													$array_data[$key]['HR_STAFF'] = $query_full['T_DROPDOWN'][4]['VALUE'];
												}

											}


											foreach ($query as $key => $value) {

												if(!$value['consultant_id'] || !$value['tx_status']){

													$query[$key]['consultant_id'] = $this->session->userdata[USER_SESSION_KEY]['ID_USER'];
													
													$query[$key]['tx_status'] = 'Not Completed';

													$array = array('ID_COMPANY' => $value['nm_company'], 'CONSULTANT_ID' => $this->session->userdata[USER_SESSION_KEY]['ID_USER']);

													$query = $this->T_survey_response_hdr->set_data($array);
												}
											}

											if($array_data)
											{
												$this->data['result_search'] = $array_data;
											}
										}

									}




									$this->view('default', 'survey/update_survey_view_step_1', $this->data);	

								} 
								else 
								{

									$this->session->set_userdata('title_mess_code', 'Warning message');

									$this->session->set_userdata('type_mess_code', WARNING_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'Access is deny !');	

									$segment = array($this->router->class, 'index');

									$this->redirect($segment);
								}
							

							} 
							else 
							{

								$this->view('default', 'survey/update_survey_view_step_1', $this->data);

							}
						}
						else
						{

							$this->session->set_userdata('title_mess_code', 'Warning message');

							$this->session->set_userdata('type_mess_code', WARNING_CLASS);

							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Access is deny !');	

							$segment = array($this->router->class, 'index');

							$this->redirect($segment);

						}

						
					}
					else
					{
						$this->session->set_userdata('title_mess_code', 'Warning message');

						$this->session->set_userdata('type_mess_code', WARNING_CLASS);

						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Access is deny !');	

						$segment = array($this->router->class, 'index');

						$this->redirect($segment);
					}
					
				}
				else
				{
					$this->session->set_userdata('title_mess_code', 'Warning message');

					$this->session->set_userdata('type_mess_code', WARNING_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Access is deny !');	

					$segment = array($this->router->class, 'index');

					$this->redirect($segment);

				}
			}
			
		}

		/**
		 * [take_survey Load view firt page  start take survey ]
		 * @param  [string] $nm_company [name of company]
		 * @return [none] 
		 * @author [DEV] GIAMPQ  [Member PHP Team]
		 */
		public function take_survey($nm_company=null)
		{
			if($this->is_login()) {
				if(isset($nm_company) && !empty($nm_company))
				{
					$nm_company = urldecode($nm_company);

					$query_company = $this->T_company_info->get_survey_by_id_login($nm_company);


					if ($query_company) 
					{

						$id_survey = $query_company[0]['id_survey'];

						$this->session->set_userdata('survey',$query_company[0]);

						$query = $this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',array('ID_SURVEY' => $id_survey ),'ID_QUESTION');

						if($query)
						{

							$i = 1;

							while (isset($query[$i-1]['ID_QUESTION'])) {

								if ($i == $query[$i-1]['ID_QUESTION']) {

										$i++;

								} 
								else
								{
									break;
								}
							}


							if ($i>34) {
								
								if ($this->session->userdata['survey']['tx_status'] == 'Not Completed') {


									$this->data['nm_company'] = $this->session->userdata['survey']['nm_company']; 

									$id_question = 34;

									$id_survey = $this->session->userdata['survey']['id_survey']; 

									$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question ) );
							
									if(!empty($answer_old))
									{
										$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
									}

									$this->data['step'] = 34;

									$this->get_question_by_step($this->data['step']);

									$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

									$this->view('default', 'survey/take_survey_view_step_2', $this->data);

									return;
									
								} else {

									$this->session->set_userdata('title_mess_code', 'Warning message');

									$this->session->set_userdata('type_mess_code', WARNING_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'The company has complete survey . Please choose other company !');

									//$this->view('default', 'survey/take_survey_view_step_1', $this->data);
									
									$this->data['result_search'] = $this->session->userdata['result_search'];
									
								}
								
								

							} 
							
							if($i < 34)
							{
								$this->data['nm_company'] = $this->session->userdata['survey']['nm_company'];

								$this->data['step'] = $i;

								$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];
										
								$this->get_question_by_step($i);

								$this->view('default', 'survey/take_survey_view_step_2', $this->data);
							}
							else
							{
								
								if ($query_company[0]['tx_status'] == 'Completed') {
										
									$this->session->set_userdata('title_mess_code', 'Warning message');

									$this->session->set_userdata('type_mess_code', WARNING_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'The company has complete survey . Please choose other company !');

									$this->view('default', 'survey/take_survey_view_step_1', $this->data);

								} else {

									$this->data['nm_company'] = $this->session->userdata['survey']['nm_company'];

									$this->data['step'] = $i;

									$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];
											
									$this->get_question_by_step($i);

									$this->view('default', 'survey/take_survey_view_step_2', $this->data);

								}
								
							}



						}
						else
						{

							// UPDATE TIME START TAKE SURVEY FOR FIRST LOAD
							
							$time_take_survey = date("Y-m-d H:i:s");

							$this->T_survey_response_hdr->update_data_by_id(array("DT_SURVEY_START" => $time_take_survey),$this->session->userdata['survey']['id_survey']);

							$step = 1; 

							$this->data['nm_company'] = $this->session->userdata['survey']['nm_company'];

							$this->data['step'] = $step;

							$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];
							
							$this->get_question_by_step($step);

							$this->view('default', 'survey/take_survey_view_step_2', $this->data);
						}
											
					} 
					else 
					{

						$this->session->set_userdata('title_mess_code', 'Warning message');

						$this->session->set_userdata('type_mess_code', WARNING_CLASS);

						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'The Company Not Found');	

						$segment = array('users', 'login');

						$this->redirect($segment);

					}
					

				}	
				else
				{
					$this->session->set_userdata('title_mess_code', 'Warning message');

					$this->session->set_userdata('type_mess_code', WARNING_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Access is deny !');	

					$segment = array($this->router->class, 'index');

					$this->redirect($segment);
				}
			}
			else
			{
				$this->session->set_userdata('title_mess_code', 'Warning message');

				$this->session->set_userdata('type_mess_code', WARNING_CLASS);

				$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Access is deny !');	

				$segment = array('users', 'login');

				$this->redirect($segment);
			}
		}

		/**
		 * [processing_take_survey description]
		 * @return [type] [description]
		 */
		public function processing_take_survey()
		{
			if($this->input->post())
			{
				$this->form_validation->set_rules(Survey_rules::get_survey_rules());

				// Run validate with Rules
				// 
				if ($this->form_validation->run() == TRUE) {

					$step_current = $this->input->post('submit_step');

					$id_survey = $this->input->post('submit_id_survey');

					if($this->input->post('id_answer'))
					{

						$temp = $this->input->post('id_answer');

						if (is_numeric($temp) &&  $temp > 0 ) {

							$id_answer = $temp;
							
						} else {

							$id_answer = 0;
						}
						
					}
					else
					{
						$id_answer = 0;
					}
					


					$nm_category = $this->input->post('nm_category');

					$id_question = $this->input->post('id_question');

					$nm_company = $this->session->userdata['survey']['nm_company'];

					$this->data['nm_company'] = $this->session->userdata['survey']['nm_company'];

					if($this->input->post('submit') == 'Next')
					{

						$array_data = array(
							'ID_SURVEY' => $id_survey,
							'NM_CATEGORY' => $nm_category,
							'ID_QUESTION' => $id_question,
							'ID_ANSWER' => $id_answer
							 );
						$array_where = array(
							'ID_SURVEY' => $id_survey,
							'NM_CATEGORY' => $nm_category,
							'ID_QUESTION' => $id_question
							 );

						

						if($id_answer > 0 )
						{
							
							if($this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',$array_where))
							{
								$this->T_survey_response_dtl->update_data_by_property($array_data, $array_where);
								
								$step_current += 1;
							}
							else
							{
								if ($this->T_survey_response_dtl->set_data($array_data)) {

									$step_current += 1;
									
								} else {

									$this->session->set_userdata('title_mess_code', 'Warning message');

									$this->session->set_userdata('type_mess_code', WARNING_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'Save False !');
									
								}
								
							}

							$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1) );
							
							if(!empty($answer_old))
							{
								$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
							}

							$this->data['step'] = $step_current;

							$this->get_question_by_step($this->data['step']);

							$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

							$this->view('default', 'survey/take_survey_view_step_2', $this->data);					
						}
						else
						{
							$step_current += 1;

							$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1) );
							
							if(!empty($answer_old))
							{
								$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
							}

							$this->data['step'] = $step_current;

							$this->get_question_by_step($this->data['step']);

							$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

							$this->view('default', 'survey/take_survey_view_step_2', $this->data);	

						}

					}
					else if($this->input->post('submit')=='Previous')
					{

						$array_data = array(
							'ID_SURVEY' => $id_survey,
							'NM_CATEGORY' => $nm_category,
							'ID_QUESTION' => $id_question,
							'ID_ANSWER' => $id_answer
							 );
						$array_where = array(
							'ID_SURVEY' => $id_survey,
							'NM_CATEGORY' => $nm_category,
							'ID_QUESTION' => $id_question
							 );

						if($id_answer > 0 )
						{
							if($this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',$array_where))
							{
								$this->T_survey_response_dtl->update_data_by_property($array_data, $array_where);
								
								$step_current -= 1;
							}
							else
							{
								if ($this->T_survey_response_dtl->set_data($array_data)) {

									$step_current -= 1;
									
								} else {

									$this->session->set_userdata('title_mess_code', 'Warning message');

									$this->session->set_userdata('type_mess_code', WARNING_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'Save False !');
									
								}
								
							}
						}
						else
						{
							$step_current -= 1;
						}



						$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1) );
						
						if(!empty($answer_old))
						{
							$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
						}

						$this->data['step'] = $step_current;

						$this->get_question_by_step($this->data['step']);

						$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

						$this->view('default', 'survey/take_survey_view_step_2', $this->data);

					}
					else if ($this->input->post('submit')=='Save')
					{
						if($step_current == 34)
						{
							$array_data = array(
							'ID_SURVEY' => $id_survey,
							'NM_CATEGORY' => $nm_category,
							'ID_QUESTION' => $id_question,
							'ID_ANSWER' => $id_answer
							 );
							$array_where = array(
							'ID_SURVEY' => $id_survey,
							'NM_CATEGORY' => $nm_category,
							'ID_QUESTION' => $id_question
							 );

							if($id_answer>0)
							{
								if($this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',$array_where))
								{
									$this->T_survey_response_dtl->update_data_by_property($array_data, $array_where);
									
									$step_current += 1;
								}
								else
								{
									if ($this->T_survey_response_dtl->set_data($array_data)) {

										$step_current += 1;
										
									} else {

										$this->session->set_userdata('title_mess_code', 'Warning message');

										$this->session->set_userdata('type_mess_code', WARNING_CLASS);

										$this->session->set_userdata('error_flag_code', 1);

										$this->session->set_userdata('error_mess_code', 'Save False !');

										return;
										
									}
								}
							}
							else
							{
								$this->session->set_userdata('title_mess_code', 'Warning message');

								$this->session->set_userdata('type_mess_code', WARNING_CLASS);

								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', 'Please Select Answer !');

								$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1) );
						
								if(!empty($answer_old))
								{
									$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
								}

								$this->data['step'] = 34;

								$this->get_question_by_step($this->data['step']);

								$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

								$this->view('default', 'survey/take_survey_view_step_2', $this->data);

								return;
							}



							if($step_current > 34)
							{
								$query = $this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',array('ID_SURVEY' => $id_survey ),'ID_QUESTION');
								if(count($query) == 34)
								{

									$this->view('default', 'survey/thankyou_take_survey_view', null);

									$this->save_survey($id_survey, $nm_company);

								}
								else
								{
									$this->take_survey($nm_company);
								}


							}
							else
							{
								$this->session->set_userdata('title_mess_code', 'Warning message');

								$this->session->set_userdata('type_mess_code', WARNING_CLASS);

								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', 'Access is deny . Please try again !');

								$segment = array($this->router->class, 'index');

								$this->redirect($segment);

							}

						}
						else
						{
							$this->session->set_userdata('title_mess_code', 'Warning message');

							$this->session->set_userdata('type_mess_code', WARNING_CLASS);

							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Access is deny . Please try again !');

							$segment = array($this->router->class, 'index');

							$this->redirect($segment);
						}
					}
					else
					{
						$this->session->set_userdata('title_mess_code', 'Warning message');

						$this->session->set_userdata('type_mess_code', WARNING_CLASS);

						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Access is deny . Please try again !');

						$segment = array($this->router->class, 'index');

						$this->redirect($segment);
					}
				}
				else
				{
					$this->session->set_userdata('title_mess_code', 'Warning message');

					$this->session->set_userdata('type_mess_code', WARNING_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', validation_errors());

					$segment = array($this->router->class, 'index');

					$this->redirect($segment);
				}

			}
			else
			{

				$this->session->set_userdata('title_mess_code', 'Warning message');

				$this->session->set_userdata('type_mess_code', WARNING_CLASS);

				$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Access is deny !');	

				$segment = array($this->router->class, 'index');

				$this->redirect($segment);
			}
		}


		/**
		 * [save_survey save data survey processing]
		 * @param  [integer] $id_survey  [id of survey]
		 * @author [DEV] GIAMPQ  [Member PHP Team]
		 * @param  [string] $nm_company [name of company]
		 * @return [none] 
		 */
		public function save_survey($id_survey = null, $nm_company = null)
		{
			if($this->is_login())
			{
				if (!is_null($id_survey) && !is_null($nm_company) && !empty($id_survey) && !empty($nm_company)) {

					$query = $this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',array('ID_SURVEY' => $id_survey ),'ID_QUESTION');

					if(count($query) == 34)
					{

						$time_take_survey = date("Y-m-d H:i:s");

						$this->T_survey_response_hdr->update_data_by_id(array("DT_SURVEY_COMPLETE" => $time_take_survey, "TX_STATUS" => 'Completed'),$this->session->userdata['survey']['id_survey']);

						// CALCULATE SCORE
						
						$category_temp = $this->MReport->get_category();

						$i = 0;

						$category = array();

						foreach ($category_temp as $key => $value) 
							array_push($category,$value['NM_CATEGORY']);

						//$category = array('Recruitment', 'HR Management', 'Manpower Planning', 'Training & Development', 'Performance Management', 'Compensation & Benefits', 'Talent Management & Succession Planning', 'Organization Culture & Core Values', 'Employee Engagement & Communications', 'Employee Value Proposition (EVP)', 'International Mobility');

						$int_pt = 0;

						foreach ($category as $key => $value) {

							// get id question
							$id_question = $this->T_survey_question->get_data_by_property('id_question', array('nm_category' => $value));

							$number = count($id_question);

							$sum = 0;

							$sum = $this->T_survey_option->get_sum_point($id_survey, $id_question);

							$sum = round($sum[0]['sum']/$number, 1, PHP_ROUND_HALF_DOWN);

							$key += 1;

							$this->T_survey_response_hdr->update_data_by_id( array('INT_CAT'. $key => $sum), $id_survey);

							$int_pt += $sum;
						}

						$int_pt = round($int_pt/count($category), 1, PHP_ROUND_HALF_DOWN);

						$this->T_survey_response_hdr->update_data_by_id(array('INT_PT' => $int_pt), $id_survey);

						// UPDATE STATUS

					}
					else
					{
						$this->data['title'] = 'Error access !';

						$this->data['message'] = 'The company not complete survey !';

						$this->display_error($this->data);
					}
					
				} else {

					$this->data['title'] = 'Error access !';

					$this->data['message'] = 'Page not found. You can not access this url !';

					$this->display_error($this->data);
				}
			}
			else
			{
				$this->data['title'] = 'Error access !';

				$this->data['message'] = 'Page not found. You can not access this url !';

				$this->display_error($this->data);
			}
			
		}

		public function get_question_by_step($step = 0)
		{
			$step -= 1;

			$question = $this->T_survey_question->get_data_order_by_id( $step );

			$this->data['question'] = $question;

			$query = $this->T_survey_option->get_data_by_property('*', array('id_question' => $question['id_question']));

			$this->data['option'] = $query;

		}

		public function update_survey($nm_company='')
		{
			if($this->is_login())
			{
				if($this->is_admin())
				{
					$nm_company = urldecode($nm_company);

					$query_company = $this->T_company_info->get_survey_by_id_login($nm_company);


					if ($query_company) {

					$id_survey = $query_company[0]['id_survey'];

					$this->session->set_userdata('survey',$query_company[0]);

					$query = $this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',array('ID_SURVEY' => $id_survey ),'ID_QUESTION');

					

						if($query)
						{

							$i = 1;

							while (isset($query[$i-1]['ID_QUESTION'])) {

								if ($i == $query[$i-1]['ID_QUESTION']) {

										$i++;

								} 
								else
								{
									break;
								}
							}

							// Get number answer not complete first

							$this->data['nm_company'] = $this->session->userdata['survey']['nm_company'];

							if ($i>34) {

								// load question 1 and message
								

								$step_current = 1;

								$id_question = 0;

								$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1) );
								
								if(!empty($answer_old))
								{
									$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
								}

								$this->data['step'] = $step_current;

								$this->get_question_by_step($this->data['step']);

								$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

								$this->view('default', 'survey/update_survey_view_step_2', $this->data);	
								


							} 
							
							if($i <= 34)
							{

								$this->data['nm_company'] = $this->session->userdata['survey']['nm_company'];

								$this->data['step'] = $i;

								$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];
									
								$this->get_question_by_step($i);

								$this->view('default', 'survey/update_survey_view_step_2', $this->data);

							}

						}
						else
						{

							// UPDATE TIME START TAKE SURVEY FOR FIRST LOAD
							
							$time_take_survey = date("Y-m-d H:i:s");

							$this->T_survey_response_hdr->update_data_by_id(array("DT_SURVEY_START" => $time_take_survey),$this->session->userdata['survey']['id_survey']);

							$step = 1; 

							$this->data['nm_company'] = $this->session->userdata['survey']['nm_company'];

							$this->data['step'] = $step;

							$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];
							
							$this->get_question_by_step($step);

							$this->view('default', 'survey/update_survey_view_step_2', $this->data);
						}
										
				} 
				else 
				{

					$this->session->set_userdata('title_mess_code', 'Warning message');

					$this->session->set_userdata('type_mess_code', WARNING_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'The Company Not Found');	

					$segment = array('users', 'login');

					$this->redirect($segment);

				}


				}
				else
				{
					$this->session->set_userdata('title_mess_code', 'Warning message');

					$this->session->set_userdata('type_mess_code', WARNING_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Access is deny !');	

					$segment = array('users', 'login');

					$this->redirect($segment);
				}
			}
			else
			{
				$this->session->set_userdata('title_mess_code', 'Warning message');

				$this->session->set_userdata('type_mess_code', WARNING_CLASS);

				$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Access is deny !');	

				$segment = array('users', 'login');

				$this->redirect($segment);
			}
		}
		
		public function processing_update_survey()
		{
			if($this->is_admin())
			{
				if($this->input->post())
				{
					$this->form_validation->set_rules(Survey_rules::get_survey_rules());

					// Run validate with Rules
					// 
					if ($this->form_validation->run() == TRUE) {

						$step_current = $this->input->post('submit_step');

						$id_survey = $this->input->post('submit_id_survey');

						if($this->input->post('id_answer'))
						{

							$temp = $this->input->post('id_answer');

							if (is_numeric($temp) &&  $temp > 0 ) {

								$id_answer = $temp;
								
							} else {

								$id_answer = 0;
							}
							
						}
						else
						{
							$id_answer = 0;
						}
						


						$nm_category = $this->input->post('nm_category');

						$id_question = $this->input->post('id_question');

						$nm_company = $this->session->userdata['survey']['nm_company'];

						$this->data['nm_company'] = $this->session->userdata['survey']['nm_company'];

						if($this->input->post('submit') == 'Next')
						{

							$array_data = array(
								'ID_SURVEY' => $id_survey,
								'NM_CATEGORY' => $nm_category,
								'ID_QUESTION' => $id_question,
								'ID_ANSWER' => $id_answer
								 );
							$array_where = array(
								'ID_SURVEY' => $id_survey,
								'NM_CATEGORY' => $nm_category,
								'ID_QUESTION' => $id_question
								 );

							

							if($id_answer > 0 )
							{
								
								if($this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',$array_where))
								{
									$this->T_survey_response_dtl->update_data_by_property($array_data, $array_where);
									
									$step_current += 1;
								}
								else
								{
									if ($this->T_survey_response_dtl->set_data($array_data)) {

										$step_current += 1;
										
									} else {

										$this->session->set_userdata('title_mess_code', 'Warning message');

										$this->session->set_userdata('type_mess_code', WARNING_CLASS);

										$this->session->set_userdata('error_flag_code', 1);

										$this->session->set_userdata('error_mess_code', 'Save False !');
										
									}
									
								}

								$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1) );
								
								if(!empty($answer_old))
								{
									$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
								}

								$this->data['step'] = $step_current;

								$this->get_question_by_step($this->data['step']);

								$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

								$this->view('default', 'survey/update_survey_view_step_2', $this->data);					
							}
							else
							{
								$step_current += 1;

								$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1) );
								
								if(!empty($answer_old))
								{
									$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
								}

								$this->data['step'] = $step_current;

								$this->get_question_by_step($this->data['step']);

								$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

								$this->view('default', 'survey/update_survey_view_step_2', $this->data);	

							}

						}
						else if($this->input->post('submit')=='Previous')
						{

							$array_data = array(
								'ID_SURVEY' => $id_survey,
								'NM_CATEGORY' => $nm_category,
								'ID_QUESTION' => $id_question,
								'ID_ANSWER' => $id_answer
								 );
							$array_where = array(
								'ID_SURVEY' => $id_survey,
								'NM_CATEGORY' => $nm_category,
								'ID_QUESTION' => $id_question
								 );

							if($id_answer > 0 )
							{
								if($this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',$array_where))
								{
									$this->T_survey_response_dtl->update_data_by_property($array_data, $array_where);
									
									$step_current -= 1;
								}
								else
								{
									if ($this->T_survey_response_dtl->set_data($array_data)) {

										$step_current -= 1;
										
									} else {

										$this->session->set_userdata('title_mess_code', 'Warning message');

										$this->session->set_userdata('type_mess_code', WARNING_CLASS);

										$this->session->set_userdata('error_flag_code', 1);

										$this->session->set_userdata('error_mess_code', 'Save False !');
										return;
										
									}
									
								}
							}
							else
							{
								$step_current -= 1;
							}

							$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1) );
							
							if(!empty($answer_old))
							{
								$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
							}

							$this->data['step'] = $step_current;

							$this->get_question_by_step($this->data['step']);

							$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

							$this->view('default', 'survey/update_survey_view_step_2', $this->data);

						}
						else if ($this->input->post('submit')=='Save')
						{
							if($step_current == 34)
							{
								$array_data = array(
								'ID_SURVEY' => $id_survey,
								'NM_CATEGORY' => $nm_category,
								'ID_QUESTION' => $id_question,
								'ID_ANSWER' => $id_answer
								 );
								$array_where = array(
								'ID_SURVEY' => $id_survey,
								'NM_CATEGORY' => $nm_category,
								'ID_QUESTION' => $id_question
								 );

								if($id_answer>0)
								{
									if($this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',$array_where))
									{
										$this->T_survey_response_dtl->update_data_by_property($array_data, $array_where);
										
										$step_current += 1;
									}
									else
									{
										if ($this->T_survey_response_dtl->set_data($array_data)) {

											$step_current += 1;
											
										} else {

											$this->session->set_userdata('title_mess_code', 'Warning message');

											$this->session->set_userdata('type_mess_code', WARNING_CLASS);

											$this->session->set_userdata('error_flag_code', 1);

											$this->session->set_userdata('error_mess_code', 'Save False !');

											return;
											
										}
									}
								}
								else
								{
									$this->session->set_userdata('title_mess_code', 'Warning message');

									$this->session->set_userdata('type_mess_code', WARNING_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'Please Select Answer !');

									$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1) );
							
									if(!empty($answer_old))
									{
										$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
									}

									$this->data['step'] = 34;

									$this->get_question_by_step($this->data['step']);

									$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

									$this->view('default', 'survey/update_survey_view_step_2', $this->data);

									return;
								}

								if($step_current > 34)
								{
									$query = $this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',array('ID_SURVEY' => $id_survey ),'ID_QUESTION');

									if(count($query) == 34)
									{

										$this->view('default', 'survey/thankyou_take_survey_view', null);

										$this->save_survey($id_survey, $nm_company);

									}
									else
									{
										$this->update_survey($nm_company);
									}


								}
								else
								{
									$this->session->set_userdata('title_mess_code', 'Warning message');

									$this->session->set_userdata('type_mess_code', WARNING_CLASS);

									$this->session->set_userdata('error_flag_code', 1);

									$this->session->set_userdata('error_mess_code', 'Access is deny . Please try again !');

									$segment = array($this->router->class, 'index');

									$this->redirect($segment);

								}

							}
							else
							{
								$this->session->set_userdata('title_mess_code', 'Warning message');

								$this->session->set_userdata('type_mess_code', WARNING_CLASS);

								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', 'Access is deny . Please try again !');

								$segment = array($this->router->class, 'index');

								$this->redirect($segment);
							}
						}
						else if($this->input->post('submit')=='Save_Current')
						{
							$array_data = array(
							'ID_SURVEY' => $id_survey,
							'NM_CATEGORY' => $nm_category,
							'ID_QUESTION' => $id_question,
							'ID_ANSWER' => $id_answer
							 );
							$array_where = array(
							'ID_SURVEY' => $id_survey,
							'NM_CATEGORY' => $nm_category,
							'ID_QUESTION' => $id_question
							 );

							if($id_answer>0)
							{
								if($this->T_survey_response_dtl->get_data_by_property('ID_QUESTION',$array_where))
								{
									$this->T_survey_response_dtl->update_data_by_property($array_data, $array_where);
									
									$step_current += 1;
								}
								else
								{
									if ($this->T_survey_response_dtl->set_data($array_data)) {

										$step_current += 1;
										
									} else {

										$this->session->set_userdata('title_mess_code', 'Warning message');

										$this->session->set_userdata('type_mess_code', WARNING_CLASS);

										$this->session->set_userdata('error_flag_code', 1);

										$this->session->set_userdata('error_mess_code', 'Save False !');

										return;
										
									}
								}

								$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question + 1) );
						
								if(!empty($answer_old))
								{
									$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
								}

								$this->data['step'] = $step_current;

								$this->get_question_by_step($this->data['step']);

								$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

								$this->view('default', 'survey/update_survey_view_step_2', $this->data);

							}
							else
							{
								$this->session->set_userdata('title_mess_code', 'Warning message');

								$this->session->set_userdata('type_mess_code', WARNING_CLASS);

								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', 'Please Select Answer !');

								$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $id_question - 1) );
						
								if(!empty($answer_old))
								{
									$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
								}

								$this->data['step'] = $step_current;

								$this->get_question_by_step($this->data['step']);

								$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

								$this->view('default', 'survey/update_survey_view_step_2', $this->data);

								return;
							}
						}
						else
						{
							$this->session->set_userdata('title_mess_code', 'Warning message');

							$this->session->set_userdata('type_mess_code', WARNING_CLASS);

							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Access is deny . Please try again !');

							$segment = array($this->router->class, 'index');

							$this->redirect($segment);
						}
					}
					else
					{
						$this->session->set_userdata('title_mess_code', 'Warning message');

						$this->session->set_userdata('type_mess_code', WARNING_CLASS);

						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', validation_errors());

						$segment = array($this->router->class, 'index');

						$this->redirect($segment);
					}

				}
				else
				{

					$this->session->set_userdata('title_mess_code', 'Warning message');

					$this->session->set_userdata('type_mess_code', WARNING_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Access is deny !');	

					$segment = array($this->router->class, 'index');

					$this->redirect($segment);
				}
			}
			else
			{
				$this->session->set_userdata('title_mess_code', 'Warning message');

				$this->session->set_userdata('type_mess_code', WARNING_CLASS);

				$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Access is deny !');	

				$segment = array($this->router->class, 'index');

				$this->redirect($segment);
			}

		}

		public function goto_survey($nm_company='',$step='')
		{
			if($this->is_admin())
			{
				if ($this->input->post()) 
				{
					$this->form_validation->set_rules(Survey_rules::get_goto_rules());

					// Run validate with Rules
					// 
					if ($this->form_validation->run() == TRUE) 
					{

						$question_number = $this->input->post('no_question');

						$key_valid = $this->input->post('submit');

						$id_survey = $this->session->userdata['survey']['id_survey'];

						$this->data['nm_company'] = $this->session->userdata['survey']['nm_company'];

						if ($key_valid == 'Search') {

								$step_current = $question_number;

								$answer_old = $this->T_survey_response_dtl->get_data_by_property('ID_ANSWER', array('ID_SURVEY' => $id_survey, 'ID_QUESTION' => $question_number ) );
								
								if(!empty($answer_old))
								{
									$this->data['id_answer'] = $answer_old[0]['ID_ANSWER'];
								}

								$this->data['step'] = $step_current;

								$this->get_question_by_step($this->data['step']);

								$this->data['id_survey'] = $this->session->userdata['survey']['id_survey'];

								$this->view('default', 'survey/update_survey_view_step_2', $this->data);	


						} else {

							$this->session->set_userdata('title_mess_code', 'Warning message');

							$this->session->set_userdata('type_mess_code', WARNING_CLASS);

							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Access is deny !');	

							$segment = array($this->router->class, 'index');

							$this->redirect($segment);
						}
						
					}
					else
					{
						$this->session->set_userdata('title_mess_code', 'Warning message');

						$this->session->set_userdata('type_mess_code', WARNING_CLASS);

						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', validation_errors());

						$segment = array($this->router->class, 'index');

						$this->redirect($segment);
					}
				} 
				else 
				{

					$this->session->set_userdata('title_mess_code', 'Warning message');

					$this->session->set_userdata('type_mess_code', WARNING_CLASS);

					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Access is deny !');	

					$segment = array($this->router->class, 'index');

					$this->redirect($segment);

				}
				
			}
			else
			{
				$this->session->set_userdata('title_mess_code', 'Warning message');

				$this->session->set_userdata('type_mess_code', WARNING_CLASS);

				$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Access is deny !');	

				$segment = array($this->router->class, 'index');

				$this->redirect($segment);
			}
		}


		public function weekly_notification()
		{

			/** Include PHPExcel */

			require_once 'Classes/PHPExcel.php';

			// Create new PHPExcel object
			 
			$objPHPExcel = new PHPExcel();

			// Set document properties
			
			$objPHPExcel->getProperties()->setCreator("Online survey application")
			->setLastModifiedBy("Online survey application")
			->setTitle("Report")
			->setSubject("Excel Document")
			->setDescription("•	This weekly report will be generated and exported to Excel on every Monday for the previous week ")
			->setKeywords("Survey");


			// $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
			// $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
			// $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
			// $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
			// $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
			// $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
			// $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
			// $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
			// $objPHPExcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
			// $objPHPExcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);


			// Add some data
			
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'S/No')
			->setCellValue('B1', 'Company ID')
			->setCellValue('C1', 'Designation')
			->setCellValue('D1', 'Revenue size')
			->setCellValue('E1', 'Total staff size')
			->setCellValue('F1', 'HR staff size')
			->setCellValue('G1', 'Company industry')
			->setCellValue('H1', 'Overall HRMM Maturity Level points')
			->setCellValue('I1', 'Survey completion date')
			->setCellValue('J1', 'Consultant ID')
			;

			$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);;

			$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->applyFromArray(
		    array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'C4C4C4')
		        	),
		        'borders' => array(
		            'allborders' => array(
		                'style' => PHPExcel_Style_Border::BORDER_THIN
		            	)
		        	)
		    	)
			);

			$company_report = $this->T_survey_response_hdr->get_data_report_weekly();

			if( $company_report ) {

				foreach ($company_report as $key => $value) {

					$key += 2;

					$n_revenue = $this->T_dropdown->get_data_by_id('value', $value['n_revenue']);

					$n_staff_size = $this->T_dropdown->get_data_by_id('value', $value['n_staff_size']);

					$n_hr_size = $this->T_dropdown->get_data_by_id('value', $value['n_hr_size']);

					$nm_industry = $this->T_dropdown->get_data_by_id('value', $value['nm_industry']);

					$nm_consultant = $this->T_user->get_data_by_id('id_login', $value['consultant_id']);

					// border Cell
					$objPHPExcel->getActiveSheet()->getStyle('A'. $key. ':J'. $key)->applyFromArray(
				    array(
				        'borders' => array(
				            'allborders' => array(
				                'style' => PHPExcel_Style_Border::BORDER_THIN
				            	)
				        	)
				    	)
					);

					$objPHPExcel->getActiveSheet()->getStyle('A'. $key. ':J'. $key)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A' . $key, $key - 1)
						->setCellValue('B' . $key, $value['nm_company'])
						->setCellValue('C' . $key, $value['nm_designation'])
						->setCellValue('D' . $key, $n_revenue['value'])
						->setCellValue('E' . $key, $n_staff_size['value'])
						->setCellValue('F' . $key, $n_hr_size['value'])
						->setCellValue('G' . $key, $nm_industry['value'])
						->setCellValue('H' . $key, $value['int_pt'])
						->setCellValue('I' . $key, $value['dt_survey_complete'])
						->setCellValue('J' . $key, $nm_consultant['id_login']);

				}
			}

			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Weekly Notification');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Save file
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

			$objWriter->save(str_replace('.php', '.xls', __FILE__));
		
			$path = str_replace('.php', '.xls', __FILE__);

			// echo 'Files have been created in ' , getcwd() .'<br>';
			
			require_once('email.php');

			$mail = new Email();

			$temp = 'Weekly report .<br>';
			
			$content = array( 'SUBJECT' => 'Completion of Survey Notification',
				'TO' => 'phanquocgiam@gmail.com',
				'BODY' => $temp );

			// send mail
			if($mail->send_mail($content, $path,'weekly_notification')){

				//delete excel
				
				unlink($path);

				var_dump('GUI MAIL THANH CONG');exit();

			}
			else
			{
				var_dump('LOI GUI MAIL');exit();
			}
		}
}