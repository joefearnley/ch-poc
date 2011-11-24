
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/map.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fancybox.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>style/jquery.fancybox.css" type="text/css" />

<div id="mapcontainer">
	<div class="hidden" id="school_id"><?php echo $school_id ?></div>
<!--
	<a id="slide-left" href="#">hide house list<span class="triangle-left"></span></a>
	<a id="slide-right" href="#" style="display: none;">show house list<span class="triangle-right"></span></a>
-->
<?php /*?>
	<div id="houselist">

<?php foreach($houses->result() as $house) { ?>
		<table id="house">
			<tr>
				<td rowspan="10" class="homeicon" id="<?php echo $house->school_id ?>">
					<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>images/213_Burr_Oak.jpg" height="50" width="50" class="house-thumbnail" id="<?php echo $house->id ?>" /><br />map it</a>
				</td>
			</tr>
			<tr><td colspan="2" class="head"><a class="iframe" href="house/modal/<?php echo $house->id ?>"><?php echo $house->address_street; ?></a></td></tr>
			<tr><td>Rooms:</td><td><?php echo $house->number_of_rooms; ?></td></tr>
			<tr><td>Bathrooms:</td><td><?php echo $house->number_of_bath_rooms; ?></td></tr>
			<tr><td>Price/Month:</td><td><?php echo $house->monthly_rent; ?></td></tr>
			<tr><td>Sq. Footage:</td><td><?php echo $house->square_footage; ?></td></tr>
		</table>

	<?php } ?>
	<div class="pagination-links">
		<?php //echo $this->pagination->create_links(); ?>
	</div>
	</div>
*/?>
<div id="map"></div>
</div>
