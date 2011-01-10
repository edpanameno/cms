<?php

class Trac extends Controller {

	function Trac() {
		parent::Controller();

		$this->load->helper('url');
		$this->load->helper('inflector'); // To use the humanize function
		$this->load->helper('form');

		if(!$this->ion_auth->logged_in()) {
			redirect('login');
		}
	}

	function index($project_id = '', $project_name = '') {
		
		if(empty($project_id) && empty($project_name)) {
			echo 'project_name is empty';
		}
		else {

			$humanized_project_name = humanize($project_name);
			$data['title'] = $this->config->item("app_name") . " - $humanized_project_name";
			$data['project_id' ] = $project_id;
			$data['project_name'] = $humanized_project_name;
			$this->load->model('projects/ticket_model');
			$data['tickets'] = $this->ticket_model->getTicketsByProjectId($project_id);
			$this->load->view('projects/trac_home_view', $data);
		}
	}

	function view_ticket($ticket_id, $project_name) {

		$humanized_project_name = humanize($project_name);
		$data['title'] = $this->config->item("app_name") . " - " . $humanized_project_name . ' - Ticket #' . $ticket_id;

		$this->load->model('projects/ticket_model');
		$data['ticket'] = $this->ticket_model->getTicketInfo($ticket_id);
		//$data['notes'] = ;
		//$data['attachements'] = ;

		// Will be used to fill out the drop down lists for changing
		// the ticket
		$this->load->model("projects/ticket_type_info_model");
		$data['ticket_statuses'] = $this->ticket_type_info_model->getStatuses();
		$data['ticket_priorities'] = $this->ticket_type_info_model->getPriorities();
		$data['ticket_types'] = $this->ticket_type_info_model->getTypes();


		$data['project_name'] = $humanized_project_name;
		$this->load->view('projects/trac_ticket_view', $data);
	}

	function new_ticket($project_id = '', $project_name = '') {

		$this->load->library("Form_validation");
		$this->form_validation->set_error_delimiters('<span class="validation_error_msg">','</span>');
		$this->form_validation->set_rules('ticket_title', 'Title', 'required');
		$this->form_validation->set_rules('text_description', 'Description', 'required');

		$humanized_project_name = humanize($project_name);
		$data['unhumanized_project_name'] = $project_name;
		$data['project_name'] = $humanized_project_name;
		$data['project_id'] = $project_id;

		$this->load->model("projects/ticket_type_info_model");
		$data['ticket_statuses'] = $this->ticket_type_info_model->getStatuses();
		$data['ticket_priorities'] = $this->ticket_type_info_model->getPriorities();
		$data['ticket_types'] = $this->ticket_type_info_model->getTypes();

		$data['title'] = $this->config->item("app_name") . " - $humanized_project_name - New Ticket";

		if($this->form_validation->run() == FALSE) {
			$this->load->view('projects/create_ticket_view', $data);
		}
		else {
			$this->load->model("projects/ticket_model");
			$newly_created_ticket_id = $this->ticket_model->create();

			// Currently, I am redirecting the user to the trac home page
			// of this project.  I may however change this so that I will be
			// able to just re-direct the user to view the newly created ticket
			redirect("projects/$project_id/$project_name/trac/$newly_created_ticket_id", '');
		}
	}

	function new_ticket_note() {

		$this->load->model('projects/ticket_model');
		$this->ticket_model->newNote();

		// where should we re-direct the user?  Or should they
		// remain in the view ticket window?
	}
}
