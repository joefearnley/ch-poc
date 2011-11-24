<?php

class Geocode extends Controller {

	private static $api_key = 'ABQIAAAAUZYgUPLwYaI0Iah8NfClxhQgLhGGP4qP2PANj84q0rxlxpERHRRVoqQJ8VH-mXD5yeYLlohqG6_zYw';
	private $op = 'json';
	private $encoding = 'utf';
	private $sensor = 'false';

	/**
	 * Contructor for the home controller.
	 *
	 * Loads libraries need for class.
	 */
	function __construct()
	{
		parent::Controller();
		$this->load->library('curl');
	}

	/**
	 * Using google's geocode service, fetch the lat/long
	 * for all house records in the database.
	 *
	 * @return void
	 */
	public function update_all_houses() {

		$this->load->model('house_model');
		$houses = $this->house_model->get_all_houses();

		if ($houses->num_rows() > 0) { 

			foreach ($houses->result() as $house) {

				$json = $long = $lat = null;
				$location_query = $this->build_location_query($house);

				$url = $this->get_base_url() . $location_query;
				$json = json_decode($this->curl->simple_get($url));

				if(isset($json->Placemark)) {
					$long = $json->Placemark[0]->Point->coordinates[0];
					$lat = $json->Placemark[0]->Point->coordinates[1];
				}

				if($lat !=null && $long != null) {
					echo "Updating houseid " . $house->id . " | " . $house->address_street ." | ";
					echo "(".$lat.",".$long.")" . "<br />";
					$this->house_model->update_lat_long($house->id, $lat, $long);
				}
			}
		} else {
			echo 'error: no data found';
		}
	}

	/**
	 * Using google's geocode service, fetch the lat/long
	 * for all school records in the database.
	 *
	 * @return void
	 */
	public function update_all_schools() {
		$this->load->model('school_model');
		$schools = $this->school_model->get_all_schools();

		if ($schools->num_rows() > 0) { 
			foreach ($schools->result() as $school) {
				$json = $long = $lat = null;
				$location_query = $this->build_location_query($school);
  
				$url = $this->get_base_url() . $location_query;
				$json = json_decode($this->curl->simple_get($url));

				if(isset($json->Placemark)) {
					$long = $json->Placemark[0]->Point->coordinates[0];
					$lat = $json->Placemark[0]->Point->coordinates[1];
					
					echo "Updating school id " . $school->id . " | " . $school->address_street ." | ";
					echo "(".$lat.",".$long.")" . "<br />";

					$this->school_model->update_lat_long($school->id, $lat, $long);	
				}
			}
		} else {
			echo 'error: no data found';
		}
	}

	/**
	 * Google's geocode service requires (i'm asssssuming here) a '+' between
	 * the section of an address. For example: 123+Main+St,......
	 *
	 * @param string $str String to modify.
	 * @return string Modified string.
	 */
	protected function replace_spaces($str) {
		return str_replace(' ', '+', $str);
	}

	/**
	 * Build the address string. 
	 *
	 * @param object $str String to modify.
	 * @return string Query string. 
	 */
	protected function build_location_query($record) {
		return '&q='.$this->replace_spaces($record->address_street).',+'. 
							$this->replace_spaces($record->address_city).',+'. 
							$this->replace_spaces($record->address_state);
	}

	/**
	 * Build the base URL for the geocode service. 
	 *
	 * @return string $url. 
	 */
	protected function get_base_url() {

		$url = 'http://maps.google.com/maps/geo?';
		$url.= '&output=' . $this->op = 'json';
		$url.= '&oe=' . $this->encoding;
		$url.= '&sensor=' . $this->sensor;
		return $url;
	
	}
}

/* End of file geocode.php */
/* Location: ./system/application/controllers/geocode.php */
