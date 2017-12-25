<?php
  // create short variable names
  $tireqty = $_GET['tireqty'];
  $oilqty = $_GET['oilqty'];
  $sparkqty = $_GET['sparkqty'];
  $find = $_GET['find'];
?>
<html>
<head>
  <title>Bob's Auto Parts - Order Results</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>Order Results</h2>
<?php

	echo "<p>Order processed at ".date('H:i, jS F Y')."</p>";

	echo "<p>Your order is as follows: </p>";

	$totalqty = 0;
	$totalqty = $tireqty + $oilqty + $sparkqty;
	echo "Items ordered: ".$totalqty."<br />";


	if ($totalqty == 0) {

	  echo "You did not order anything on the previous page!<br />";

	} else {

	  if ($tireqty > 0) {
		echo $tireqty." tires<br />";
	  }

	  if ($oilqty > 0) {
		echo $oilqty." bottles of oil<br />";
	  }

	  if ($sparkqty > 0) {
		echo $sparkqty." spark plugs<br />";
	  }
	}


	$totalamount = 0.00;

	define('TIREPRICE', 100);
	define('OILPRICE', 10);
	define('SPARKPRICE', 4);

	$totalamount = $tireqty * TIREPRICE
				 + $oilqty * OILPRICE
				 + $sparkqty * SPARKPRICE;

	echo "Subtotal: $".number_format($totalamount,2)."<br />";

	$taxrate = 0.10;  // local sales tax is 10%
	$totalamount = $totalamount * (1 + $taxrate);
	echo "Total including tax: $".number_format($totalamount,2)."<br />";

	if($find == "a") {
	  echo "<p>Regular customer.</p>";
	} elseif($find == "b") {
	  echo "<p>Customer referred by TV advert.</p>";
	} elseif($find == "c") {
	  echo "<p>Customer referred by phone directory.</p>";
	} elseif($find == "d") {
	  echo "<p>Customer referred by word of mouth.</p>";
	} else {
	  echo "<p>We do not know how this customer found us.</p>";
	}

?>
</body>
</html>
