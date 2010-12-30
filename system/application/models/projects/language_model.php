<?php

class Language_model extends Model {

	function Language_model() {
		parent::Model();
	}

	function create() {

		$data = array(
			'name' => $this->input->post('language_name')
		);

		$this->db->insert('languages', $data);
	}

	function getAllActive() {

		$query_results = array();
		$this->db->select('language_id, name');
		$this->db->where('is_active =', 1);
		$this->db->from('languages');
		$query = $this->db->get();

		foreach($query->result_array() as $row) {
			$query_results[$row['language_id']] = $row['name'];
		}

		return $query_results;
	}

	function getAllNonActive() {

		$query_results = array();
		$this->db->select('language_id, name');
		$this->db->where('is_active =', 0);
		$this->db->from('languages');
		$query = $this->db->get();

		foreach($query->result_array() as $row) {
			$query_results[$row['language_id']] = $row['name'];
		}

		return $query_results;
	}
}
