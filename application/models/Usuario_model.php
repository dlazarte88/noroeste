<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	protected $table = 'users';

	public function listar_usuario()
	{
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return FALSE;
	}
}