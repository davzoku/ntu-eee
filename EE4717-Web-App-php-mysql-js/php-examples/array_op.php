<!DOCTYPE html>
<html>
<body>

<?php
$x = array("a" => "red", "b" => "green"); 
$y = array("c" => "blue", "d" => "yellow"); 

var_dump($x + $y);
$z = $x + $y;
echo "<br>";
foreach ($z as $key => $value){
	echo $key." - ".$value."<br />";
}
?>   

</body>
</html>