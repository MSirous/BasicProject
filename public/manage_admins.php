<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $admin_set= find_all_admins();?>

<?php $layout_context = "admin" ; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
<div id="navigation">
	<br />
<a href="admin.php">&laquo; صفحه اصلی </a>
</div>
<div id="page">
	<?php echo message(); ?>
	<h2> مدیریت مدیران </h2>
	<table>
		<tr>
			<th style="text-align: left; with:200px;"> نام کاربری &nbsp;&nbsp;&nbsp;&nbsp;</th> 
			<th style="text-align: left;" colspan="2"> رویداد </th>
		</tr>
		<?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
		<tr>
			<td><?php echo htmlentities($admin["username"]);?></td>			
			<td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>"> ویرایش صفحه </a> &nbsp;</td> 
			<td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>" onclick="return confirm('از این کار مطمین هستی?')"> جذف مدیر</a> </td>

		</tr>
<?php }?>
	</table>
	<br />
	<a href="new_admin.php"> اضافحه کردن مدیر جدید </a>
</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
