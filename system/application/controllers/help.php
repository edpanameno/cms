<?php

class Help extends Controller {

	function Help()
	{
		parent::Controller();
	}
	
	function index()
	{
		$data['title'] = $this->config->item("app_name") . " - Help";
		$this->load->view('help/index', $data);
	}
}
