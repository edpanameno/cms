<?php

class Home extends Controller {

	function Home() {
		parent::Controller();
	}
	
	function index() {

		$data['title'] = $this->config->item("app_name") . " - Home";

		// We need to make sure that we only get the tickets for those
		// users that are logged into the application
		if($this->ion_auth->logged_in()) {

			$this->load->helper("url"); // for the anchor
			$this->load->helper('inflector'); // To use the humanize function

			$this->load->model("projects/ticket_model");
			$data['my_tickets'] = $this->ticket_model->getAssignedTickets($this->ion_auth->get_user()->id);
		}

		$this->load->view('home/index', $data);
	}
}
