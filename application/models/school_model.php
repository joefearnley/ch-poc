<?php

class School_model extends Model {

	/**
	 *	Contructor for the school model.
	 */
	function __construct()
	{
		parent::Model();	
	}

	/**
	 *	Get all of the records of from the school table.
	 *
	 * 	@return object
	 */
	function get_all_schools() {
		return $this->db->get('school');
	}

	/**
	 *	Get an individual record from the school table.
	 *	
	 *	@param integer $sid id field to lookup.
	 *	@return object
	 */
	function get_school_record($sid) {
		return $this->db->get_where('school', array('id' => $sid));
	}

	/**
	 *	Update the latitude and longitude fields for a given school record
	 *
	 *	@param integer $school_id id (primary key) to match
	 *	@param float $lat latitude
	 *	@param float $long longitude
	 */
	function update_lat_long($school_id, $lat, $long) {
		$latlong = array(
			'latitude' => $lat,
			'longitude' => $long
		);

		$this->db->where('id', $school_id);
		$this->db->update('school', $latlong);
	}
}

/* End of file school_model.php */
/* Location: ./system/application/models/school_model.php */
