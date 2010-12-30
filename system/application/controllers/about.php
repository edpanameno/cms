<?php

class About extends Controller {

	function About()
	{
		parent::Controller();
	}
	
	function index()
	{
		$data['title'] = $this->config->item('app_name') . " - About";
		$this->load->view('about/index', $data);
	}
}
