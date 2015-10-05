<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "admin" ; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page();?>

<?php
	 if (!$current_subject) {
		redirect_to("manage_content.php");
}?>


<?php
if (isset($_POST['submit'])) {
		//echo "sumit!";

// validations form
	$required_fields = array("menu_name", "position","visible");
	validation_presence($required_fields);

	$field_with_max_length = array("menu_name" => 30);
	validate_max_length($field_with_max_length);

	if (empty($error)) {
		
	$id = $current_subject["id"];
	$menu_name = mysql_prep($_POST["menu_name"]);
	$visible =  (int)$_POST["visible"];
	$position = (int)$_POST["position"];

	$query = "UPDATE subject SET";
	$query .= " menu_name = '{$menu_name}',";
	$query .= " visible = {$visible},";
	$query .= " position = {$position} ";
	$query .= " WHERE id = {$id} ";
	$query .= " LIMIT 1";
	$result= mysqli_query($Connection, $query); 

	if ($result && mysqli_affected_rows($Connection) >= 0) {
		//echo "success!";
		$_SESSION ["message"] = "موضوع ویراش شد. ";
		redirect_to("manage_content.php");
	}else{
		$_SESSION ["message"] = "موضوع نمیتواند ویراش شود";
		//redirect_to("new_subject.php");
	}
}
}else {

	}
?>
<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject,$current_page); ?>

	</div>
	<div id="page">
		<?php if (!empty($message)) {
			 echo "<div class=\"message\">". htmlentities($message). "</div>";
		} ?>
		<?php  echo form_errors($error); ?>

		<h2>ویراش موضوع: <?php echo htmlentities($current_subject["menu_name"]);?></h2>

		<form action="edit_subject.php?subject=<?php echo urldecode($current_subject["id"]); ?>" method="post">
			
			<p>نام منو:
				<input type="text" name="menu_name" value="<?php echo htmlentities($current_subject["menu_name"]); ?>">
			</p>

			<p>موقعیت:
				<select name="position">
					
						<?php
							$subject_set = select_all_subjects(false);
							$count_subject = mysqli_num_rows($subject_set);
						for ($count=1; $count <= ($count_subject+1); $count++) { 
							echo "<option value=\"{$count}\"";
							if ($current_subject["position"] == $count) {
								echo "selected";
							}
							echo "> {$count} </option>";
						}
						?>
					</option>
				</select>
			</p>

			<p>مخفی:
				<input type="radio" name="visible" value="1" <?php if ($current_subject["visible"] == 1) { echo "checked";} ?> /> خیر
				&nbsp;&nbsp;
				<input type="radio" name="visible" value="0" <?php if ($current_subject["visible"] == 0) { echo "checked";} ?> /> بله
			</p>

			<input type="submit" name="submit" value="ویرایش موضوع">
		</form>
		<br/>
		<a href="manage_content.php">انصراف</a>
		&nbsp;&nbsp;
		<a href="delete_subject.php?subject=<?php echo urldecode($current_subject["id"]);?>" onclick="return confirm('Are You sure?') " >حذف موضوع</a>

	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
