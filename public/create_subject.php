<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
if (isset($_POST['submit'])) {
		//echo "sumit!";
	$menu_name =mysql_prep( $_POST["menu_name"]);
	$visible =  (int)$_POST["visible"];
	$position = (int)$_POST["position"];

// validations form
	$required_field = array("menu_name", "position","visible");
	validation_presence($required_field);

	$field_with_max_length = array("menu_name" => 30);
	validate_max_length($field_with_max_length);

	if (!empty($error)) {
		$_SESSION["error"]=$error;
		redirect_to("new_subject.php");
	}

	$query = "INSERT INTO subject (";
	$query .= "menu_name , position , visible";
	$query .= " )VALUES (";
	$query .= " '{$menu_name}', {$position}, {$visible} ";
	$query .= " )";
	$result= mysqli_query($Connection, $query); 

	if ($result) {
		//echo "success!";
		$_SESSION ["message"] = "یک موضوع با موفقیت ثبت شد ";
		redirect_to("manage_content.php");
	}else{
		$_SESSION ["message"] = "موضوعی ثبت نشد ";
		redirect_to("new_subject.php");
	}

}else {
	redirect_to("new_subject.php");

	}

?>






<?php if (isset($Connection)) { mysqli_close($Connection); } ?>