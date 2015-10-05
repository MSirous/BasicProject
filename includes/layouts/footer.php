<div id="footer"> CopyRight <?php echo date("Y"); ?>, Widget Corp</div>
</body>
</html>

<?php
	// Close Database Connection
if (isset($Connection)) {
	mysqli_close($Connection);
}
?>