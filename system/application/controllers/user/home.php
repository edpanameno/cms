<?php

class Home extends Controller {

	function Home() {
		parent::Controller();
		$this->load->library('session');

		$this->load->helper('url');
		if(!$this->ion_auth->logged_in()) {
			redirect('login');
		}
	}

	function index() {
		$this->load->helper('url');
		$this->load->helper('form');

		// In order for the user to access this page, they
		// will need to be logged in.
		if (!$this->ion_auth->logged_in()) {
			redirect("login", "refresh");
		}
		else {
			$data['title'] = $this->config->item("app_name") . " - User";
			$this->load->view('user/index', $data);
		}
	}

	function change_info() {
		$user_id = $this->ion_auth->get_user()->id;
		$data = array('first_name' => $this->input->post('first_name'),
					  'last_name' => $this->input->post('last_name'),
					  'email' => $this->input->post('email'),
					  'phone' => $this->input->post('phone'));

		$changed = $this->ion_auth->update_user($user_id, $data);

		if($changed) {
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('user', 'refresh');
		}
		else {
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('user', 'refresh');
		}
	}

	function change_password() {
		if(!$this->ion_auth->logged_in()) {
			redirect("login", "refresh");
		}

		$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));
		$change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));

		// check to see if the password was successfully changed
		if($change) {
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('user', 'refresh');
		}
		else {
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('user', 'refresh');
		}
	}
}
