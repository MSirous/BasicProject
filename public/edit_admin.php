<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>
<?php $admin = find_admin_by_id($_GET["id"]);
	if (!$admin) {
		redirect_to("manage_admins.php");
	}
?>


<?php
if (isset($_POST['submit'])) {
		//echo "sumit!";

// validations form
	$required_fields = array("username" , "password");
	validation_presence($required_fields);

	$field_with_max_length = array("username" => 30);
	validate_max_length($field_with_max_length);

	if (empty($error)) {
		//perform update

	$id = $admin["id"];
	$username = mysql_prep($_POST["username"]);
	$hashed_password =  password_encrypt($_POST["password"]);

	$query = "UPDATE admins SET ";
	$query .= " username = '{$username}',";
	$query .= " hashed_password = '{$hashed_password}',";
	$query .= " WHERE id = {$id} ";
	$query .= " LIMIT 1";
	$result= mysqli_query($Connection, $query); 

	if ($result && mysqli_affected_rows($Connection) == 1) {
		//echo "success!";
		$_SESSION ["message"] = "مدیر با موفقیت ویراش شد";
		redirect_to("manage_admins.php");
	}else{
		$_SESSION ["message"] = "نمیتواند مدیر را ویرایش کند";
		//redirect_to("new_subject.php");
}
}
}else {

	}
?>


<?php $layout_context = "admin" ; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">

		<?php echo message(); ?>
		<?php  echo form_errors($error); ?>

		<h2>ویرایش مدیر: <?php echo htmlentities($admin["username"]);?></h2>

		<form action="edit_admin.php?id=<?php echo urldecode($admin["id"]); ?>" method="post">
			
			<p>نام کاربری:
				<input type="text" name="menu_name" value="<?php echo htmlentities($admin["username"]); ?>" />
			</p>

			<p>رمز عبور:
				<input type="password" name="password" value="" />
			</p>

			<input type="submit" name="submit" value="ویرایش مدیر">
		</form>
		<br/>
		<a href="manage_admins.php">انصراف</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
