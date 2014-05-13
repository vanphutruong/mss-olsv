<?php
/**
 * User controller.
 *
 */

 class ParserCompany extends MY_Controller {

    public $public_template  = array(
                                    'template' => 'template',
                                    'subject' => 'subject'
                                );

  	function __construct() {

  		parent::__construct();

        $this->load->library('parser');

  	}

    /**
     * [set_value description]
     * @param string $template [description]
     * @param string $subject  [description]
     * set value to $public_template
     */
    public function set_value($template = null , $subject = null)
    {

        $this->public_template['template'] = $template;

        $this->public_template['subject'] = $subject;

    }

    /**
     * [send_id description]
     * @param  string $data [description]
     * @return [type]       [description]
     * get content email with id
     */
	public  function  send_id($data = null) 
    {    
      
    	$this->load->model('T_email_template');

    	$email_template = $this->T_email_template->get_data_by_property('*' , array("TYPE" => "EMAIL", "TEMPLATE_KEY" => "FORGOT_ID"));
      
    	if (count($email_template)) {

        	$string_template = $this->parser->parse_string($email_template[0]['TEMPLATE_BODY'], $data,TRUE);

        	$subject_email=$email_template[0]['TEMPLATE_SUBJECT'];

        	$this->set_value( $string_template , $subject_email);  

        	return $this->public_template;

        } 
        else {

            $this->set_value('', '');

            return $this->public_template;

        }
      
    }


    /**
     * [send_password description]
     * @param  string $data [description]
     * @return [type]       [description]
     * get content email with password
     */
    public  function  send_password($data = null) 
    {    
      
        $this->load->model('T_email_template');

        $email_template = $this->T_email_template->get_data_by_property('*' , array("TYPE" => "EMAIL", "TEMPLATE_KEY" => "FORGOT_PASSWORD"));
      
        if (count($email_template)) {

            $string_template = $this->parser->parse_string($email_template[0]['TEMPLATE_BODY'], $data,TRUE);

            $subject_email=$email_template[0]['TEMPLATE_SUBJECT'];

            $this->set_value( $string_template , $subject_email);

            return $this->public_template;
            
        } 
        else {

            $this->set_value('', '');

            return $this->public_template;

        }

    } 



    /**
     * [send_active_code description]
     * @param  string $data [description]
     * @return [type]       [description]
     * get content email with activecode
     */
    public  function  send_active_code($data = null) 
    {    
      
        $this->load->model('T_email_template');

        $email_template = $this->T_email_template->get_data_by_property('*' , array("TYPE" => "EMAIL", "TEMPLATE_KEY" => "ACTIVE_ACCOUNT"));
      
        if (count($email_template)) {

            $string_template = $this->parser->parse_string($email_template[0]['TEMPLATE_BODY'], $data,TRUE);

            $subject_email=$email_template[0]['TEMPLATE_SUBJECT'];

            $this->set_value( $string_template , $subject_email);  

            return $this->public_template;

        } 
        else {

            $this->set_value('', '');

            return $this->public_template;

        }

    }

}
