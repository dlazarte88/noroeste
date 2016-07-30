<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	protected $table = 'groups';

	public function listar_roles()
	{
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return FALSE;
	}

}