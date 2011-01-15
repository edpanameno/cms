<?php

/**
 * This class will only be used to when creating a new ticket
 * and we need to get the information that is needed to create
 * a ticket (i.e. priority, status and ticket type)
 */
class Ticket_type_info_model extends Model {

	function Ticket_type_info_model() {
		parent::Model();
	}

	function getPriorities() {

		$query_results = array();
		$this->db->select('priority_id, name');
		$this->db->where('is_active =', 1);
		$this->db->from('ticket_priority');
		$query = $this->db->get();

		foreach($query->result_array() as $row) {
			$query_results[$row['priority_id']] = $row['name'];
		}

		return $query_results;
	}

	function getTypes() {

		$query_results = array();
		$this->db->select('type_id, name');
		$this->db->where('is_active =', 1);
		$this->db->from('ticket_types');
		$query = $this->db->get();

		foreach($query->result_array() as $row) {
			$query_results[$row['type_id']] = $row['name'];
		}

		return $query_results;
	}

	function getStatuses() {

		$query_results = array();
		$this->db->select('status_id, name');
		$this->db->where('is_active =', 1);
		$this->db->from('ticket_status');
		$query = $this->db->get();

		foreach($query->result_array() as $row) {
			$query_results[$row['status_id']] = $row['name'];
		}

		return $query_results;
	}

	function getActiveUsers() {

		$query_results = array();
		$this->db->select('id, username');
		$this->db->where('active = ', 1);
		$this->db->from('users');
		$query = $this->db->get();

		foreach($query->result_array() as $row) {
			$query_results[$row['id']] = $row['username'];
		}

		return $query_results;
	}
}
