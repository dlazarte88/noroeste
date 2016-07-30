<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->model('usuario_model');
		$this->load->model('roles_model');
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in()){
			redirect('/');
		}
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/menu_lateral');
		$this->load->view('usuarios/index');
		$this->load->view('template/footer');
		
	}

	public function listar()
	{
		if (!$this->ion_auth->logged_in()){
			redirect('/');
		}
		// VALIDAR DATOS INGRESADOS
		
		$aData = $this->usuario_model->listar_usuario();
		if ($aData == FALSE) {			
			$aData['username'] = '';
			$aData['first_name'] = '';
			$aData['last_name'] = '';
			$aData['email'] = '';
			$aData['phone'] = '';
		}
		$aResult = array("data" => $aData);
		echo json_encode($aResult);
	}

	public function agregar()
	{
		if (!$this->ion_auth->logged_in()) {
			redirect('/');
		}
		$aData = $this->roles_model->listar_roles();
		if ($aData == FALSE) {
			$aData['id'] = '';
			$aData['name'] = '';
		}
		$aResult = array("usuario_select" => $aData);
		echo json_encode($aResult);
	}
}