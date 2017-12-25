<!DOCTYPE html>
<html>
<body>

<?php if (!isset($_GET['fname']) or $_GET['fname'] == '') { ?>

<!-- html content here... -->

<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>" >
Please enter your name: <input type="text" name="fname">
	  <input type="submit">
</form>

<?php } else { ?>
	<br> Name string submitted: <?php echo $_GET['fname']; ?>
	 <p> It also contains a <a href="newpage.php?name= <?php echo urlencode($_GET['fname']); ?> 
	 ">link</a> that passes the name variable on to the next document.</p>
 <?php } ?>

</body>
</html>