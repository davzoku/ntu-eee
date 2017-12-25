<html>
<head>
<title> Today's Date</title>
</head>
<body>
<p>Today's Date is
<?php
echo date('l, F dS Y.');

echo "<p>0rder processed at ";
echo date('H:i, jS F Y');
echo "</p>";

echo "<p>Time in the format of ('h:i:sa'): ". date('h:i:sa')."</p>";
?>
</p>
</body>
</html>