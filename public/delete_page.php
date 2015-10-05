<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>
<?php
	$current_page = find_page_by_id($_GET["page"], false);
	if (!$current_subject) {
	 	// subject ID was missing or invalid or
	 	// subject couldn't be found in database.
	 	redirect_to("manage_content.php");
	 } 

	$id=$current_page["id"];
	 $query = "DELETE FROM pages WHERE id = {$id} LIMIT 1";
	 $result = mysqli_query($Connection, $query);

	 if ($result && mysqli_affected_rows($Connection) == 1) {
	 	$_SESSION["message"] = "صفحه با موفقیت پاک شد. ";
	 	redirect_to("manage_content.php");
	 } else{
	 	$_SESSION["message"] = "نمیتواند صفحه را پاک کند. ";
	 	redirect_to("manage_content.php?page={$id}");
	 }



	 

?>