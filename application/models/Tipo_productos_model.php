<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_productos_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	protected $table = 'Tipo_Productos';

	public function listar_tipo_productos()
	{
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('idTipo_Productos',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function guardar_tipo_producto($data)
	{
		$this->db->insert($this->table,$data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	public function actualizar_tipo_producto($data,$id)
	{
		$this->db->where('idTipo_Productos', $id);
		$this->db->update($this->table, $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	public function borrar_tipo_productos($id)
	{
		$this->db->where('idTipo_Productos', $id);
		$this->db->delete($this->table);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}
}