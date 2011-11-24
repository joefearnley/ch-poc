/**
 *
 * @author:	joe fearnley
 * @date:	08.19.09
 * @file:	map.js
 *
 * This file contains the javascript for the map.
 */

$(document).ready(function() {
	initialize();

	$("a.iframe").live("click", function() {
		$(this).fancybox({ 'showCloseButton': true });
		return false;
	});

	$("#slide-left").click(function() { 
		$("#houselist").hide("slow"); 
		$(this).hide();
		$("#slide-right").show();
	});
	
	$("#slide-right").click(function() { 
		$("#houselist").show("slow"); 
		$("#slide-left").show();
		$(this).hide();
	});

	$(".house-thumbnail").click(function() {
		openWindow($(this).attr("id"));
	});
});


/**
 * Open a marker window over one of the houses.
 *
 * @param houseIf - id of house record
 */
function openWindow(houseId) {
	var map = GoogleMap.getInstance().getMap();
	$.getJSON("house_data/get_house/" + houseId, function(houses) {
		var house = houses[0];
		if(house.error == '' || typeof(house.error) == 'undefined') {
			var latLng = new google.maps.LatLng(house.latitude, house.longitude);
			var infoWindow = map.accessInfoWindow();
			infoWindow.setOptions({
				content: getHouseHtml(house),
				position: latLng,
				pixelOffset: new google.maps.Size(0, -35)
			});
			infoWindow.open(map);
			map.panTo(latLng);
		} else {
			logError(house.error);
		}
	});
}


/**
 * Initialize the map. Load the API and call another
 * method to create the map object.
 */
function initialize() {
	google.load("maps", "3",  {
		callback: initializeMap, 
		other_params: "sensor=false"
	});
}

/**
 * Create the opts for the main map. Set the default lat/long.
 */
function getDefaultMapOpts() {
	var latlng = new google.maps.LatLng(42.284754, -85.61048);
	var opts = {
		zoom: 14,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		key: "ABQIAAAAUZYgUPLwYaI0Iah8NfClxhQgLhGGP4qP2PANj84q0rxlxpERHRRVoqQJ8VH-mXD5yeYLlohqG6_zYw"
	};
	return opts;
}

/**
 * Extend the map by adding an info window that can be
 * shared by each house marker.
 *
 * I was directed here by the maps V3 group:
 * http://koti.mbnet.fi/ojalesa/boundsbox/attachinfowindow.htm
 */
function createAttachInfoWindow() {

	/**
	 * attachInfoWindow() binds InfoWindow to a Marker 
	 * Creates InfoWindow instance if it does not exist already 
	 * @extends Marker
	 * @param InfoWindow options
	 * @author Esa 2009
	 */
	google.maps.Marker.prototype.attachInfoWindow = function (options) {

		var map_ = this.getMap();
		map_.bubble_ = map_.bubble_ || new google.maps.InfoWindow();

		google.maps.event.addListener(this, 'click', function () {
			map_.bubble_.setOptions(options);
			map_.bubble_.maxWidth
			map_.bubble_.open(map_, this);
		});

		map_.infoWindowClickShutter = map_.infoWindowClickShutter || 
			google.maps.event.addListener(map_, 'click', function () {
				map_.bubble_.close();
			});
	}

	/**
	 * accessInfoWindow()
	 * @extends Map
	 * @returns {InfoWindow} reference to the InfoWindow object instance
	 * Creates InfoWindow instance if it does not exist already 
	 * @author Esa 2009
	 */
	google.maps.Map.prototype.accessInfoWindow = function () {
		this.bubble_ = this.bubble_ || new google.maps.InfoWindow();
		return this.bubble_;
	}
}

/**
 * Create the map, cache the school ID, create the info window
 * for the house and plot the points for th school.
 */
function initializeMap() {

	// traversing the DOM more than once is not gnarley. 
	var schoolId = $("#school_id").html();

	// extend the map namespace to create a single infoWindow
	createAttachInfoWindow();

	// get the map object
	var map = GoogleMap.getInstance().getMap();

	// plot 'em!!
	plotHouses(schoolId, map);
//	plotSchool(schoolId, map);
}

/**
 * Make an ajax to the server to get the shool info then call another
 * method to plot the school marker.
 *
 * @param schoolId - ID of the school to use
 * @param map - the main map object
 */
function plotSchool(schoolId, map) {
	if(schoolId != 0) {
		$.getJSON("school_data/get/" + schoolId, function(schools) {
			if(schools.error == '' || typeof(schools.error) == 'undefined') {
				plotSchoolPoint(schools[0], map);
			} else {
				logError(schools.error);
			}
		});
	}
}

/**
 * Create a marker for the school and create an info window for it.
 *
 * @param schoo - school object
 * @param map - the main map object
 */
function plotSchoolPoint(school, map) {
	var latlng = new google.maps.LatLng(school.latitude, school.longitude);
	var marker = new google.maps.Marker({
		map: map, 
		position: latlng 
	});

	google.maps.event.addListener(marker, 'click', function() {  map.panTo(latlng);  });
	marker.attachInfoWindow({ 
		content: school.description, 
		maxWidth: 500
	});
}

/**
 * Make an ajax to the server to get the a list of houses.
 *
 * @param schoolId - ID of the school to use
 * @param map - the main map object
 */
function plotHouses(schoolId, map) {
	if(schoolId != 0) {
		$.getJSON("house_data/get_houses_for_school/" + schoolId, function(houses) {
			if(houses.error == '' || typeof(houses.error) == 'undefined') {
				$.each(houses, function(i,house) {
					plotHousePoint(house, map);
				});
			} else {
				logError(houses.error);
			}
		});
	}
}

/**
 * Plot a single house on the map. Log an error if one is encountered. 
 *
 * @param schoolId - ID of the school to use
 * @param map - the main map object
 */
function plotHouse(houseId) {
	$.getJSON("house_data/get_house/" + houseId, function(house) {
		if(house.error == '' || typeof(house.error) == 'undefined') {
			plotHousePoint(house, map);
		} else {
			logError(house.error);
		}
	});
}

/**
 * Create a marker for a house and create attach a info window to it.
 *
 * @param house - house object
 * @param map - the main map object
 */
function plotHousePoint(house, map) {

	var latlng = new google.maps.LatLng(house.latitude, house.longitude);
	var marker = new google.maps.Marker({
		map: map,
		position: latlng
	});

	google.maps.event.addListener(marker, 'click', function() {  map.panTo(latlng); });

	var houseHtml = getHouseHtml(house);
	marker.attachInfoWindow({ 
		content: houseHtml, 
		maxWidth: 500
	});
}

/**
 * Create a the html for a house info window.
 *
 * @param house - house object
 */
function getHouseHtml(house) {

	var html = '<div class="info-window">'+
		'<div class="house-image"><a class="iframe" href="house/modal/'+house.id+'"><img src="http://ch.joef.org/images/213_Burr_Oak.jpg" height="100" width="120" /></a></div>'+
		'<div class="house-info">'+
			'<div class="address"><a class="iframe" href="house/modal/'+house.id+'">'+house.address_street+'</a></div>'+
			'<div class="left-col">Rooms:<br />Bathrooms:<br />Price/Month:<br />Sq. Footage:</div>'+
			'<div class="right-col">'+
				Math.convertNumber(house.number_of_rooms)+'<br />'+
				Math.convertNumber(house.number_of_bath_rooms)+'<br />'+
				Math.convertRent(house.monthly_rent)+'<br />'+
				Math.convertNumber(house.square_footage)+
			'</div>'+
		'</div>'+
	'</div>';
	
	return html;
}



/**
 * Create a the html for a school info window.
 *
 * @param school -school object
 */
function getSchoolHtml(school) {
	var html = "<p>" + house.address_street + "<br /> monthly rent - " + house.monthy_rent + "</p>";
	return html;
}

/**
 * Convert Rent values
 *
 * @param  float   value in the database 
 * @return string  fomatted value
 */
Math.convertRent = function(value) {
	if(value == '0.00') {
		return 'N/A';
	} else {
		return '$' + Math.round(value);
	} 
}

/**
 * Convert Rent values
 *
 * @param  float   value in the database 
 * @return string  fomatted value
 */
Math.convertNumber = function(value) {
	if(value == 0 || isNaN(value)) {
		return 'N/A';
	} else {
		return Math.round(value);
	} 
}

/**
 * Singleton implement of a map object.
 */
var GoogleMap = (function() {
	var instance = null;
	function Constructor() {
		var mapOpts = getDefaultMapOpts();
		var map = new google.maps.Map(document.getElementById("map"), mapOpts);
		this.getMap = function() {
			return map;
		}
	}

	return new function() {
		this.getInstance = function() {
			if (instance == null) {
				instance = new Constructor();
				instance.constructor = null;
			}
			return instance;
		}
	}
})();