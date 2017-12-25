<html lang="en">
	<head>
		 <title>JavaJam Coffee House Menu</title>
		 <meta charset="utf-8">
		 <style>
body {font-family:Verdana, Arial, sans-serif;
      background-color: #ffeeba;
}
#wrapper { background-color: #c4a852; 
           color: #000066;
           width: 80%;
		   margin: auto;
           min-width:940px;
} 
#leftcolumn { float: left;
	          width: 150px;

} 
#rightcolumn { margin-left: 155px;
               background-color: #e0d7c0;
               color: #000000;
			   padding: 10px 20px;
} 
header { background-color: #99710d;
        color: #c49d38; 
        font-size: 150%; 
        padding: 10px 10px 10px 155px;
		background-image: url(img/javajam_logo.jpg); 
		    background-position: center;
		background-repeat: no-repeat;
		height: 130px;
}
h2 { color: ##91700b; 
     font-family: arial, sans-serif;
}
.content {padding: 20px 20px 0 20px;

} 
#floatleft { margin: 10px;
             float: left;
}

footer {
        padding: 10px 10px 10px 155px;
font-size:70%;
         text-align: center;
		 clear: right;
         padding-bottom:20px;
		 background-color: #99710d;
}
footer a:link {
    color: #000;
	font-weight: bold;
	 text-decoration:none;
}
nav ul { list-style-type: none; 
         padding: 10px; }
a:link {
    color: #91700b;
	font-weight: bold;
	 text-decoration:none;
}


a:visited {
    color: #91700b;
	 text-decoration:none;
}


a:hover {
    color: #543e08;
	 text-decoration:none;
}


a:active {
    color: #543e08;
	 text-decoration:none;
}
tr:nth-of-type(even) {
	background-color:#e0d7c0;
    text-align: center;
}
tr:nth-of-type(odd) {
	background-color: #c4a852;
    text-align: center;
}

</style> 
	</head>

	<body>
		<div id="wrapper">
		 <header>
		 
		 </header>
  <div id="leftcolumn">
				<nav>   
					<ul><center>
						<li><a href="index.html">Home</a></li>
						<li><a href="menu.html">Menu</a></li>
						<li><a href="music.html">Music</a></li>
						<li><a href="jobs.html">Jobs</a></li>
					</ul> </center>
				</nav>
		   </div>
  <div id="rightcolumn">
    <div class="content"> 
				<h1>Your Purchase is completed.</h1>
				  	<div id="menu_table">
					  	<?php
					  		 $qty1=$_POST['qty1'];
					  		 $qty2=$_POST['qty2'];
					  		 $qty3=$_POST['qty3'];
					  		 $qty4=$_POST['qty4'];
					  		 $qty5=$_POST['qty5'];
							 

							  if (!$qty1 || !$qty2 || !$qty3 || !$qty4 || !$qty5) {
							     if(!$qty1)
							     	$qty1 = 0;
							     if(!$qty2)
							     	$qty2 = 0;
							     if(!$qty3)
							     	$qty3 = 0;
							     if(!$qty4)
							     	$qty4 = 0;
							     if(!$qty5)
							     	$qty5 = 0;
							  }


							 // @ $db = new mysqli('localhost', 'root', '', 'myuser');
							 
							 @ $db = new mysqli('localhost', 'root', '', 'f35ee');

							  if (mysqli_connect_errno()) {
							     echo 'Error: Could not connect to database.  Please try again later.';
							     exit;
							  }

							  $query = "select * from prices";
							  $result = $db->query($query);

							  $prices = $result->fetch_assoc();
							  $price1 = stripslashes($prices['Just Java']);
							  $price2 = stripslashes($prices['Cafe au Lait-S']);
							  $price3 = stripslashes($prices['Cafe au Lait-D']);
							  $price4 = stripslashes($prices['Iced Cappuccino-S']);
							  $price5 = stripslashes($prices['Iced Cappuccino-D']);

							  //echo "<br>Quantity1: ". $qty1;
							  //echo "<br>Quantity2: ". $qty2;
							  //echo "<br>Quantity3: ". $qty3;
							  //echo "<br>Quantity4: ". $qty4;
							  //echo "<br>Quantity5: ". $qty5;
							  //echo "<br>Price1:" . $price1;
							  //echo "<br>Price2:" . $price2;
							  //echo "<br>Price3:" . $price3;
							  //echo "<br>Price4:" . $price4;
							  //echo "<br>Price5:" . $price5;
							  //echo "<br>Total1:" . $price1 * $qty1;
							  //echo "<br>Total2:" . $price2 * $qty2;
							  //echo "<br>Total3:" . $price3 * $qty3;
							  //echo "<br>Total4:" . $price4 * $qty4;
							  //echo "<br>Total5:" . $price5 * $qty5;

							  $query = "INSERT INTO `ordertable` (`id`, `qty1`, `qty2`, `qty3`, `qty4`, `qty5`, `earn1`, `earn2`, `earn3`, `earn4`, `earn5`, `date`) VALUES (NULL, '".$qty1."', '".$qty2."', '".$qty3."', '".$qty4."', '".$qty5."', '".$price1 * $qty1."', '".$price2 * $qty2."', '".$price3 * $qty3."', '".$price4 * $qty4."', '".$price5 * $qty5."', '". date("Y-m-d") ."')";

							  //echo "<br> Query => " . $query;

							  if ($db->query($query) === TRUE) {
								    echo "Purchase Success!!";
								} else {
								    echo "Try again. Error: " . $query . "<br>" . $db->error;
								}


							  $result->free();
							  $db->close();

						?>  
                        
                        <br><br>Go back to <a href="index.html">Home</a><br><br><br>
					</div>
			 </div>		
             </div>
  <footer><small>
<i> Copyright &copy; 2017 JavaJam Coffee House <br>
<a href="mailto:kokwai@teng.com">kokwai@teng.com</a></center>
</i>


</small>
    </footer>           
		 </div>    
	</body>
</html>