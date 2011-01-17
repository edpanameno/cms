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

		$sqlQuery = "SELECT T.ticket_id, T.project_id, T.date_created, T.date_resolved, T.last_updated, T.title, T.description, " .
					"T.ticket_status as 'status_id', T.ticket_priority as 'priority_id', T.ticket_type as 'type_id', " . // used for drop down lists to change ticket
					"T.resolution_id, U.username as 'created_by', U2.username as 'assigned_to', U2.id as 'assigned_to_id', " .
					"TS.name as 'status', TT.name as 'type', TP.name as 'priority', TR.name as 'resolution_name'  " .
					"FROM tickets T, users U, users U2, ticket_status TS, ticket_types TT, ticket_priority TP, ticket_resolution TR " .
					"WHERE T.ticket_id = '$ticket_id' " .
					"AND T.created_by = U.id " .
					"AND T.assigned_to = U2.id " .
					"AND T.ticket_status = TS.status_id " .
					"AND T.ticket_priority = TP.priority_id " .
					"AND T.ticket_type = TT.type_id " .
					"AND T.resolution_id = TR.resolution_id ";

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

			$ticket_id = $this->input->post("ticket_id");
			$change_message = "<div class=\"change_message\"><ul>";

			// We need to get the current ticket information that
			// 'could be' changed first
			$query = $this->db->query("SELECT assigned_to, ticket_status, resolution_id, ticket_priority, ticket_type, title FROM tickets WHERE ticket_id = $ticket_id");
			$current_ticket_info = $query->row_array();

			// type
			$new_type_to_id = $this->input->post("new_type_id");
			if($current_ticket_info['ticket_type'] != $new_type_to_id) {
				$change_message .= "<li>Type Change from '";

				// Get the current ticket type name of this ticket
				$current_ticket_type_id = $current_ticket_info['ticket_type'];
				$query = $this->db->query("SELECT name FROM ticket_types WHERE type_id = $current_ticket_type_id");
				$current_ticket_type_name = $query->row_array();
				$change_message .= $current_ticket_type_name['name'] . "' to '";

				// Get the new ticket type for this ticket
				$query = $this->db->query("SELECT name FROM ticket_types WHERE type_id = $new_type_to_id");
				$new_ticket_type_name = $query->row_array();
				$change_message .= $new_ticket_type_name['name'] . "'</li>";
			}

			// priority
			$new_priority_to_id = $this->input->post("new_priority_id");
			if($current_ticket_info['ticket_priority'] != $new_priority_to_id) {
				$change_message .= "<li>Priority Change from '";

				// Get the current ticket priority name of this ticket
				$current_ticket_priority_id = $current_ticket_info['ticket_priority'];
				$query = $this->db->query("SELECT name FROM ticket_priority WHERE priority_id = $current_ticket_priority_id");
				$current_ticket_priority_name = $query->row_array();
				$change_message .= $current_ticket_priority_name['name'] . "' to '";

				// get the new ticket priority name of this ticket
				$query = $this->db->query("SELECT name FROM ticket_priority WHERE priority_id = $new_priority_to_id");
				$new_ticket_priority_name = $query->row_array();
				$change_message .= $new_ticket_priority_name['name'] . "'</li>";
			}

			// status
			$new_status_to_id = $this->input->post("new_status_id");
			if($current_ticket_info['ticket_status'] != $new_status_to_id) {
				$change_message .= "<li>Status Change from '";

				// Get the current ticket status id of this ticket
				$current_ticket_status_id = $current_ticket_info['ticket_status'];
				$query = $this->db->query("SELECT name FROM ticket_status WHERE status_id = $current_ticket_status_id");
				$current_ticket_status_name = $query->row_array();
				$change_message .= $current_ticket_status_name['name'] . "' to '";

				$query = $this->db->query("SELECT name FROM ticket_status WHERE status_id = $new_status_to_id");
				$new_ticket_status_name = $query->row_array();
				$change_message .= $new_ticket_status_name['name'] . "'</li>";
			}

			// resolution
			$new_resolution_to_id = $this->input->post("new_resolution_id");
			if($current_ticket_info['resolution_id'] != $new_resolution_to_id) {
				$change_message .= "<li>Resolution Change from '";

				$current_ticket_resolution_id = $current_ticket_info['resolution_id'];
				$query = $this->db->query("SELECT name FROM ticket_resolution WHERE resolution_id = $current_ticket_resolution_id");
				$current_ticket_resolution_name = $query->row_array();
				$change_message .= $current_ticket_resolution_name['name'] . "' to '";

				// get new resolution name for this ticket
				$query = $this->db->query("SELECT name FROM ticket_resolution where resolution_id = $new_resolution_to_id");
				$new_ticket_resolution_name = $query->row_array();
				$change_message .= $new_ticket_resolution_name['name'] . "'</li>";

				$date_resolved = date("Y-m-d H:i:s");
			}

			// assigned to
			$new_assigned_to_id = $this->input->post("new_assigned_to_id");
			if($current_ticket_info['assigned_to'] != $new_assigned_to_id) {
				$change_message .= "<li>Assigned to Changed from '";

				// Get the username of the current user that is assigned to this ticket
				$current_assigned_to_id = $current_ticket_info["assigned_to"];
				$query = $this->db->query("SELECT username FROM users WHERE id = $current_assigned_to_id");
				$current_assigned_to = $query->row_array();
				$change_message .= $current_assigned_to['username'] . "' to '";


				// Get the username of the new user that will be assigned to this ticket
				$query = $this->db->query("SELECT username FROM users WHERE id = $new_assigned_to_id");
				$new_assigned_to = $query->row_array();
				$change_message .= $new_assigned_to['username'] . "'</li>";
			}

			// title
			$new_title_name = trim($this->input->post("new_ticket_title"));
			if($current_ticket_info['title'] != $new_title_name) {
				$change_message .= "<li>Title Changed from '";

				// We already have the current ticket title, so no need to
				// query the database once mroe
				$change_message .= $current_ticket_info['title'] . "' to '";

				// We also already have the new ticket title name so no need
				// to query the database
				$change_message .= $new_title_name . "'</li>";
			}

			// At this point we have generated the whol change message
			// therefore we must close down the html code
			$change_message .= "</ul></div>";

			// Update the tickets table fields first, but we have to check to see
			// if the resolution status has changed.  IF so, then the variable
			// $date_resolved (which is set to the current date) is set
			// We therefore have to include this date in the update of the
			// tickets table.  If the $date_resolved variable is not set, then
			// this means we have not changed the resoltuion of this ticket and
			// therefore the resolution_date on the tickets table will remain null
			if(isset($date_resolved)) {
				$data = array(
					'assigned_to' => $new_assigned_to_id,
					'ticket_status' => $new_status_to_id,
					'resolution_id' => $new_resolution_to_id,
					'date_resolved' => $date_resolved,
					'ticket_priority' => $new_priority_to_id,
					'ticket_type' => $new_type_to_id,
					'title' => $new_title_name
				);
			}
			else {
				$data = array(
					'assigned_to' => $new_assigned_to_id,
					'ticket_status' => $new_status_to_id,
					'resolution_id' => $new_resolution_to_id,
					'ticket_priority' => $new_priority_to_id,
					'ticket_type' => $new_type_to_id,
					'title' => $new_title_name
				);
			}
			

			$this->db->where('ticket_id', $ticket_id);
			$this->db->update("tickets", $data);

			// Adding a new note to the ticket
			$data2 = array(
				'ticket_id' => $ticket_id,
				'created_by' => $this->ion_auth->get_user()->id,
				'date_created' => date("Y-m-d H:i:s"),
				'ticket_note_type' => 2,
				'description' => $change_message . $this->input->post("text_description")
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