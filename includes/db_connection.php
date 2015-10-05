<?php
	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "<#machachi#>");
	define("DB_NAME", "widget_corp");

	$Connection= mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	if (mysqli_connect_errno()) {
		die("Your Connection faild...! ".
			mysqli_connect_error().
			"(". mysqli_connect_errno() . ")" 
			);
	}
?>