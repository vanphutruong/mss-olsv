<?php
/**
 * User controller.
 *
 */

class Report extends MY_Controller 
{
	function __construct() {

		parent::__construct();

		parent::__configure();

		parent::_unset();

		$this->load->model('T_survey_response_hdr');

		$this->load->model('T_company_info');

		$this->load->model('MReport');
	}

	public function index()
	{
		if ($this->is_login()) {

			$segment = array($this->router->class, 'search');

			$this->redirect($segment);

		}
		else {

			$this->require_login();

		}

	}


	public function search($key = ''){

		if(!$this->is_login()){

			$this->require_login();

		}

		if(!$this->is_admin())
		{

			$this->session->set_userdata('title_mess_code', 'Error message');
			
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			       	
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Deny Access');

			$segment = array('home', 'index');

			$this->redirect($segment);

		}
		else{

			if(empty($key))
			{

				$this->view('default', 'report/report_view_step_1', $this->data);

			}
			elseif ($key == 'company') {
				
				if($this->input->post())
				{
					$temp = $this->input->post();

					if (count($temp)) {

						$temp= $this->input->post('NM_COMPANY');

						if($this->input->post()){

						$this->data['data_search'] = $temp;

						$this->data['result_search'] = $this->T_survey_response_hdr->get_survey_completed($this->data['data_search']['NM_COMPANY']);

						$this->view('default', 'report/report_view_step_1', $this->data);
					
						}
						else
						{
							$this->echo_error('Error access !', 'Page not found. You can not access this url !');
						}

					} else {

						$this->session->set_userdata('title_mess_code', 'Error message');
					
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
						       	
						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Data empty');

						$segment = array($this->router->class, 'search');

						$this->redirect($segment);

					}
					
				}
				else
				{
					$this->session->set_userdata('title_mess_code', 'Error message');
				
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
					       	
					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Wrong method access');

					$segment = array($this->router->class, 'search');

					$this->redirect($segment);
				}

			}
			else
			{
				$this->session->set_userdata('title_mess_code', 'Error message');
				
				$this->session->set_userdata('type_mess_code', WARNING_CLASS);
				       	
				$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Deny Access');

				$segment = array($this->router->class, 'search');

				$this->redirect($segment);

			}

		}	
		
	}

	public function generate_report($id_company = '')
	{	
		if (!$this->is_login()) {
			
			$this->require_login();

		} else {
			
			if ($this->is_admin()) {
				
				if (empty($id_company)) {

					$this->session->set_userdata('title_mess_code', 'Warning message');
					
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
					            
					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Data empty ! Cannot create');

					$this->search();

				}
				elseif (!is_numeric($id_company)) {

					if ($this->input->post()) {

						if (isset($this->session->userdata['NAME_COMPANY']) && isset($this->session->userdata['ID_COMPANY']) && isset($this->session->userdata['ID_SURVEY'])) {
							
							$_POST['filename'] = $this->session->userdata['NAME_COMPANY'];

							$_POST['id_company'] = $this->session->userdata['ID_COMPANY'];

							$_POST['id_survey'] = $this->session->userdata['ID_SURVEY'];

							unset($this->session->userdata['NAME_COMPANY']); 

							unset($this->session->userdata['ID_COMPANY']);

							unset($this->session->userdata['ID_SURVEY']);

							$this->exporting($_POST);

						}
						else
						{
							$this->session->set_userdata('title_mess_code', 'Warning message');
							
							$this->session->set_userdata('type_mess_code', WARNING_CLASS);
							            
							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Data error ! Cannot create');

							$this->search();		
						}	
						

					} else {

						$this->session->set_userdata('title_mess_code', 'Warning message');
					
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
							            
						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Wrong method access');

						$this->search();

						return;
						
					}

				} 
				else {

					$nm_company = $this->T_company_info->get_data_by_id('NM_COMPANY',$id_company);

					if (count($nm_company)) {
						
						$query = $this->T_survey_response_hdr->get_data_by_property('*', array('ID_COMPANY' => $nm_company['NM_COMPANY'] ));

						if (count($query)) {

							$query = $query[0];

							if (count($query)) {
								
								$id_survey = $query['ID_SURVEY'];

							} else {
								
								$id_survey = 0;

								$this->session->set_userdata('title_mess_code', 'Warning message');
						
								$this->session->set_userdata('type_mess_code', WARNING_CLASS);
								            
								$this->session->set_userdata('error_flag_code', 1);

								$this->session->set_userdata('error_mess_code', 'Data error ! Cannot create');

								$this->search();

								return;
							}

							$this->session->set_userdata('NAME_COMPANY',$nm_company['NM_COMPANY']);

							$this->session->set_userdata('ID_COMPANY',$id_company);

							$this->session->set_userdata('ID_SURVEY',$id_survey);

							$this->load_gap_char($id_company,$id_survey);		
						}
						else
						{
							$id_survey = 0;

							$this->session->set_userdata('title_mess_code', 'Warning message');
					
							$this->session->set_userdata('type_mess_code', WARNING_CLASS);
							            
							$this->session->set_userdata('error_flag_code', 1);

							$this->session->set_userdata('error_mess_code', 'Data error ! Cannot create');

							$this->search();

							return;
						}

					}
					else
					{

						$id_survey = 0;

						$this->session->set_userdata('title_mess_code', 'Warning message');
				
						$this->session->set_userdata('type_mess_code', WARNING_CLASS);
						            
						$this->session->set_userdata('error_flag_code', 1);

						$this->session->set_userdata('error_mess_code', 'Data error ! Cannot create');

						$this->search();

						return;							
					}
					
				}
				

			} else {
				
				$this->session->set_userdata('title_mess_code', 'Warning message');
					
				$this->session->set_userdata('type_mess_code', WARNING_CLASS);
				            
				$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Deny access');

				$segment = array('home', 'index');

				$this->redirect($segment);
			}
			

		}
		
	}

	public function load_gap_char($id_company = '', $id_survey = '')
	{

		if ($this->is_login()) {
			
			$this->require_login();

		}

		if(!$this->is_admin())
		{
			$this->session->set_userdata('title_mess_code', 'Warning message');
				
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			            
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Access deny !');

			$segment = array('home', 'index');

			$this->redirect($segment);
		}
		


		$query_com = $this->T_company_info->get_data_by_id('NM_COMPANY',$id_company);

		if(count($query_com) == 1)
		{
			$query_sur = $this->T_survey_response_hdr->get_data_by_property('*', array('ID_SURVEY' => $id_survey, 'ID_COMPANY' => $query_com['NM_COMPANY'] ));

			if(count($query_sur) == 1)
			{
				if($query_sur[0]['TX_STATUS'] == 'Completed')
				{

				
					$query = $this->MReport->get_category();

					$this->data['LIST'] = $query;

					$query = $this->T_survey_response_hdr->get_data_by_property('*', array('ID_SURVEY' => $id_survey ));

					$line_blue_get = $query[0];

					$line_blue = array();

					$line_blue['INT_CAT1'] = (float) round($line_blue_get['INT_CAT1'], 2, PHP_ROUND_HALF_DOWN);

					$line_blue['INT_CAT2'] = (float) round($line_blue_get['INT_CAT2'], 2, PHP_ROUND_HALF_DOWN);

					$line_blue['INT_CAT3'] = (float) round($line_blue_get['INT_CAT3'], 2, PHP_ROUND_HALF_DOWN);

					$line_blue['INT_CAT4'] = (float) round($line_blue_get['INT_CAT4'], 2, PHP_ROUND_HALF_DOWN);

					$line_blue['INT_CAT5'] = (float) round($line_blue_get['INT_CAT5'], 2, PHP_ROUND_HALF_DOWN);

					$line_blue['INT_CAT6'] = (float) round($line_blue_get['INT_CAT6'], 2, PHP_ROUND_HALF_DOWN);

					$line_blue['INT_CAT7'] = (float) round($line_blue_get['INT_CAT7'], 2, PHP_ROUND_HALF_DOWN);

					$line_blue['INT_CAT8'] = (float) round($line_blue_get['INT_CAT8'], 2, PHP_ROUND_HALF_DOWN);

					$line_blue['INT_CAT9'] = (float) round($line_blue_get['INT_CAT9'], 2, PHP_ROUND_HALF_DOWN);

					$line_blue['INT_CAT10'] = (float) round($line_blue_get['INT_CAT10'], 2, PHP_ROUND_HALF_DOWN);

					$line_blue['INT_CAT11'] = (float) round($line_blue_get['INT_CAT11'], 2, PHP_ROUND_HALF_DOWN);


					$this->data['BLUE'] = $line_blue;

					$query = $this->T_company_info->get_data_by_id('*',$id_company);

					$id_gs1 = $query['ID_GS1'];

					$name_company = $query['NM_COMPANY'];

					$this->data['NAME'] = $name_company;

					$query = $this->MReport->get_point_red($id_gs1);

					$line_red_get = $query;

					$line_red  = array();

					$line_red['INT_CAT1'] = (float) round(($line_red_get[0]['IN_POINT'] + $line_red_get[1]['IN_POINT'] + $line_red_get[2]['IN_POINT'])/3, 2, PHP_ROUND_HALF_DOWN);

					$line_red['INT_CAT2'] = (float) round(($line_red_get[3]['IN_POINT'] + $line_red_get[4]['IN_POINT'] + $line_red_get[5]['IN_POINT'])/3, 2, PHP_ROUND_HALF_DOWN);

					$line_red['INT_CAT3'] = (float) round(($line_red_get[6]['IN_POINT'] + $line_red_get[7]['IN_POINT'] + $line_red_get[8]['IN_POINT'])/3, 2, PHP_ROUND_HALF_DOWN);

					$line_red['INT_CAT4'] = (float) round(($line_red_get[9]['IN_POINT'] + $line_red_get[10]['IN_POINT'] + $line_red_get[11]['IN_POINT'] + $line_red_get[12]['IN_POINT'])/4, 2, PHP_ROUND_HALF_DOWN);

					$line_red['INT_CAT5'] = (float) round(($line_red_get[13]['IN_POINT'] + $line_red_get[14]['IN_POINT'] + $line_red_get[15]['IN_POINT'] + $line_red_get[16]['IN_POINT'])/4, 2, PHP_ROUND_HALF_DOWN);

					$line_red['INT_CAT6'] = (float) round(($line_red_get[17]['IN_POINT'] + $line_red_get[18]['IN_POINT'] + $line_red_get[19]['IN_POINT'])/3, 2, PHP_ROUND_HALF_DOWN);

					$line_red['INT_CAT7'] = (float) round(($line_red_get[20]['IN_POINT'] + $line_red_get[21]['IN_POINT'] + $line_red_get[22]['IN_POINT'])/3, 2, PHP_ROUND_HALF_DOWN);

					$line_red['INT_CAT8'] = (float) round(($line_red_get[23]['IN_POINT'] + $line_red_get[24]['IN_POINT'] + $line_red_get[25]['IN_POINT'])/3, 2, PHP_ROUND_HALF_DOWN);

					$line_red['INT_CAT9'] = (float) round(($line_red_get[26]['IN_POINT'] + $line_red_get[27]['IN_POINT'])/2, 0, PHP_ROUND_HALF_DOWN);

					$line_red['INT_CAT10'] = (float) round(($line_red_get[28]['IN_POINT'] + $line_red_get[29]['IN_POINT'] + $line_red_get[30]['IN_POINT'])/3, 2, PHP_ROUND_HALF_DOWN);

					$line_red['INT_CAT11'] = (float) round(($line_red_get[31]['IN_POINT'] + $line_red_get[32]['IN_POINT'] + $line_red_get[33]['IN_POINT'])/3, 2, PHP_ROUND_HALF_DOWN);

					$this->data['RED'] = $line_red;

					$this->load->view('report/report_general_gap_chart',$this->data);		


				}
				else
				{
					$this->session->set_userdata('title_mess_code', 'Warning message');
					
					$this->session->set_userdata('type_mess_code', WARNING_CLASS);
					            
					$this->session->set_userdata('error_flag_code', 1);

					$this->session->set_userdata('error_mess_code', 'Data error ! Company Not Completed Survey');

					$segment = array('home', 'index');

					$this->redirect($segment);
				}
			}
			else
			{
				$this->session->set_userdata('title_mess_code', 'Warning message');
					
				$this->session->set_userdata('type_mess_code', WARNING_CLASS);
				            
				$this->session->set_userdata('error_flag_code', 1);

				$this->session->set_userdata('error_mess_code', 'Data error ! Cannot Create Report');

				$segment = array('home', 'index');

				$this->redirect($segment);
			}
		}
		else
		{
			$this->session->set_userdata('title_mess_code', 'Warning message');
				
			$this->session->set_userdata('type_mess_code', WARNING_CLASS);
			            
			$this->session->set_userdata('error_flag_code', 1);

			$this->session->set_userdata('error_mess_code', 'Data error ! Cannot Create Report');

			$segment = array('home', 'index');

			$this->redirect($segment);
		}

		
	}

	public function exporting($abc)
	{

		ini_set('magic_quotes_gpc', 'off');

		$type = $_POST['type'];

		$svg = (string) $_POST['svg'];

		$filename = (string) $_POST['filename'];

		// prepare variables
		if (!$filename or !preg_match('/^[A-Za-z0-9\-_ ]+$/', $filename)) {
			$filename = 'chart';
		}
		if (get_magic_quotes_gpc()) {
			$svg = stripslashes($svg);	
		}

		// check for malicious attack in SVG
		if(strpos($svg,"<!ENTITY") !== false || strpos($svg,"<!DOCTYPE") !== false){
			exit("Execution is topped, the posted SVG could contain code for a malicious attack");
		}


		$tempName = $filename;

		// allow no other than predefined types
		if ($type == 'image/png') {
			$typeString = '-m image/png';
			$ext = 'png';
			
		} elseif ($type == 'image/jpeg') {
			$typeString = '-m image/jpeg';
			$ext = 'jpg';

		} elseif ($type == 'application/pdf') {
			$typeString = '-m application/pdf';
			$ext = 'pdf';

		} elseif ($type == 'image/svg+xml') {
			$ext = 'svg';

		} else { // prevent fallthrough from global variables
			$ext = 'txt';
		}

		$outfile = "temp/$tempName.$ext";

		if (isset($typeString)) {
			
			// size
			$width = '';
			if ($_POST['width']) 
			{
				$width = (int)$_POST['width'];
				if ($width) $width = "-w $width";
			}

			if (!file_exists('temp')) 
			{
   				 mkdir('temp', 0777, true);
			}
			// generate the temporary file
			if (!file_put_contents("temp/$tempName.svg", $svg)) { 
				die("Couldn't create temporary file. Check that the directory permissions for
					the /temp directory are set to 777.");
			}
			
			define ('BATIK_PATH', 'batik-rasterizer.jar');

			// do the conversion
			$output = shell_exec("java -jar ". BATIK_PATH ." $typeString -d $outfile $width temp/$tempName.svg");
			
			// catch error
			if (!is_file($outfile) || filesize($outfile) < 10) 
			{
				
			} 
			
			// stream it
			else {
				header("Content-Disposition: attachment; filename=\"$filename.$ext\"");
				header("Content-Type: $type");
				//echo file_get_contents($outfile);
			}
			
			var_dump('LOAD 3D CHART and CREATE REPORT SEND MAIL');

			require_once("mpdf.php");

			$mpdf = new Create_pdf();

			$id_company = $_POST['id_company'];

			$id_survey = $_POST['id_survey'];

			$a->mpdf($id_company,$id_survey);
			// delete it
			// unlink("temp/$tempName.svg");
			// unlink($outfile);

		// SVG can be streamed directly back
		} else if ($ext == 'svg') {

			header("Content-Disposition: attachment; filename=\"$filename.$ext\"");

			header("Content-Type: $type");

			echo $svg;
			
		} else {

			echo "Invalid type";
		}
	}

}