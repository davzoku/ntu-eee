<?php  //cart.php
session_start();
if (!isset($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}
if (isset($_GET['empty'])) {
	unset($_SESSION['cart']);
	header('location: ' . $_SERVER['PHP_SELF']);
	exit();
}
?>
<html>
<head>
<title>Shopping Cart</title>
</head>
<body>
<h1>Your Shopping Cart </h1>
<?php
$items = array(
	'Canadian-Australian Dictionary',
	'As-new parachute (never opened)',
	'Songs of he Goldfish (2CD Set)',
	'Ending PHP4 (O\'Wroxey Press)');
$prices = array(24.95, 1000, 19.99, 34.95);
?>
<table border="1">
	<thead>
	<tr>
		<th>Item Description</th>
		<th>Price</th>
	</tr>
	</thead>
	<tbody>
<?php
$total = 0;
for ($i=0; $i < count($_SESSION['cart']); $i++){
	echo "<tr>";
	echo "<td>" .$items[$_SESSION['cart'][$i]]. "</td>";
	echo "<td align='right'>$";
	echo number_format($prices[$_SESSION['cart'][$i]], 2). "</td>";
	echo "</tr>";
	$total = $total + $prices[$_SESSION['cart'][$i]];
}
?>
	</tbody>
	<tfoot>
	<tr>
		<th align='right'>Total:</th><br>
		<th align='right'>$<?php echo number_format($total, 2); ?>
		</th>
	</tr>
	</tfoot>
</table>
<p><a href="catalog.php">Continue Shopping</a> or
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?empty=1">Empty your cart</a></p>

</body>
</html>