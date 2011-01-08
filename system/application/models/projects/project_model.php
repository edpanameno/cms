<?php

class Project_model extends Model {

	function Project_model() {
		parent::Model();
	}

	function create() {

		$data = array(
			'date_created' => date("Y-m-d H:i:s"),
			'created_by' => $this->ion_auth->get_user()->id,
			'language_id' => $this->input->post('language_id'),
			'name' => trim($this->input->post('project_name')),
			'description' => $this->input->post('text_description')
		);

		$this->db->insert('projects', $data);
	}

	function retrieve($project_id = '', $project_name = '') {

		$sqlQuery = 'SELECT P.project_id, P.date_created, P.last_updated, P.name, P.description, ' .
					'U.username as created_by, L.name as language_name ' .
					'FROM projects P, users U, languages L ' .
					'WHERE P.project_id = ' . $project_id . ' '.
					//'WHERE P.name = ' . $project_name .
					'AND P.created_by = U.id '.
					'AND P.language_id = L.language_id ' .
					'ORDER BY P.date_created DESC';

		$query = $this->db->query($sqlQuery);

		if($query->num_rows() == 0) {
			return false;
		}
		else {
			return $query->row();
		}
	}

	function retrieveAllActive() {

		$sqlQuery = 'SELECT P.project_id, P.date_created, P.last_updated, P.name, ' .
					'U.username AS created_by, L.name AS language_name ' .
					'FROM projects P, users U, languages L ' .
					'WHERE P.created_by = U.id '.
					'AND P.language_id = L.language_id ' .
					'ORDER BY P.date_created DESC';

		$query = $this->db->query($sqlQuery);
		return $query->result();
	}

	function update($project_id) {

	}
}