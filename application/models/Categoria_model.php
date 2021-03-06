<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	protected $table = 'Categoria';

	public function listar_categorias()
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
		$this->db->where('idCategoria',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function guardar_categoria($data)
	{
		$this->db->insert($this->table,$data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	public function actualizar_categoria($data,$id)
	{
		$this->db->where('idCategoria', $id);
		$this->db->update($this->table, $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	public function borrar_categoria($id)
	{
		$this->db->where('idCategoria', $id);
		$this->db->delete($this->table);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}
}