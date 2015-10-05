<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>
<?php
	$admin = find_admin_by_id($_GET["id"]);
	if (!$admin) {
	 	// subject ID was missing or invalid or
	 	// subject couldn't be found in database.
	 	redirect_to("manage_admins.php");
	 } 


	 $id= $admin["id"];
	 $query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";
	 $result = mysqli_query($Connection, $query);

	 if ($result && mysqli_affected_rows($Connection) == 1) {
	 	$_SESSION["message"] = "یک مدیر پاک شد ";
	 	redirect_to("manage_admins.php");
	 } else{
	 	$_SESSION["message"] = "نمیتواند مدیر را حذف کند ";
	 	redirect_to("manage_admins.php");
	 }


?>