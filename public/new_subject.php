<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "admin" ; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page(); ;?>



<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject,$current_page); ?>
		<?php echo "<a href=new_subject.php> + Add subjects: </a>" ;?>
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php  $error = error(); ?>
		<?php  echo form_errors($error); ?>

		<h2>ساخت موضوع::</h2>

		<form action="create_subject.php" method="post">
			
			<p>انتخاب نام:
				<input type="text" name="menu_name" value="">
			</p>

			<p>موقعیت:
				<select name="position">
					
						<?php
							$subject_set = select_all_subjects();
							$count_subject = mysqli_num_rows($subject_set);
						for ($count=1; $count <= ($count_subject+1); $count++) { 
							echo "<option value=\"{$count}\"> {$count} </option>";
						}
						?>
					</option>
				</select>
			</p>

			<p>پنهان بودن:
				<input type="radio" name="visible" value="0" /> خیر
				&nbsp;&nbsp;
				<input type="radio" name="visible" value="1" > بله
			</p>

			<input type="submit" name="submit" value="ساخت موضوع">
		</form>
		<br/>
		<a href="manage_content.php">انصراف</a>

	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
