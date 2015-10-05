<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	$current_subject = find_subject_by_id($_GET["subject"], false);
	if (!$current_subject) {
	 	// subject ID was missing or invalid or
	 	// subject couldn't be found in database.
	 	redirect_to("manage_content.php");
	 } 

	 $pages_set = find_pages_for_subject($current_subject["id"]);
	 if (mysqli_num_rows($pages_set) > 0) {
	 	$_SESSION["message"] = "نمیتواند حذف کند موضوع در این صفحه. ";
	 	redirect_to("manage_content.php?subject={$current_subject["id"]}");
	 }


	 $id=$current_subject["id"];
	 $query = "DELETE FROM subject WHERE id = {$id} LIMIT 1";

	 $result = mysqli_query($Connection, $query);
	 if ($result && mysqli_affected_rows($Connection) == 1) {
	 	$_SESSION["message"] = "موضوع با موفقیت حذف شد. ";
	 	redirect_to("manage_content.php");
	 } else{
	 	$_SESSION["message"] = "نمی تواند موضوع را حذف کند . ";
	 	redirect_to("manage_content.php?subject={$id}");
	 }


?>