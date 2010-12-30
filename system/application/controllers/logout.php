<?php

class Logout extends Controller {

	function Logout() {
		parent::Controller();
		$this->load->helper('url');
		if(!$this->ion_auth->logged_in()) {
			redirect('login');
		}
	}

	function index() {
		$this->load->helper('url');
		$this->ion_auth->logout();
		redirect('', 'refresh');
	}
}