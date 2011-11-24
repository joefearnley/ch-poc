<?php

class School_data extends Controller {

	/**
	 * Contructor for the school_data controller.
	 */
	function __construct()
	{
		parent::Controller();	
	}


	/**
	 * Fetch a single record from the school and 
	 * print the json version of it to the response.
	 *
	 * @param	string	The id of the school (school_id)
	 * @return void
	 */
	function get($sid = '') {

		if(trim($sid) == '') {
			echo '{ "error": "no school given" }';
		} else {
			$this->load->model('school_model');
			$school = $this->school_model->get_school_record($sid);
			
			if ($school->num_rows() > 0) {
				echo json_encode($school->result_array());
			} else {
				echo '{ "error": "no school found" }';
			}
		}
	}
}

/* End of file school_data.php */
/* Location: ./system/application/controllers/school_data.php */
