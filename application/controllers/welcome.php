<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
        $this->load->database();	
	}
	
	function index()
	{
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
