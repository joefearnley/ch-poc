<?php

class Map extends Controller {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function __construct()
	{
		parent::Controller();
		$this->load->library('pagination');
	}

	/**
	 * Defualt method called on /map. 
	 *
	 * Get house data from database and send it to the map view.
	 */
	function index($offset = 0)
	{
	
		$school_id = $this->session->userdata('school_id');

		if(trim($school_id) == '') {
			$data['content'] = 'map_view_empty';
		} else {
			$this->load->model('house_model');
			$data['houses'] = $this->house_model->get_houses_for_school($school_id);
			$data['content'] = 'map_view';
			$data['school_id'] = $school_id;
			$this->reset_school_id($school_id);
		}
		
		if(isset($_GET['per_page'])) {
			print $_GET['per_page'];
			die();
		}
		
/*
		$config['base_url'] = '/ch/map/page/';
		$config['total_rows'] = $this->house_model->get_all_houses()->num_rows();
		$config['per_page'] = $offset + 1;
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
*/
		$data['page'] = '';
		$this->load->view('include/template', $data);
	}	

	/**
	 * Reset the school id incase the page refreshes. In that case, it should 
	 * reset the value on refresh. There has to be a better way to do this.
	 *
	 * @param int $school_id ID of the school sent from home form. 
	 */
	function reset_school_id($school_id)
	{
		$this->session->set_userdata('school_id', $school_id);
	}


	/**
	 * This function is called for pagination. It redirects back to the 
	 * index function with an offset.
	 *
	 * @param int $offset Offset for pagination. 
	 */
	function page($offset = 0)
	{
		$this->index($offset);
	}
}

/* End of file map.php */
/* Location: ./system/application/controllers/map.php */
