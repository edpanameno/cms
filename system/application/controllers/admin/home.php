<?php

class Home extends Controller {

	function Home() {

		parent::Controller();

		$data['page'] = "Admin";

		$this->load->helper("url");
		$this->load->library('session');

		// Only admins will be able to have access to
		// this page.
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');
		}
		elseif ($this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
			redirect("", "refresh");
		}
	}

	function index() {

		$this->load->helper('url');
		$this->load->helper('date');
		$data['title'] = $this->config->item("app_name") . " - Admin";
		$data['active_users'] = $this->ion_auth->get_active_users();
		$data['non_active_users'] = $this->ion_auth->get_inactive_users();
		$this->load->view('admin/index', $data);
	}

	function create_user() {

		$this->load->library('form_validation');
		$this->load->helper('url');

		$this->form_validation->set_rules('firstname', 'First Name', 'required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$data['groups'] = $this->ion_auth->get_groups();

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/create_user_view', $data);
		}
		else {

			if($this->ion_auth->username_check($this->input->post('username'))) {

				// the username passed already exists and therefore we have to
				// let the user know about this
				$this->session->set_flashdata('message', 'The \'' . $this->input->post('username') . '\' username is already registered. Please use a different username.');
				redirect('admin/user/create', 'refresh');
			}
			else {

				// I had to read the source code to see that you can
				// pass the group_id in the additional data array ... not
				// doing it this way made the application complain that no
				// group_id/name was passed.
				$additional_data = array('first_name' => $this->input->post('firstname'),
									 	 'last_name' => $this->input->post('lastname'),
										 'group_id' => $this->input->post('group_id'));

				$this->ion_auth->register($this->input->post('username'),
									  $this->input->post('password'),
									  $this->input->post('email'),
									  $additional_data);

				redirect('admin', 'location');
			}
		}
	}

	function deactivate_user($user_id) {

		// only admins can delete users
		if(!$this->ion_auth->is_admin()) {
			redirect('/admin', 'refresh');
		}

		if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$this->ion_auth->deactivate($user_id);
			$this->session->set_flashdata('message', 'The account \'' . $this->ion_auth->get_user($user_id)->username . '\' has been deactivated.');
			redirect('/admin', 'refresh');
		}
	}

	function activate_user($user_id) {

		// only admins can activate users
		if(!$this->ion_auth->is_admin()) {
			redirect('/admin', 'refresh');
		}

		if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$this->ion_auth->activate($user_id);
			$this->session->set_flashdata('message', 'The account \'' . $this->ion_auth->get_user($user_id)->username . '\' has been activated.');
			redirect('/admin', 'refresh');
		}
	}

	function edit_user($user_name) {

		$this->load->helper('form');

		$user = $this->ion_auth->get_user($user_name);
		$data['user'] = $user;
		$data['title'] = $this->config->item("app_name") . " - Editing '$user->username'";
		$data['groups'] = $this->ion_auth->get_groups();
		$this->load->view('admin/edit_user_view', $data);
	}

	function reset_password() {

		$this->load->library('session');
		$user_id = $this->input->post('user_id');
		$user_name = $this->ion_auth->get_user($user_id)->username;
		$old_password = $this->ion_auth->get_user($user_id)->password;
		$new_password = $this->input->post('new_password');

		// The change password method takes the username as the first parameter
		// as opposed to the user id.
		$this->ion_auth->change_password($user_name, $old_password, $new_password);
		$this->session->set_flashdata('message', 'Password Successfully Reset for \'' . $user_name . '\'.');
		redirect('admin', 'refresh');
	}

	function reset_group() {

		$this->load->library('session');

		$user_id = $this->input->post('user_id');
		$new_group_id = $this->input->post('group_id');
		$data = array('group_id' => $new_group_id);

		$this->db->where('id', $user_id);
		$this->db->update('users', $data);

		$this->session->set_flashdata('message', "Group Changed Successfully!");
		redirect('admin', 'refresh');
	}
}