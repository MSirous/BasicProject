<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>
<?php
if (isset($_POST['submit'])) {
	//process the form.

	// validations
	$required_fields = array("username", "password");
	validation_presence($required_fields);

	$field_with_max_lengths = array("username" => 30);
	validate_max_length($field_with_max_lengths);


	if (empty($error)) {
	$username = mysql_prep($_POST["username"]);
	$hashed_password = password_encrypt($_POST["password"]);
	

	$query = "INSERT INTO admins (";
	$query .= " username, hashed_password";
	$query .= " )VALUES (";
	$query .= " '{$username}' , '{$hashed_password}'" ;
	$query .= " )";
	$result= mysqli_query($Connection, $query); 

	if ($result) {
		//echo "success!";
		$_SESSION ["message"] = "Admin Created";
		redirect_to("manage_admins.php");
	}else{
		//failure
		$_SESSION ["message"] = "Admin Creation failed";
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

		<h2>ساخت مدیر ::</h2>

		<form action="new_admin.php" method="post">
			
			<p>نام کاربری/ ایمیل:
				<input type="text" name="username" value="" />
			</p>

			<p>رمز عبور :
			<input type="password" name="password" value= "">
			</p>

			<input type="submit" name="submit" value="ساخت مدیر">
		</form>
		<br />
		<a href="manage_admins.php"> انصراف </a>
	</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>