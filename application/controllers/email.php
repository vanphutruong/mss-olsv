<?php
class Email extends MY_Controller {

	function __construct() {

		parent::__construct();

		$this->load->helper("url");

		$this->load->library('session');

		$this->load->library('phpmailer');

	}

	public function index(){
		
	}


	/**
	 * [sendmail description]
	 * @param  string $arraymail [description]
	 *         string $arraymail['subject'] [description]
	 *         string $arraymail['to'] [description]
	 *         string $arraymail['body'] [description]         
	 * @return [type]            [description]
	 */
	public function send_mail($array_mail = array(), $path_attach = null, $type = null)
	{

		if(!empty($array_mail)) {

			$mail = new PHPMailer();

		    $mail->IsSMTP();

			$mail->Port = PORT;

			$mail->CharSet = 'UTF-8';

			$mail->SMTPDebug = 0;

			$mail->SMTPSecure = SMTPSECURE; // OR SSL

			$mail->Host = HOST_MAIL;

			$mail->SMTPAuth = true;

			$mail->Username = USERNAME;

			$mail->Password = PASSWORD;

			$mail->From = ADMIN_MAIL;

			$mail->FromName = ADMIN_MAIL;

			$mail->Sender = ADMIN_MAIL;

			$mail->Subject = $array_mail['SUBJECT'];

			$mail->AddAddress($array_mail['TO']);

			$mail->Body = $array_mail['BODY'];

			$mail->IsHTML(true);

			if($path_attach != null) {

				$mail->AddAttachment("$path_attach");	

			}

			if($type == 'forgot_password') {

				$mail->AltBody = ALT_BODY_FORGOT_PASSWORD;

			}
			else if($type == 'forgot_username') {

				$mail->AltBody = ALT_BODY_FORGOT_ID;

			}
			else if($type == 'active_accout') {

				$mail->AltBody = ALT_BODY_ACTIVE_ACCOUNT;

			}
			elseif ($type == 'weekly_notification') {

				$mail->AltBody = ALT_BODY_ACTIVE_ACCOUNT;
			}
			else {
				
				return false;

			}

			if ($mail->Send()) {

				return true;

			}
			else {

				return false;

			}

		}
		else {

			return false;

		}

	}

}