<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php
//error_reporting(1);
$username ="";
if (isset($_POST['submit'])) {
	//process the form.

	// validations
	$required_fields = array("username", "password");
	validation_presence($required_fields);

	if (empty($error)) {
		// attempt login
	
	$username = $_POST["username"];
	$password = $_POST["password"];

	$found_admin = attempt_login($username, $password);
	if ($found_admin) {
		// mark user as logged in 
		//$_SESSION ["message"] = "Logged in success";
		$_SESSION["admin_id"] = $found_admin["id"];
		$_SESSION["username"] = $found_admin["username"];
		
		redirect_to("admin.php");
	}else{
		//failure
		$_SESSION ["message"] = "Username / Password not found. ";
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

		<h2>ورود::</h2>

		<form action="login.php" method="post">
			
			<p>نام کاربری:
				<input type="text" name="username" value="<?php echo htmlentities($username);?>" />
			</p>

			<p>رمز عبور:
			<input type="password" name="password" value= "" />
			</p>

			<input type="submit" name="submit" value="ورود">
		</form>
	</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>