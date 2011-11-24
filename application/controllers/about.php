<?php

class About extends Controller {

	/**
	 * Contructor for the about controller.
	 *
	 * Loads needed libs.
	 */
	function __construct()
	{
		parent::Controller();
	}

	/**
	 * Default function
	 *
	 * Load the about page view.
	 * @return void
	 */
	function index() {
		$data['content'] = 'about_view';
		$data['page'] = 'about';
		$this->load->view('include/template', $data);
	}
}

/* End of file about.php */
/* Location: ./system/application/controllers/about.php */
