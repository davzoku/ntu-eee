<?php
//$prices=array('Tires'=>100);
$prices['tires']=80;
$prices['Oil']=10;
$prices['Spark Plugs']=4;
echo "Using foreach() construct : <br>";
foreach ($prices as $key => $value) {
			echo $key." - ".$value."<br />";
		}
		
echo "<br>Using each() construct : <br>";
reset($prices);
while ($element = each($prices)) {
	echo $element['key'];
	echo " - ";
	echo $element['value'];  
	echo "<br />";
}
?>