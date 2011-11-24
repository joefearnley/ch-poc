<?php

class House_edit extends Controller {

	function __construct()
	{
		parent::Controller();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		// set rules
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Please choose a school');
		$this->form_validation->set_rules('schoolid', 'School', 'required');

		// validate
		if ($this->form_validation->run() == FALSE) {

			$this->load->model('school_model');
			$data['schools'] = $this->school_model->get_school_listing();
			$data['content'] = 'home_form';
			$data['page'] = 'home';
			$this->load->view('include/template', $data);

		} else {

			$this->session->set_flashdata('school_id', $this->input->post('schoolid'));
			redirect('map');
		
		}
	}
}

/* End of file house_edit.php */
/* Location: ./system/application/controllers/house_edit.php */
