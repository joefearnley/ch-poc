/**
 *
 * @author:	joe fearnley
 * @date:	08.19.09
 * @file:	map.js
 *
 * This file contains the javascript for college housing map.
 */

$(document).ready(function() { 
	init();
});

function getMap() {
	return new google.maps.Map(document.getElementById("map"));
}

function init() {

	google.load("maps", "3",  {
		callback: initMap, 
		other_params:"sensor=false",
		key: "ABQIAAAAUZYgUPLwYaI0Iah8NfClxhQgLhGGP4qP2PANj84q0rxlxpERHRRVoqQJ8VH-mXD5yeYLlohqG6_zYw"
	});
}

function initMap() {

	// I heard traversing the DOM more than once is not gnarley. 
	var schoolId = $("#school_id").html();

	var mapOpts = getDefaultMapOpts();
	var map =  new google.maps.Map(document.getElementById("map"), mapOpts);

	//plotHouses(schoolId, map);
	plotSchool(schoolId, map);
}


function getDefaultMapOpts() {

	var latlng = new google.maps.LatLng(42.284754, -85.61048);

	var opts = {
		zoom: 13,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	return opts;
}

function plotSchool(schoolId, map) {
	
	if(schoolId!=0) {
		$.getJSON("school_data/get/" + schoolId, function(schools) {

			var school = schools[0];
			var address = school.address_street + " " + 
							school.address_city + " " + 
							school.address_state + " " + 
							school.address_zip;
			var html = school.description;
			plotSchoolPoint(address, html, map);
		});
	}
}

function plotHouses(schoolId, map) {

	if(schoolId!=0) {
		$.getJSON("house_data/get/" + schoolId, function(houses) {

			// loop through results and plot
			$.each(houses, function(i,house) {
				var address = house.address_street + " " + 
								house.address_city + " " + 
								house.address_state;
				var html = "";
				plotHousePoint(address, html, map);
			});
		});
	}
}

function plotHousePoint(address, html, map) {

	var geocoder = new GClientGeocoder();

	geocoder.getLatLng(
		address,
		function(point) {
			if (!point) {
				log(address + " not found");
				return true;
			} else {
				var marker = new GMarker(point);
				map.addOverlay(marker);
			}
		});
}

function plotSchoolPoint(address, html, map) {

	log("getting geocoder");

	var geocoder = new GClientGeocoder();
	
	log("got geocoder");

	geocoder.geocode(
		address,
		function(point) {
			if (!point) {
				log(address + " not found");
			} else {
				map.setCenter(point, 13);
				var marker = new GMarker(point);
				map.addOverlay(marker);
				marker.openInfoWindowHtml(html);
			}
		});
}

// generic plot point for fall back
function plotPoint(address, html, map) {

	var geocoder = new GClientGeocoder();

	geocoder.getLatLng(
		address,
		function(point) {
			if (!point) {
				log(address + " not found");
				return true;
			} else {
				map.setCenter(point, 13);
				var marker = new GMarker(point);
				map.addOverlay(marker);
			}
		});
}

function loadMap(latitude, longitude, houseId) {
	var map = new GMap2(document.getElementById("map"));	
	var point = new GLatLng(latitude, longitude);
	var marker = new GMarker(point);

	setMapDefaults(map, point)
	createMarker(map, marker, point);
	createMarkerTabs(marker, houseId);
}

function setMapDefaults(map, point) {
	map.enableGoogleBar();
	map.enableDragging();
	map.setCenter(point, 15);
}

function createMarker(map, marker, point) {
	var offset = getInfoWindowOffset(marker);
	map.addOverlay(marker);	
}

function createMarkerTabs(marker, houseId) {
	var tabs = [];
	tabs.push(new GInfoWindowTab("House", getHouseImage(houseId)));
	tabs.push(new GInfoWindowTab("Details", getHouseData(houseId)));
	marker.openInfoWindowTabsHtml(tabs);
}

function getInfoWindowOffset(marker) {
	var iwAnchor = marker.getIcon().infoWindowAnchor;
	var iconAnchor = marker.getIcon().iconAnchor;
	var offset = new GSize(iwAnchor.x-iconAnchor.x,iwAnchor.y-iconAnchor.y);
	return offset;
}

function getHouseDataAjax(houseId) {
	
	// make ajax call to database to get house record
	
	// create html (possibly in ajax call_)

	// return
}

function getHouseData(houseId) {
	
	var html = "";

	if(houseId == 0) {
		html += "<table class='maptab'>";
		html += "<tr><td colspan='2' class='head'>231 Burr Oak</th></tr>";
		html += "<tr><td>Rooms:</td><td>6</td></tr><tr><td>Bathrooms:</td><td>2</td></tr>";
		html += "<tr><td>Price/Month:</td><td>$1,650</td></tr><tr><td>Sq. Footage:</td><td>2100</td></tr>";
		html += "</table>";
		html += "<p class='maptab'>Landlord:  Dean Plichta <br /> Phone: (269) 345-7545 <br /> Email: <a href=\"#\">realinc@peoplepc.com</a></p>";
		html += "<p class='maptab'><a href=\"#\">Lease Agreement</a></p>";
	}

	if(houseId == 1) {
		html += "<table class='maptab'>";
		html += "<tr><td colspan='2' class='head'>942 Bellevue</th></tr><tr>";
		html += "<td>Rooms:</td><td>6</td></tr>";
		html += "<tr><td>Bathrooms:</td><td>2</td></tr>";
		html += "<tr><td>Price/Month:</td><td>$950</td></tr>";
		html += "<tr><td>Sq. Footage:</td><td>1889</td></tr>";
		html += "</table>";
		html += "<p class='maptab'>Landlord:  Dean Plichta <br /> Phone: (269) 345-7545 <br /> Email: <a href=\"#\">realinc@peoplepc.com</a></p>";
		html += "<p class='maptab'><a href=\"#\">Lease Agreement</a></p>";

	}

	return html;
}

function getHouseImage(houseId) {
	
	var html = "";

	if(houseId == 0) {
		html += "<p><img src=\"./images/213_Burr_Oak.jpg\" alt=\"924 Bellevue\" /></p>";
	}

	if(houseId == 1) {
		html += "<p><img src=\"./images/942_bellevue.jpg\" alt=\"924 Bellevue\" /></p>";
	}

	return html;
}



