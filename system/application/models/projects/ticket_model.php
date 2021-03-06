<?php

class Ticket_model extends Model {

	function Ticket_model() {
		parent::Model();
	}

	function create() {
		
		$data = array(
			'date_created' => date("Y-m-d H:i:s"),
			'last_updated' => date("Y-m-d H:i:s"),
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

		$sqlQuery = "SELECT T.ticket_id, T.date_created, T.title, TS.name as 'status', " .
					"TT.name as 'ticket_type' " .
				    "FROM tickets T, ticket_status TS, ticket_types TT " .
					"WHERE T.project_id = '$project_id' " .
					"AND T.ticket_status !=  '2'" . // don't show closed issues
					"AND T.ticket_status = TS.status_id " .
					"AND T.ticket_type = TT.type_id " .
					"ORDER BY date_created DESC";

		$query = $this->db->query($sqlQuery);

		return $query->result();
	}

	// The project_id field is used to make sure we only
	// retrive ticket information for the project_id associated
	// with the ticket_id
	function getTicketInfo($ticket_id, $project_id) {

		$sqlQuery = "SELECT T.ticket_id, T.project_id, T.date_created, T.date_resolved, T.last_updated, T.latest_note_date, T.title, T.description, " .
					"T.ticket_status as 'status_id', T.ticket_priority as 'priority_id', T.ticket_type as 'type_id', " . // used for drop down lists to change ticket
					"T.resolution_id, T.closed_by, M.first_name as 'created_by', M2.first_name as 'assigned_to', M2.id as 'assigned_to_id', " .
					"TS.name as 'status', TT.name as 'type', TP.name as 'priority', TR.name as 'resolution_name',  " .
					"CASE
						WHEN IsNull(T.closed_by) THEN 'n/a'
						ELSE (SELECT first_name FROM meta WHERE id = T.closed_by)
					 END as resolved_by
					 " .
					"FROM tickets T, meta M, meta M2, ticket_status TS, ticket_types TT, ticket_priority TP, ticket_resolution TR " .
					"WHERE T.ticket_id = '$ticket_id' AND T.project_id = '$project_id' " .
					"AND T.created_by = M.id " .
					"AND T.assigned_to = M2.id " .
					"AND T.ticket_status = TS.status_id " .
					"AND T.ticket_priority = TP.priority_id " .
					"AND T.ticket_type = TT.type_id " .
					"AND T.resolution_id = TR.resolution_id ";

		$query = $this->db->query($sqlQuery);
		return $query->row();
	}

	function getAssignedTickets($user_id) {

		$sqlQuery = "SELECT T.ticket_id as 'ticket_id', T.title, T.project_id, T.description, TS.name as 'status', " .
					"P.name as 'project_name' " .
					"FROM tickets T, ticket_status TS, projects P " .
					"WHERE T.assigned_to = '$user_id' " .
					"AND T.ticket_status != '2' " . // only get non-closed tickets
					"AND T.project_id = P.project_id " .
					"AND T.ticket_status = TS.status_id " .
					"ORDER BY T.last_updated DESC ";

		$query = $this->db->query($sqlQuery);
		return $query->result();
	}

	function getTicketNotes($ticket_id) {

		$sqlQuery = "SELECT TN.ticket_note_id as note_id, TN.date_created, TN.description, " .
					"M.first_name as 'created_by', TNT.name as 'note_type' " .
					"FROM ticket_notes TN, meta M, ticket_note_types TNT " .
					"WHERE TN.ticket_id = '$ticket_id' " .
					"AND TN.created_by = M.id " .
					"AND TN.ticket_note_type = TNT.ticket_note_type_id " .
					"ORDER BY TN.date_created ";

		$query = $this->db->query($sqlQuery);
		return $query->result();
	}

	/**
	 * This function is called when a new note is created for an existing
	 * ticket.  The user has the option of creating two types of notes.
	 * The first kind of note is a 'General Note' in which the none of the
	 * properties of a ticket (i.e. status, title, priority, etc) didn't change.
	 * The second kind of note is a 'Modified Ticket' note where the user actually
	 * changed one or more of the ticket properties.
	 */
	function newNote() {

		// We first will check to see what kind of a note the user
		// is creating.  If a change to the ticket has been made
		// then the type of note will be handled by the 'Change Ticket'
		// section. If it's just a simple note then the 'Add Note'
		// section will handle a simple note (i.e. no changes to the
		// ticket).
		$action = $this->input->post("submit");

		// Getting the ticket_id here because it's needed when adding
		// a general note below.  By not having it in here, I was getting
		// a nasty bug so make sure that you don't ever move this anywhere
		// else or mayhem will insue!
		$ticket_id = $this->input->post("ticket_id");

		// This is going to be used to see if the ticket has been
		// closed or re-opened.  I have added these two new ticket
		// note types so that later on I can use it for reporting
		// purposes of this application. The default is 'Modified Ticket'
		// which is indicated by the number 2 below.
		$ticket_note_type = 2;

		if($action == "Change Ticket") {

			$change_message = "<div class=\"change_message\"><ul>";

			// We need to get the current ticket information that
			// 'could be' changed first. I am going to use this array
			// to find out 'what has changed', if anything at all.
			$query = $this->db->query("SELECT assigned_to, ticket_status, resolution_id, ticket_priority, ticket_type, title FROM tickets WHERE ticket_id = $ticket_id");
			$current_ticket_info = $query->row_array();

			// ticket type
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

			// ticket priority
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

			// ticket status
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

				// We now check to see if the user has decided to close this ticket
				// If so then we need to set the 'closed_by' field to the current
				// user that has closed this ticket.
				// Note: the '2' referes to the 'closed' ticket status id.
				if($new_status_to_id == 2) {

					// The current user id that closed this ticket
					// will be used to update the 'closed_by' field
					// on the tickets table.
					$closed_by =  $this->ion_auth->get_user()->id;

					// The ticket is being closed and we have to set the
					// ticket note to reflect this
					$ticket_note_type = 3;
				}

				// For closed tickets: If a user decides to re-open a ticket
				// this is handled here.
				if($new_status_to_id == 6) {
					$ticket_reopened = TRUE;

					// Because the ticket has been re-opened we have to set 
					// the appriate value to show this in the note
					$ticket_note_type = 4;
				}
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

			// At this point we have generated the whole change message
			// therefore we must close down the html code
			$change_message .= "</ul></div>";

			$data = array(
					'assigned_to' => $new_assigned_to_id,
					'ticket_status' => $new_status_to_id,
					'resolution_id' => $new_resolution_to_id,
					'ticket_priority' => $new_priority_to_id,
					'ticket_type' => $new_type_to_id,
					'last_updated' => date("Y-m-d H:i:s"),
					'latest_note_date' => date("Y-m-d H:i:s"),
					'title' => $new_title_name
				);

			// Update the tickets table fields first, but we have to check to see
			// if the resolution status has changed.  IF so, then the variable
			// $date_resolved (which is set to the current date) is set
			// We therefore have to include this date in the update of the
			// tickets table.  If the $date_resolved variable is not set, then
			// this means we have not changed the resoltuion of this ticket and
			// therefore the resolution_date on the tickets table will remain null
			if(isset($date_resolved)) {
				$data['date_resolved'] = $date_resolved;
			}

			// This is where we have to check to see if the user has decided
			// to close this ticket, if this evaluates to true then we add
			// the 'closed_by' column with the current user_id to update this
			// column on the tickets table.
			if(isset($closed_by)) {
				$data['closed_by'] = $closed_by;
			}

			if(isset($ticket_reopened)) {
				$data['date_resolved'] = NULL;
				$data['closed_by'] = NULL;
			}

			$this->db->where('ticket_id', $ticket_id);
			$this->db->update("tickets", $data);

			// Adding a new note to the ticket
			$data2 = array(
				'ticket_id' => $ticket_id,
				'created_by' => $this->ion_auth->get_user()->id,
				'date_created' => date("Y-m-d H:i:s"),
				'ticket_note_type' => $ticket_note_type,
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

			// We need to set the last_note_update on the tickets table
			// to reflect what date the latest note was created on
			$data = array('latest_note_date' => date("Y-m-d H:i:s"));
			$this->db->where('ticket_id', $ticket_id);
			$this->db->update('tickets', $data);
		}
	}
}
