<?php
$tireqty = 5;
$strvar = "tires";
echo "Variable name un-quoted: ";
echo $tireqty.'tires<br/>';

echo "Variable name in double quotes: ";
echo "$tireqty".'tires<br/>';

echo "Variable name in single quotes: ";
echo '$tireqty'.'tires<br/>';

echo "Concatenation in double quotes: ";
echo "$tireqty.tires<br/>";

echo "Concatenation in single quotes: ";
echo '$tireqty.tires<br/>';
?>