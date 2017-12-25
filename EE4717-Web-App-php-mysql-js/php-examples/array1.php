<?php
$products = array( 'Tires', 'Oil', 'Spark Plugs');
var_dump($products);

echo "<br>for loop : <br>";
for ($i = 0; $i<3; $i++) {
  echo $products[$i]." ";
}
echo "<br>foreach():<br>";

foreach ($products as $curr) {
  echo $curr." ";
}

?>
