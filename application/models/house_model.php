<?php

class House_model extends Model {

	 /**
	  * Constructor for the house model
	  */
	function __construct()
	{
		parent::Model();
	}
	
	/**
	 * Get the house records with the given school_id
	 *
	 * @param integer $sid id field to select on.
	 */
	function get_houses_for_school($sid) {
		return $this->db->get_where('house', array('school_id' => $sid));
	}

	/**
	 * Get a single house record.
	 *
	 * @param integer $hid id field to select on.
	 */
	function get_house($hid) {
		return $this->db->get_where('house', array('id' => $hid));
	}

	/**
	 * Get all of the records in the house table
	 *
	 * @return object
	 */
	function get_all_houses() {
		return $this->db->get('house');
	}

	/**
	 * Update the latitude and longitude fields for a given house record
	 *
	 * @param integer $house_id id (primary key) to match
	 * @param float $lat latitude
	 * @param float $long longitude
	 */
	function update_lat_long($house_id, $lat, $long) {
		$latlong = array(
			'latitude' => $lat,
			'longitude' => $long
		);

		$this->db->where('id', $house_id);
		$this->db->update('house', $latlong);
	}
}

/* End of file house_model.php */
/* Location: ./system/application/models/house_model.php */
