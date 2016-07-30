<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	protected $table = 'Productos';

	public function listar_productos()
	{
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}

	public function guardar_producto($data)
	{
		$this->db->insert($this->table,$data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('idProductos',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function actualizar_producto($data, $id)
	{
		$this->db->where('idProductos', $id);
		$this->db->update($this->table, $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	public function borrar_producto($id)
	{
		$this->db->where('idProductos', $id);
		$this->db->delete($this->table);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	public function verificar_codigo($codigo)
	{
		$this->db->where('Codigo',$codigo);
        $consulta = $this->db->get($this->table);
		if($consulta->num_rows() == 1)
		{
		    $row = $consulta->row();
		    return $row->Codigo;
		}
		return FALSE;
	}
}