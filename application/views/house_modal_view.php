<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>College Housing</title>	
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" href="/ch/style/style.css" type="text/css" />
</head>
<body>

<div id="house-modal-container">
	<h2><?php echo $house->address_street; ?></h2>
	<div id="house-modal-image">
		<img src="/ch/images/213_Burr_Oak.jpg" height="200" width="250"  /></a></div>
	</div>
	<div id="house-modal-data">
		<div class="left">Rooms:<br />Bathrooms:<br />Price/Month:<br />Sq. Footage:</div>
		<div class="right">
			<?php echo $house->number_of_rooms; ?><br />
			<?php echo $house->number_of_bath_rooms ?><br />
			<?php echo $house->monthly_rent; ?><br />
			<?php echo $house->square_footage; ?>
		</div>
	</div>
</div>

</body>
</html>