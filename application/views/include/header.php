<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>College Housing</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" href="<?=base_url(); ?>style/style.css" type="text/css" />
	<script type="text/javascript" src="<?=base_url(); ?>js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="<?=base_url(); ?>js/ch.js"></script>
</head>
<body>
<div id="container">
<div id="header">
	<ul id="navlist">
		<li <?php if($page=="contact") echo "class=\"nav-current\"" ?>><a href="<?=base_url(); ?>contact">contact</a></li>
		<li <?php if($page=="about") echo "class=\"nav-current\"" ?>><a href="<?=base_url(); ?>about">about</a></li>
		<li <?php if($page=="home") echo "class=\"nav-current\"" ?>><a href="<?=base_url(); ?>">home</a></li>
	</ul>
	<a href="<?=base_url(); ?>"><img src="<?=base_url(); ?>/images/ch_header.png" /></a>
</div>
