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
    <nav><center>
	 <ul>
<li><a href="index.html">Home</a> </li>
<li><a href="admin.php">Price Product Update</a></li>
<li><a href="report.html">Sales</a></li>
	 </ul></center>
    </nav>
  </div>
<div id="rightcolumn">
    <div class="content"> 
				<h1>Price Update Completed.</h1>
				  	<div id="menu_table">
					  	<?php
					  		 $newprice0=$_POST['pricearray0'];
					  		 $newprice1=$_POST['pricearray1'];
					  		 $newprice2=$_POST['pricearray2'];
					  		 $newprice3=$_POST['pricearray3'];
					  		 $newprice4=$_POST['pricearray4'];
							 

							  if (!$newprice0 || !$newprice1 || !$newprice2 || !$newprice3 || !$newprice4) {
							     echo 'You have not entered search details.  Please go back and try again.';
							     exit;
							  }

							 // @ $db = new mysqli('localhost', 'root', '', 'myuser');
								@ $db = new mysqli('localhost', 'root', '', 'f35ee');

							  if (mysqli_connect_errno()) {
							     echo 'Error: Could not connect to database.  Please try again later.';
							     exit;
							  }

							  $query = "UPDATE `prices` SET `Just Java` = '".$newprice0."', `Cafe au Lait-S` = '".$newprice1."', `Cafe au Lait-D` = '".$newprice2."', `Iced Cappuccino-S` = '".$newprice3."', `Iced Cappuccino-D` = '".$newprice4."' WHERE `prices`.`id` = 1";

							  if ($db->query($query) === TRUE) {
							    echo "Price Update Success!!";
							  } else {
							    echo "Error updating record: " . $db->error;
							    echo "<br> Error query is: " . $query;
							  }

							  $db->close();

						?>  
                        <br><br><br>
                        Go back to <a href="index.html">Home</a><br><br><br>
					</div>
			 </div>		</div>
    <footer>
<small>
<i> Copyright &copy; 2017 JavaJam Coffee House <br>
<a href="mailto:kokwai@teng.com">kokwai@teng.com</a></center>
</i>


</small>
    </footer>             
		 </div>    
	</body>
</html>