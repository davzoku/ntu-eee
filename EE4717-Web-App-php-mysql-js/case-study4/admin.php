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
				<h1>Update Price</h1>
				<form action="updateprice2.php" method="post">
				  	<div id="menu_table">
					  	<?php
							 // @ $db = new mysqli('localhost', 'root', '', 'myuser');
					  		 
							 @ $db = new mysqli('localhost', 'root', '', 'f35ee');

							  if (mysqli_connect_errno()) {
							     echo 'Error: Could not connect to database.  Please try again later.';
							     exit;
							  }

							  $query = "select * from prices";
							  $result = $db->query($query);

							   $row = $result->fetch_assoc();
							  echo '
							  
								<table border="0";>   
									  <tr>
											<td><strong>Just Java</strong></td>
											<td>Regular house blend, decaffeinated coffee, or flavor of the day.</td>
											<td>Endless Cup $</td>
											<td colspan="3"> <input type="text" class="orderbox" name="pricearray0" value="'.stripslashes($row['Just Java']).'"/></td>
									  </tr>
									  <tr> 
											<td><strong>Cafe au Lait</strong></td>
											<td>House blend coffee infused into a smooth, steamed milk.</td>
											<td>Single $</td>
											<td> <input type="text" class="orderbox" name="pricearray1" value="'.stripslashes($row['Cafe au Lait-S']).'"/></td>
											<td>Double $</td>
											<td> <input type="text" class="orderbox" name="pricearray2" value="'.stripslashes($row['Cafe au Lait-D']).'"/></td>
									  </tr>      
									  <tr>
											<td><strong>Iced Cappuccino</strong></td>
											<td>Sweetend expresso blended with icy-cold milk and served in a chilled glass.</td>
											<td>Single $4.75 </td>
											<td> <input type="text" class="orderbox" name="pricearray3" value="'.stripslashes($row['Iced Cappuccino-S']).'"/></td>
											<td>Double $5.75 </td>
											<td> <input type="text" class="orderbox" name="pricearray4" value="'.stripslashes($row['Iced Cappuccino-D']).'"/></td>
									  </tr>
								 </table>
							  ';

							  $result->free();
							  $db->close();

						?>  
					</div>
					<input type="submit" value="Update"/>
				</form>
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