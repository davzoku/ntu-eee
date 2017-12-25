<!DOCTYPE html>
<html>
<body>

<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
Name: <input type="text" name="fname">
<input type="submit">
</form>

<?php 
$name = $_REQUEST['fname'];
if (($name) != '')echo "<br> Text string submitted: ".$name; 
?>

</body>
</html>