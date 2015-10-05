<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $layout_context = "admin" ; ?>
<?php require_once("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<h2>بخش مدیریت</h2>
		<p>به بخش مدیریتی خوش آمدید:  <?php echo htmlentities($_SESSION["username"]); ?></p>
	<ul>
		<li><a href="manage_content.php">مدیریت بخش ارسال اطلاعات</a></li>
		<li><a href="manage_admins.php">مدیریت بخش مدیرن</a></li>
		<li><a href="logout.php"> خروج از سیستم </a></li>
	</ul>
	</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>