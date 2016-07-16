<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
	}

	public function index()
	{
		if ($this->ion_auth->logged_in())
		{
			if ($this->ion_auth->is_admin()) {
				redirect('admin'); 
			}
		}else{
			$this->load->view('welcome_message');
		}
	}
}