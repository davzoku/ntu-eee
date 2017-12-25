<?php //cookiecounter.php
if (!isset($_COOKIE['visits'])){
	$_COOKIE['visits'] = 0;
}

$visits = $_COOKIE['visits'] + 1;
//	setcookie('visits', $visits, time() + 3600 + 24 + 365);
setcookie('visits', $visits, time() + 10);
echo var_dump($_COOKIE). "<br>";

?>
<html>
<head>
<title>Cookie counter</title>
</head>
<body>
<?php
if ($visits > 1) {
	echo "This is visit number $visits.";
} else {// First visit
	echo 'Welcome to my Web site! Click here for a tour!';
}
?>
</body>
</html>