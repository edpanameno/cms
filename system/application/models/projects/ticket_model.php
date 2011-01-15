<?php

class Ticket_model extends Model {

	function Ticket_model() {
		parent::Model();
	}

	function create() {
		
		$data = array(
			'date_created' => date("Y-m-d H:i:s"),
			'created_by' => $this->ion_auth->get_user()->id,
			'assigned_to' => $this->input->post('assigned_to_id'),
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

		$sqlQuery = "SELECT T.ticket_id, T.date_created, T.title, TS.name as 'status', U.username as 'created_by', " .
					"U2.username as 'assigned_to', TT.name as 'ticket_type' " .
				    "FROM tickets T, users U, users U2, ticket_status TS, ticket_types TT " .
					"WHERE T.project_id = '$project_id' " .
					"AND T.ticket_status !=  '2'" . // don't show closed issues
					"AND T.ticket_status = TS.status_id " .
					"AND T.created_by = U.id " .
					"AND T.assigned_to = U2.id " .
					"AND T.ticket_type = TT.type_id " .
					"ORDER BY date_created DESC";

		$query = $this->db->query($sqlQuery);

		return $query->result();
	}

	function getTicketInfo($ticket_id) {

		$sqlQuery = "SELECT T.ticket_id, T.project_id, T.date_created, T.last_updated, T.title, T.description, " .
					"T.ticket_status as 'status_id', T.ticket_priority as 'priority_id', T.ticket_type as 'type_id', " . // used for drop down lists to change ticket
					"U.username as 'created_by', U2.username as 'assigned_to', U2.id as 'assigned_to_id', " .
					"TS.name as 'status', TT.name as 'type', TP.name as 'priority'  " .
					"FROM tickets T, users U, users U2, ticket_status TS, ticket_types TT, ticket_priority TP " .
					"WHERE T.ticket_id = '$ticket_id' " .
					"AND T.created_by = U.id " .
					"AND T.assigned_to = U2.id " .
					"AND T.ticket_status = TS.status_id " .
					"AND T.ticket_priority = TP.priority_id " .
					"AND T.ticket_type = TT.type_id ";

		$query = $this->db->query($sqlQuery);
		return $query->row();
	}

	function getTicketNotes($ticket_id) {

		$sqlQuery = "SELECT TN.date_created, TN.description, " .
					"U.username as 'created_by', TNT.name as 'note_type' " .
					"FROM ticket_notes TN, users U, ticket_note_types TNT " .
					"WHERE TN.ticket_id = '$ticket_id' " .
					"AND TN.created_by = U.id " .
					"AND TN.ticket_note_type = TNT.ticket_note_type_id ";

		$query = $this->db->query($sqlQuery);
		return $query->result();
	}

	function newNote() {

		// We first will check to see what kind of a note the user
		// is creating.  If a change to the ticket has been made
		// then the type of note will be handled by the 'Change Ticket'
		// section. If it's just a simple note then the 'Add Note'
		// section will handle a simple note (i.e. no changes to the
		// ticket).
		$action = $this->input->post("submit");

		if($action == "Change Ticket") {

			// Update the tickets table fields first
			$data = array(
				'assigned_to' => $this->input->post("new_assigned_to_id"),
				'ticket_status' => $this->input->post("new_status_id"),
				'ticket_priority' => $this->input->post("new_priority_id"),
				'ticket_type' => $this->input->post("new_type_id"),
				'title' => $this->input->post("new_ticket_title")
			);

			$this->db->where('ticket_id', $this->input->post("ticket_id"));
			$this->db->update("tickets", $data);

			// Adding a new note to the ticket
			$data2 = array(
				'ticket_id' => $this->input->post("ticket_id"),
				'created_by' => $this->ion_auth->get_user()->id,
				'date_created' => date("Y-m-d H:i:s"),
				'ticket_note_type' => 2,
				'description' => $this->input->post("text_description")
			);

			$this->db->insert("ticket_notes", $data2);
		}
		else if($action == "Add Note") {
			$data = array(
				'ticket_id' => $this->input->post("ticket_id"),
				'created_by' => $this->ion_auth->get_user()->id,
				'date_created' => date("Y-m-d H:i:s"),
				'ticket_note_type' => 1,
				'description' => $this->input->post("text_description")
			);

			$this->db->insert('ticket_notes', $data);
		}
	}
}