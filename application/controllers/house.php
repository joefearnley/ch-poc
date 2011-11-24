<?php

class House extends Controller {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function __construct()
	{
		parent::Controller();
	}

	/**
	 * Defualt method called on /house. 
	 */
	function index()
	{
	}

	/**
	 * Fetch a house record to be used in the modal view.
	 * 
	 * @param int $hid ID of the house record.
	 * @return void
	 */	
	function modal($hid = '') {
		$this->load->model('house_model');
		$house = $this->house_model->get_house($hid);

		if($house->num_rows() > 0) {
			$result = $house->result();
			$data['house'] = $result[0];
			$this->load->view('house_modal_view', $data);
		} else {
			echo '{ "No house information found." }';
		}
	}
}

/* End of file house.php */
/* Location: ./system/application/controllers/house.php */
