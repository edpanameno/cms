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

	function getTicketsByProjectId($project_id) {

		$sqlQuery = "SELECT T.ticket_id, T.date_created, T.title, TS.name as 'status', U.username as 'created_by', TT.name as 'ticket_type' " .
				    "FROM tickets T, users U, ticket_status TS, ticket_types TT " .
					"WHERE T.project_id = '$project_id' " .
					"AND T.ticket_status !=  '2'" . // don't show closed issues
					"AND T.ticket_status = TS.status_id " .
					"AND T.created_by = U.id " .
					"AND T.ticket_type = TT.type_id " .
					"ORDER BY date_created DESC";

		$query = $this->db->query($sqlQuery);

		return $query->result();
	}

	function getTicketInfo($ticket_id) {

		$sqlQuery = "SELECT T.ticket_id, T.date_created, T.last_updated, T.title, T.description, " .
					"U.username as 'created_by', TS.name as 'status', TT.name as 'type', TP.name as 'priority'  " .
					"FROM tickets T, users U, ticket_status TS, ticket_types TT, ticket_priority TP " .
					"WHERE T.ticket_id = '$ticket_id' " .
					"AND T.created_by = U.id " .
					"AND T.ticket_status = TS.status_id " .
					"AND T.ticket_priority = TP.priority_id " .
					"AND T.ticket_type = TT.type_id ";

		$query = $this->db->query($sqlQuery);
		return $query->row();
	}
}