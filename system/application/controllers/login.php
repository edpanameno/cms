<?php

class Login extends Controller {

	function Login() {
		parent::Controller();
	}

	function index() {

		$this->load->library('Form_validation');
		$this->load->helper('url');
		$this->load->helper('form');
		
		// This is the function that will build the login page
		// that the user will be shown when they try to login
		$this->_login();
	}

	function _login() {

		$this->load->library('session');

		if (!$this->ion_auth->logged_in()){

			$val = $this->form_validation;

			$val->set_rules('username', 'Username', 'trim|required|xss_clean');
			$val->set_rules('password', 'Password', 'trim|required|xss_clean');
			$val->set_rules('remember', 'Remember me', 'integer');

			if ($val->run() AND $this->ion_auth->login($val->set_value('username'), $val->set_value('password'), $val->set_value('remember'))) {
				redirect('', 'location');
			}
			else {

				// A unsuccessful login has occurred either because the user has
				// entered wrong credentials or has not filled in one of the 3
				// required fields (i.e. username, password and remember field)
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$this->load->view('login/index', 'refresh');
			}
		}
		else {
		
			// This was the original location that the user was being
			// redirected to if they tried to login once more ... I am 
			// keeping this here for future reference (in case I ever 
			// need to use it).
			//$this->load->view($this->ion_auth->logged_in_view, $data);
			
			// The user is already logged in and therefore the user should
			// just be re-directed to the home page of the application
			redirect('', 'location');
		}
	}
}
