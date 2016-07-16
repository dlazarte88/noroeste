<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library(array('ion_auth','form_validation'));
	}

	public function index()
	{
		if ($this->ion_auth->logged_in()){
			$this->load->view('template/head');
			$this->load->view('template/header');
			$this->load->view('template/menu_lateral');
			$this->load->view('productos/index');
			$this->load->view('template/footer');
		}
	}
}