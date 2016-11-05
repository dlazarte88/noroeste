<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->model('productos_model');
		$this->load->model('categoria_model');
		$this->load->model('tipo_productos_model');
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in()){
			redirect('/');
		}
		$this->load->view('template/head');
		$this->load->view('template/header');
		$this->load->view('template/menu_lateral');
		$this->load->view('productos/index');
		$this->load->view('template/footer');
	}

	public function listar()
	{
		if (!$this->ion_auth->logged_in()){
			redirect('/');
		}
		$aData = $this->productos_model->listar_productos();
		if ($aData == FALSE) {
			$aData->idProductos = '';
			$aData->Nombre = '';
			$aData->Codigo = '';
			$aData->Descripcion = '';
			$aData->Imagen = '';
		}
		$aResult = array("data" => $aData);
		echo json_encode($aResult);
	}
	
	public function guardar()
	{
		if (!$this->ion_auth->logged_in()){
			redirect('/');
		}
		$mode = "add";
		$this->validarForm($mode);
		$data = array(
			'Nombre' => $this->input->post('Nombre'),
			'Codigo' => $this->input->post('Codigo'),
			'Descripcion' => $this->input->post('Descripcion'),
			'Imagen' => $this->input->post('Imagen'),
			'Categoria_idCategoria' => $this->input->post('Categoria'),
		);
		$status = $this->productos_model->guardar_producto($data);
		echo json_encode(array("status" => $status));
	}

	public function editar($id)
	{
		if (!$this->ion_auth->logged_in()){
			redirect('/');
		}
		$aData = $this->categoria_model->listar_categorias();
		if ($aData == FALSE) {
			$aData->idCategoria = '';
			$aData->Nombre = '';
		}
		$data = $this->productos_model->get_by_id($id);
		$data->categoria_select = $aData;
		echo json_encode($data);
	}

	public function actualizar($id)
	{
		if (!$this->ion_auth->logged_in()){
			redirect('/');
		}
		$mode = "edit";
		$this->validarForm($mode);
		$data = array(
			'Nombre' => $this->input->post('Nombre'),
			'Codigo' => $this->input->post('Codigo'),
			'Descripcion' => $this->input->post('Descripcion'),
			'Imagen' => $this->input->post('Imagen'),
			'Categoria_idCategoria' => $this->input->post('Categoria'),
		);
		$status = $this->productos_model->actualizar_producto($data, $id);
		echo json_encode(array("status" => $status));
	}

	public function mostrar()
	{

	}

	public function borrar($id)
	{
		if (!$this->ion_auth->logged_in()){
			redirect('/');
		}
		$status = $this->productos_model->borrar_producto($id);
		echo json_encode(array("status" => $status));
	}

	public function verificar_codigo_ajax()
	{
		$codigo = $this->input->post('Codigo');
		$comprobar_codigo = $this->productos_model->verificar_codigo($codigo);
		if($comprobar_codigo == $codigo) {
			$data['validar'] = FALSE;
		} else {
			$data['validar'] = TRUE;
		}
		echo json_encode($data);
	}

	public function validarForm($mode)
	{
		if ($mode == "add") {
			$this->form_validation->set_rules('Codigo', 'Código', 'required|is_natural|is_unique[Productos.Codigo]');
		} else {
			$this->form_validation->set_rules('Codigo', 'Código', 'required|is_natural');
		}
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('Descripcion', 'Descripcion', 'required');
		$this->form_validation->set_rules('Imagen', 'Imagen', 'required');
		$this->form_validation->set_rules('Categoria', 'Categoría', 'required|is_natural');

		if ($this->form_validation->run() === FALSE) {
			$data['status'] = FALSE;
			$data['input_error'][] = 'Codigo';
			$data['input_error'][] = 'Nombre';
			$data['input_error'][] = 'Categoria';
			$data['input_error'][] = 'Imagen';
			$data['input_error'][] = 'Descripcion';
			$data['string_error'][] = form_error('Codigo');
			$data['string_error'][] = form_error('Nombre');
			$data['string_error'][] = form_error('Categoria');
			$data['string_error'][] = form_error('Imagen');
			$data['string_error'][] = form_error('Descripcion');
			echo json_encode($data);
			exit();
		}
	}

	public function guardarCategoria()
	{
		if (!$this->ion_auth->logged_in()){
			redirect('/');
		}
		$data = array(
			'Nombre' => $this->input->post('Nombre'),
		);
		$status = $this->categoria_model->guardar_categoria($data);
		echo json_encode(array("status" => $status));
	}

	public function listarCategoria()
	{
		if (!$this->ion_auth->logged_in()) {
			redirect('/');
		}
		$aData = $this->categoria_model->listar_categorias();
		if ($aData == FALSE) {
			$aData->idCategoria = '';
			$aData->Nombre = '';
		}
		$aResult = array("categoria_select" => $aData);
		echo json_encode($aResult);
	}

	public function guardarTipoProductos()
	{
		if (!$this->ion_auth->logged_in()){
			redirect('/');
		}
		$data = array(
			'Nombre' => $this->input->post('Nombre'),
		);
		$status = $this->categoria_model->guardar_tipo_producto($data);
		echo json_encode(array("status" => $status));
	}

	public function listarTipoProductos()
	{
		if (!$this->ion_auth->logged_in()) {
			redirect('/');
		}
		$aData = $this->categoria_model->listar_tipo_productos();
		if ($aData == FALSE) {
			$aData->idCategoria = '';
			$aData->Nombre = '';
		}
		$aResult = array("tipo_producto_select" => $aData);
		echo json_encode($aResult);
	}

	public function listarProducto(){
		if (!$this->ion_auth->logged_in()) {
			redirect('/');
		}
		$aData["categoria_select"] = $this->categoria_model->listar_categorias();
		if ($aData == FALSE) {
			$aData["categoria_select"]->idCategoria = '';
			$aData["categoria_select"]->Nombre = '';
		}
		$aData["tipo_producto_select"] = $this->tipo_productos_model->listar_tipo_productos();
		if ($aData == FALSE) {
			$aData["tipo_producto_select"]->idTipo_Productos = '';
			$aData["tipo_producto_select"]->Nombre = '';
		}
		$aResult = $aData;
		echo json_encode($aResult);
	}
}