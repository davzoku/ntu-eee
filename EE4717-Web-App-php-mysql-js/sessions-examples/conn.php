<?php
$dbcnx=@mysql_connect('localhost','root','');
if (!$dbcnx)
	die("Could not connect to mysql");
if (!@mysql_select_db ("newijdb"))
	die("Could not find the database");
?>