<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>
<?php find_selected_page();?>

<?php
	// can't add a new page unless we have a subject as a parent!
	 if (!$current_subject) {
	 // subject ID was missing or invalid or
	 // subject couln't be found in database.
		redirect_to("manage_content.php");
	}
	?>

<?php
if (isset($_POST['submit'])) {
	//process the form.


	// validations
	$required_fields= array("menu_name", "position","visible", "content");
	validation_presence($required_fields);

	$field_with_max_length = array("menu_name" => 80);
	validate_max_length($field_with_max_length);


	if (empty($error)) {
	$subject_id = $current_subject["id"];
	$menu_name = mysql_prep( $_POST["menu_name"]);
	$visible =  (int)$_POST["visible"];
	$position = (int)$_POST["position"];
	$content = mysql_prep($_POST["content"]);
	

	$query = "INSERT INTO pages (";
	$query .= " subject_id, menu_name , position , visible, content";
	$query .= " )VALUES (";
	$query .= " {$subject_id},'{$menu_name}', {$position}, {$visible}, '{$content}'";
	$query .= " )";
	$result= mysqli_query($Connection, $query); 

	if ($result) {
		//echo "success!";
		$_SESSION ["message"] = "Page Created";
		redirect_to("manage_content.php?.subject=".urlencode($current_subject["id"]));
	}else{
		$_SESSION ["message"] = "Page Creation failed";
	}
}

}else {

	}

?>


<?php $layout_context = "admin" ; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject,$current_page); ?>
		
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php  echo form_errors($error); ?>

		<h2>ساخت صفحه ::</h2>

		<form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="post">
			
			<p>انتخاب نام :
				<input type="text" name="menu_name" value="" />
			</p>

			<p>موقعیت:
				<select name="position">
					<?php
						$page_set = find_pages_for_subject($current_subject["id"]);
						$page_count = mysqli_num_rows($page_set);
					for ($count=1; $count <= ($page_count+1); $count++) { 
						echo "<option value=\"{$count}\"> {$count} </option>";
					}
					?>
				</select>
			</p>

			<p>پنهان:
				<input type="radio" name="visible" value="0" /> خیر
				&nbsp;&nbsp;
				<input type="radio" name="visible" value="1" > بله
			</p>

			<p> محتوی: <br />
				<textarea name="content" rows="20" cols="80"></textarea>
			</p>

			<input type="submit" name="submit" value="ساخت موضوع">
				<a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]); ?>">انصراف</a>
		</form>
	

	</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>