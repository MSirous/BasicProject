<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php $layout_context = "admin" ; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page();?>

<?php
	 if (!$current_page) {
		redirect_to("manage_contxxent.php");
}?>


<?php
if (isset($_POST['submit'])) {
		//echo "sumit!";

	$id = $current_page["id"];
	$menu_name = mysql_prep($_POST["menu_name"]);
	$visible =  (int)$_POST["visible"];
	$position = (int)$_POST["position"];
	$content = mysql_prep($_POST["content"]);


// validations form
	$required_fields = array("menu_name", "visible","position", "content");
	validation_presence($required_fields);

	$field_with_max_lengths = array("menu_name" => 80);
	validate_max_length($field_with_max_lengths);

if (empty($error)) {

	$query = "UPDATE pages SET ";
	$query .= " menu_name = '{$menu_name}',";
	$query .= " visible = {$visible},";
	$query .= " position = {$position},";
	$query .= " content = '{$content}'";
	$query .= " WHERE id = {$id}";
	$query .= " LIMIT 1";
	$result = mysqli_query($Connection, $query); 

	if ($result && mysqli_affected_rows($Connection) == 1) {
		//echo "success!";
		$_SESSION ["message"] = "صفحه به روز شد";
		redirect_to("manage_contedssnt.php?page={$id}");
	}else{
		$_SESSION ["message"] = "صفحه را نمیتواند به روز کند .";
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
	<?php
		echo message();
	  	echo form_errors($error); ?>

	<h2>ویرایش صفحه: <?php echo htmlentities($current_page["menu_name"]);?></h2>

	<form action="edit_page.php?subject=<?php echo urldecode($current_page["id"]); ?>" method="post">
			
		<p>نام منو:
			<input type="text" name="menu_name" value="<?php echo htmlentities($current_page["menu_name"]); ?>">
		</p>
	<p>موقعیت:
		<select name="position">
				
			<?php
				$page_set = find_pages_for_subject($current_page["subject_id"]);
				$page_count = mysqli_num_rows($page_set);
				for ($count=1; $count <= $page_count; $count++) { 
					echo "<option value=\"{$count}\"";
				if ($current_page["position"] == $count) {
					echo "selected";
				}
				echo ">{$count} </option>";	
				}
			?>
				</select>
			</p>

			<p>مخفی:
				<input type="radio" name="visible" value="0" <?php if ($current_page["visible"] == 0) { echo "checked";} ?> /> خیر
				&nbsp;&nbsp;
				<input type="radio" name="visible" value="1" <?php if ($current_page["visible"] == 1) { echo "checked";} ?> /> بله
			</p>
			<p> محتوا: <br />
				<textarea name="content" rows="20" cols="80"><?php echo htmlentities($current_page["content"]); ?> </textarea>
			<br />

			<input type="submit" name="submit" value="ویرایش صفحه">
		</form>
		<br/>
		<a href="manage_content.php">انصراف</a>
		&nbsp;&nbsp;
		<a href="delete_subject.php?subject=<?php echo urldecode($current_subject["id"]);?>" onclick="return confirm('Are You sure?')" >حذف صفحه </a>

	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>