<?php

class Home extends Controller {

	function Home()
	{
		parent::Controller();
	}
	
	function index()
	{
		$data['title'] = $this->config->item("app_name") . " - Home";
		$this->load->view('home/index', $data);
	}
}
