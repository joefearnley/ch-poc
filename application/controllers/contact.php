<?php

class Contact extends Controller {

	/**
	 * Contructor for the contact controller.
	 *
	 * Load needed libs.
	 */
	function __construct()
	{
		parent::Controller();
	}

	/**
	 * Default function
	 *
	 * Load the contact page view.
	 * @return void
	 */
	function index() {
		$data['content'] = 'contact_view';
		$data['page'] = 'contact';
		$this->load->view('include/template', $data);
	}
}

/* End of file contact.php */
/* Location: ./system/application/controllers/contact.php */
