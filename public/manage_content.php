<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "admin" ; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page() ;?>



<div id="main">
<div id="navigation">
	<br />
	<a href="admin.php">&laquo; صفحه اصلی </a>
	<?php echo navigation($current_subject,$current_page); ?>
<br />
 <a href="new_subject.php"> + اضافه کردن موضوع: </a>
</div>
<div id="page">
<?php echo message();?>

	<?php if ($current_subject) { ?>
	<h2>مدیریت موضوع</h2>
	نام منو: <?php echo htmlentities($current_subject["menu_name"]);?> <br />
	موقعیت : <?php echo $current_subject["position"]; ?> <br />
	مخفی : <?php echo $current_subject["visible"] == 1 ? 'خیر' : 'بله'; ?> <br />
	<br />
<a href="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>">ویرایش موضوع</a>

 <!--Page in this subject: !-->
 <div style = "margin-top: 2em; border-top= 1px solid #00000;">
	<h3>صفحه هایی که در این مووضوع هستند :</h3>
	<ul>
		<?php 
			$subject_pages = find_pages_for_subject($current_subject["id"]);
			while ($page = mysqli_fetch_assoc($subject_pages)) {
				echo "<li>";
				$safe_page_id=urlencode($page["id"]);
				echo "<a href =\"manage_content.php?page={$safe_page_id}\">";
				echo htmlentities($page["menu_name"]);
				echo "</a>";
				echo "</li>";
			}
		?>
	</ul>
	<br />
	+ <a href="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>"> اضافه کردن صفحه جدید در این موضوع </a>
</div>

	<?php } elseif ($current_page) { ?>

<h2>مدیریت صفحه</h2>
	نام منو: <?php echo htmlentities($current_page["menu_name"]); ?> <br />
	موقعیت : <?php echo $current_page["position"]; ?> <br />
	مخفی بودن : <?php echo $current_page["visible"]== 1 ? 'خیر' : 'بله';  ?> <br />

	محتوا: <br />
	<div class="view-content">
		<?php echo htmlentities($current_page["content"]); ?>
</div>
<br />
<br />
<a href="edit_page.php?page=<?php echo urlencode($current_page["id"]);?>">ویرایش صفحه</a>

	<?php } else { ?>
		لطفا صفحه یا موضوعی را انتخاب کنید ..
	<?php }?>
</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
