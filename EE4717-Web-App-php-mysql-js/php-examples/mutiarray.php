<?php
$products = array( array('TIR', 'Tires', 100),
					  array('OIL', 'Oil',10),
					  array('SPK', 'Spark Plugs',4));
			  
for ($row = 0; $row < 3; $row++) {
    for ($column = 0; $column < 3; $column++){
       echo '|'.$products[$row][$column];
   }
   echo '|<br/>';
}
?>