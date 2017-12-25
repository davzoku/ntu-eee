<!doctype html>
<html lang="en">
<head>
<title>JavaJam Coffee House</title> 

<meta charset=“utf-8”>
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
#rightcolumn li {
    list-style-image: url('img/trilliumbg2.gif');
}
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
.upDownButton{
    background:#ffd800;
    border:none;
    width:20px;
    color:#808080;
    margin: 1px 1px 1px 1px;
    }
.qtyLabel {
    width: 20px;
    background: #ffffff;
    color: black;
    margin: 0 0 0 0;
    text-align: center;
    margin: 1px 1px 1px 1px;
    }
.empty{
    visibility:collapse;
    }

</style> 
    <?php 
        @ $db = new mysqli('localhost', 'root', '', 'f35ee');

        if (mysqli_connect_errno()) {
            echo 'Error: Could not connect to database.  Please try again later.';
            exit;
        }
        
        $data_col = array("productid", "name", "abbre_name", "price");
        $products_table = array();
        $query = "select * from products where 1;";
        $products_result = $db->query($query);

        $num_results = $products_result->num_rows;
        
        $abbrev_to_id = array();
        for($i=0; $i < $num_results; $i++){
            $row = $products_result ->fetch_assoc();
            $products_table[$i] = $row;
            $abbre_name = $row['abbre_name'];
            $abbrev_to_id[$abbre_name] = $i;
        }

        $products_result->free();
        

        $query = "select productid, sum(amount), sum(quantity) from sales group by productid;";
        $sales_by_prod_result = $db->query($query);

        // Get top sales
        $sales_table = array();
        $top_sales_amount = 0;
        $top_sales_product_id = NULL;
        for($i =0; $i < $sales_by_prod_result->num_rows; $i ++){
            $row = $sales_by_prod_result->fetch_assoc();
            $productid = $row['productid'];
            $sales_table[$productid] = $row;

            $product_amount_sum = $row['sum(amount)'];
            if($product_amount_sum > $top_sales_amount ){
                $top_sales_amount = $product_amount_sum;
                $top_sales_product_id = $productid;
            }

        }

        //var_dump($sales_table);
        $sales_by_prod_result->free();
        // $total_sales_table = array(array());
        // for($i =0; $i< $sales_by_prod_result->num_rows; $i ++){
        //     $row = $sales_by_prod_result->fetch_assoc();
            
        // }

        // $query = "select productid, sum(amount)) from sales group by productid;";
        // $top_sales_result = $db->query($query);
        // $top_sales_table = array();
        // for($i =0; $i < $top_sales_result->num_rows; $i ++){
        //     $row = $top_sales_result->fetch_assoc();
        //     $productid = $row['productid'];
        //     $top_sales_table[$productid] = $row;
        // }
        
        //var_dump($top_sales_table);
        $db->close();
        

    ?>

</head>
<div id="wrapper">
    <body onload = "onLoad()">      
  <header>

  	  <!-- img from https://openclipart.org/image/2400px/svg_to_png/22305/pitr-Coffee-cup-icon.png -->
  </header>
  <div id="leftcolumn">
    <nav><center>
	 <ul>
<li><a href="index.html">Home</a> </li>
<li><a href="admin.php">Price Product Update</a></li>
<li><a href="sales.php">Sales</a></li>
	 </ul></center>
    </nav>
  </div>
    <div id="rightcolumn">
        <div id="content"><center>
        <div >
            <h2 id="title" > Sales Report: </h2>
            <h2 id="title"> Highest Dollar Sales:</h2>
                <h3 style="padding-left:50px"> 
                            <u><?php $productName = $products_table[$top_sales_product_id]['name'];
                            echo $productName;?> </u>
                            ->
                            <u>$<?php echo $top_sales_amount;?></u> 
                        </h3>
            <h2 id="title"> Sales by category </h2>
            </div>
            
                <table id="menu_table">
                    
                    <tbody>
                        
                        <thead>
                            <td> Product Name</td>
                            <td> Quantity Sold</td>
                            <td> Revenue</td>
                        </thead>
                        <?php 
                            foreach($sales_table as $sales => $sale_value){
                                echo "<tr>";
                                $productid = $sale_value['productid'];
                                $productname = $products_table[$productid]['name'];
                                echo "<td><strong>".  $productname. "</strong> </td>";
                                $prod_quantity = $sale_value['sum(quantity)'];
                                echo "<td>".  $prod_quantity. " </td>";
                                $prod_sales = $sale_value['sum(amount)'];
                                echo "<td>$ ".  $prod_sales. " </td>";
                                // echo "<td> <strong> {$}";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <br><br><br><br>
            </div></div>
        
    </body >
 <footer>
<small>
<i> Copyright &copy; 2017 JavaJam Coffee House <br>
<a href="mailto:kokwai@teng.com">kokwai@teng.com</a></center>
</i>


</small>
    </footer>
</div>
</html>