<?php

class Home extends Controller {

	/**
	 * Contructor for the home controller.
	 *
	 * Loads needed libs.
	 */
	function __construct()
	{
		parent::Controller();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	/**
	 *	Default function
	 *
	 *	Set form rules and load the home screen. If form validates,
	 *	redirect to the map.
	 */
	function index()
	{
		// set rules
		$this->set_form_rules();

		// validate
		if ($this->form_validation->run() == FALSE) {
			$this->load->model('school_model');
			$data['schools'] = $this->school_model->get_all_schools();
			$data['content'] = 'home_form';
			$data['page'] = 'home';
			$this->load->view('include/template', $data);
		} else {	
			$this->session->set_userdata('school_id', $this->input->post('schoolid'));
			redirect('map');
		}
	}

	/**
	 *	Set form validation rules. I created a seperate method incase this list gets bigger.
	 */
	function set_form_rules() {
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Please choose a school');
		$this->form_validation->set_rules('schoolid', 'School', 'required');
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
