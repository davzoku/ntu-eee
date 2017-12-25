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
				<h1>Generate Report</h1>
				  	<div id="menu_table">
					  	<?php
					  		

							 // @ $db = new mysqli('localhost', 'root', '', 'myuser');
								@ $db = new mysqli('localhost', 'root', '', 'f35ee');

							  if (mysqli_connect_errno()) {
							     echo 'Error: Could not connect to database.  Please try again later.';
							     exit;
							  }

							if(empty($_GET['dollarSales']) && empty($_GET['qtySales'])) {
								echo "No report had be selected.";
							}else{
								if(!empty($_GET['dollarSales'])) {
						  		 	echo '<h3><u>Report by Dollar Sales</u></h3><table border=0>
												<thead>
													<tr>
													<th>Date</th>
													<th>Just Java</th>
													<th>Cafe au Lait (Single)</th>
													<th>Cafe au Lait (Double)</th>
													<th>Iced Cappuccino (Single)</th>
													<th>Iced Cappuccino (Double)</th>
													</tr>
												</thead>
												<tbody>';
						  		 	$query = "SELECT * FROM `ordertable`";
							  		$result = $db->query($query);
							  		while ($row = $result->fetch_assoc()){
							  			echo '<tr>
												<td>'.$row['date'].'</td>
												<td>'.$row['earn1'].'</td>
												<td>'.$row['earn2'].'</td>
												<td>'.$row['earn3'].'</td>
												<td>'.$row['earn4'].'</td>
												<td>'.$row['earn5'].'</td>
											  </tr>';
							  		}
							  		echo '</tbody>
											</table><br><hr><br>';
								}
								if(!empty($_GET['qtySales'])) {
						  		 	echo '<h3><u>Report by Quantity Sales</u></h3><table border=0>
												<thead>
													<tr>
													<th>Date</th>
													<th>Just Java</th>
													<th>Cafe au Lait (Single)</th>
													<th>Cafe au Lait (Double)</th>
													<th>Iced Cappuccino (Single)</th>
													<th>Iced Cappuccino (Double)</th>
													</tr>
												</thead>
												<tbody>';
						  		 	$query = "SELECT * FROM `ordertable`";
							  		$result = $db->query($query);
							  		while ($row = $result->fetch_assoc()){
							  			echo '<tr>
												<td>'.$row['date'].'</td>
												<td>'.$row['qty1'].'</td>
												<td>'.$row['qty2'].'</td>
												<td>'.$row['qty3'].'</td>
												<td>'.$row['qty4'].'</td>
												<td>'.$row['qty5'].'</td>
											  </tr>';
							  		}
							  		echo '</tbody>
											</table><br><hr><br>';
								}
							}
							  $db->close();

						?> 
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