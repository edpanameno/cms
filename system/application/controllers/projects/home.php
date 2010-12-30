<?php

class Home extends Controller {

	function Home() {
		parent::Controller();

		$this->load->helper('url');

		// to humanize the project name
		$this->load->helper('inflector'); 

		if(!$this->ion_auth->logged_in()) {
			redirect('login');
		}
	}

	/**
	 * This will display the home page of the project.  The project_id
	 * will be used to search for and retrieve the project information
	 * from the database.  The project_name parameter is here ... for
	 * well, for reasons that are unknown to me at this time. Most likely
	 * I will remove this later on but for now this will exist.
	 */
	function index($project_id = '', $project_name = '') {

		// If no project id and name was passed to this function
		// then we will be displaying all of the projects.
		// This is the home page of the projects folder
		if(empty($project_name) || empty($project_name)) {

			$this->load->model('projects/project_model');
			$data['projects'] = $this->project_model->retrieveAllActive();

			$this->load->view('projects/index', $data);
		}
		else {

			$humanized_project_name = humanize($project_name);

			$this->load->model("projects/project_model");
			$data["project"] = $this->project_model->retrieve($project_id);

			$data['title'] = $this->config->item("app_name") . " - " . $humanized_project_name;
			$data['humanized_project_name'] = $humanized_project_name;
			$data['project_name'] = $project_name;
			$data['project_description'] = 'This is where the project description will go.';
			$this->load->view('projects/project_view', $data);
		}
	}

	/**
	 * Create a Project
	 */
	function create() {

		// Only users that are admins are able to create new projects
		// all other users are redirected to the home page.
		if(!$this->ion_auth->is_admin()) {
			redirect('home', 'refresh');
		}

		$this->load->library("Form_validation");
		$this->form_validation->set_error_delimiters('<span class="validation_error_msg">','</span>');

		$this->form_validation->set_rules('project_name', 'Name', 'required');
		$this->form_validation->set_rules('text_description', 'Description', 'required');

		$this->load->model('projects/language_model');
		$data['languages'] = $this->language_model->getAllActive();

		if($this->form_validation->run() == FALSE) {
			$this->load->view('projects/create_project_view', $data);
		}
		else {
			$this->load->model('projects/project_model');
			$this->project_model->create();
			redirect('projects', 'refresh');
		}
	}
}
