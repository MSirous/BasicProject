<?php
	session_start();

	function message(){
		if (isset($_SESSION["message"])) {
			$output = "<div class = \"message\">";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			//clear message after use
			$_SESSION["message"] = null;
			return $output;
		}
	}

	function error(){
		if (isset($_SESSION["error"])) {
			$error = $_SESSION["error"];
			$_SESSION["error"] = null;
			return $error;
		}
	}



 ?>
