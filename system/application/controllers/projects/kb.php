<?php

class Kb extends Controller {

	function Kb() {
		parent::Controller();

		$this->load->helper('url');
		$this->load->helper('inflector'); // for humanize

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

			$data["project_id"] = $project_id;
			$data['url_project_name'] = $project_name;
			$data['project_name'] = $humanized_project_name;
			$data['title'] = $this->config->item("app_name") . " - $humanized_project_name";
			$data['kb_description'] = 'This is a sample kb description text';
			$this->load->view('projects/kb_home_view', $data);
		}
	}
}
