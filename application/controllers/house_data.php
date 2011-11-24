<?php

class House_data extends Controller {

	/**
	 *	Constructor for house data controller
	 */
	function __construct()
	{
		parent::Controller();
		$this->load->helper('url');
	}

	/**
	 * Fetch a list of house records, convert the result set
	 * to json, and print it to the reponse.
	 *
	 * @param $sid	
	 * @return void
	 */
	function get_houses_for_school($sid = '', $offset = 0) {
		$this->load->model('house_model');			
		$houses = $this->house_model->get_houses_for_school($sid);

		if($houses->num_rows() > 0) {
			echo json_encode($houses->result_array());
		} else {
			echo '{ "error": "no house found" }';
		}
	}
	
	/**
	 * Fetch a house record, convert the result set
	 * to json, and print it to the reponse.
	 *
	 * @param $hid
	 */
	function get_house($hid = '') {
		$this->load->model('house_model');			
		$houses = $this->house_model->get_house($hid);

		if($houses->num_rows() > 0) {
			echo json_encode($houses->result_array());
		} else {
			echo '{ "error": "no houses found" }';
		}
	}
}

/* End of file house_data.php */
/* Location: ./system/application/controllers/house_data.php */
