
	<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAUZYgUPLwYaI0Iah8NfClxhQgLhGGP4qP2PANj84q0rxlxpERHRRVoqQJ8VH-mXD5yeYLlohqG6_zYw"></script>
	<script type="text/javascript" src="./js/map.js"></script>
	<script type="text/javascript">
		google.load("maps", "2.x");
		google.setOnLoadCallback(init);

		$("#link").toggle(
			function () { $("#houselist").animate({"width":"0px"}, 1500); },
			function () { $("#houselist").animate({"width":"200px"}, 1500); }
		);

	</script>
<div id="mapcontainer">
	<div class="hidden" id="school_id">0</div>
	<div id="houselist" style="font-size: .75em;">
		<p>No houses found</p>
		<p>Did you <a href="./">choose a school</a>?</p>
	</div>
<div id="map"></div>
</div>
