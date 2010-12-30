<?php

class Ticket_model extends Model {

	function Ticket_model() {
		parent::Model();
	}

	function create() {
		
		$data = array(
			'date_created' => date("Y-m-d H:i:s"),
			'created_by' => $this->ion_auth->get_user()->id,
			'project_id' => $this->input->post('project_id'),
			'title' => $this->input->post('ticket_title'),
			'ticket_status' => $this->input->post('status_id'),
			'ticket_priority' => $this->input->post('priority_id'),
			'ticket_type' => $this->input->post('type_id'),
			'title' => trim($this->input->post('ticket_title')), // trim removes any space before/after the title
			'description' => $this->input->post('text_description')
		);

		$this->db->insert('tickets', $data);

		// Returns the newly created ticket id to be used (or not)
		// by the function that calls to create a new ticket
		return $this->db->insert_id();
	}

	function getAllTickets($project_id = '') {
		
	}
}