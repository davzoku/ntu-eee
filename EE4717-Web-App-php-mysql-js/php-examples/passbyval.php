<?php
function increment($value, $amount = 1) {
  $value = $value +$amount;
}


$a = 10;
echo $a.'<br/>';
increment ($a);
echo $a. '<br/>';

?>