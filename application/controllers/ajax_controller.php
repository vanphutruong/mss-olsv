<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*Ajax controller
*Description: ajax common function
*@author QuanHM
*/
Class Ajax_Controller extends CI_Controller{
	function __construct() {

		parent::__construct();

		$this->load->helper("url");

		$this->load->library(array('session'));

		parent::__configure();

	}
}
