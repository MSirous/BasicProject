<?php
if (!isset($layout_context)) {
 	$layout_context = "public" ;
 }  ?>
<!DOCTYPE html>
<html>
<head>
	<title>پایگاه خبری سیروس <?php  if ($layout_context== "admin") {	echo "Admin";
	} ?></title>
	<link rel="stylesheet" type="text/css" href="stylesheets/public.css" media="all">
</head>
<body>
	<div id="header">
		<h1> پایگاه خبری سیروس <?php if ($layout_context == "admin") {
		echo "* مدیر";
		} ?></h1>
	</div>