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
    <style>


    </style> 
    <?php 
        @ $db = new mysqli('localhost', 'root', '', 'f35ee');

        if (mysqli_connect_errno()) {
            echo 'Error: Could not connect to database.  Please try again later.';
            exit;
        }
        
        // for ($i=0; $i <$num_results; $i++) {
        //     $row = $result->fetch_assoc();
        // }
        //echo $temp;
        $data_col = array("productid", "name", "abbre_name", "price");
        $data_table = array(array());
        $query = "select * from products where 1;";
        $result = $db->query($query);

        $num_results = $result->num_rows;
        
        for($i=0; $i < $num_results; $i++){
            $row = $result ->fetch_assoc();
            $abbre_name = $row['abbre_name'];
            $data_table[$abbre_name] = $row;
        }

        $result->free();
        $db->close();

    ?>
    <script>
        var debug = true;
        var items = ["JJ", "CAL", "IC"];
        function onLoad() {
            for(var i =0; i< items.length; i++){
                document.getElementById('price' + items[i].toString()).parentElement.hidden = true;
                document.getElementById('checkbox' + items[i].toString()).checked = false;
                document.getElementById('checkbox' + items[i].toString()).value = false;
            }
            document.getElementById('CALsgl').checked = true;
            document.getElementById('ICsgl').checked = true;   
            console.log("Loading..");
        }
        function onUpdateCheckBoxChange(item){
            checkCondition = document.getElementById('checkbox'+item.toString()).checked;
            document.getElementById('checkbox'+item.toString()).value = checkCondition;
            //Hide the table column
            document.getElementById('price' + item.toString()).hidden = !checkCondition;
            document.getElementById('price' + item.toString()).parentElement.hidden = !checkCondition;
            //Todo: update prices
            //document.getElementById('price' + item.toString()).value = 
        }

        function debugPrint(on, string) {
            if (on) {
                console.log(string);
                //document.write(string);
            }
        }
        function radioButton(buttonName) {
            var button = document.getElementById(buttonName);
            var drink = (/[A-Z]+/).exec(buttonName);
            var sgldbl = (/[a-z]+/).exec(buttonName);//sgl-Single and dbl-Double
            //document.getElementById(drink + "sgl").checked = false;
            //document.getElementById(drink + "dbl").checked = false;

            //document.getElementsByName(buttonName).checked = true;

            debugPrint(debug, drink + sgldbl);
            if (sgldbl == "dbl") {
                document.getElementById(drink + "sgl").checked = false;
                document.getElementById(drink + "sgl").value = 0;
                document.getElementById(drink + "dbl").value = 1;
                debugPrint(debug, "dbl");
            }
            if (sgldbl == "sgl") {
                document.getElementById(drink + "dbl").checked = false;
                document.getElementById(drink + "dbl").value = 0;
                document.getElementById(drink + "sgl").value = 1;
                debugPrint(debug, "sgl");
            }
        }
    </script>


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
<li><a href="report.html">Sales</a></li>
	 </ul></center>
    </nav>
  </div>
  <div id="rightcolumn">
    <div class="content"> 
                <h2> Click on the checkbox to update product prices: </h2>

            <form method="post" action="updatePrice.php">
            <table id="menu_table">

                <tbody>
                    
                    <thead style="visibility:hidden">
                        <td> CheckBox</td>
                        <td> Coffee </td>
                        <td> Description</td>
                        <td> Value</td>
                    </thead>
                    <tr>
                        <td class="updateCheckBox"> 
                            <input id="checkboxJJ" name = "checkboxJJ" type="checkbox" onchange="onUpdateCheckBoxChange('JJ')"  />
                        </td>
                        <td> <strong> Just Java </strong> </td>
                        <td>
                            Regular hour blend, decaffeinated coffee, or flavor of the day.
                            <br> Endless Cup $<?php echo $data_table["JJ"]["price"];?>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input style="width:50px" type="number" id="priceJJ" name ="priceJJ" >
                            <!-- <input type="hidden" name="abbrev_name" value="JJ"> -->
                        
                        </td>

                    </tr>
                    <tr>
                        <td class="updateCheckBox"> 
                            <input id="checkboxCAL" name="checkboxCAL" type="checkbox" onchange="onUpdateCheckBoxChange('CAL')"/>
                        </td>
                        <td> <strong> Cafe au Lait </strong> </td>
                        <td>
                            House blended coffee infused into a smooth, steamed milk.
                            <br> Single $<?php echo $data_table["CAL_S"]["price"];?> Double $<?php echo $data_table["CAL_D"]["price"];?>
                        </td>
                        <td>
                            <label for="CALsgl">Single</label>
                            <input type="radio" id="CALsgl" name="CALsgl" onClick="radioButton('CALsgl')" value = "1" />
                            <br />
                            <label for="CALdbl">Double</label>
                            <input type="radio" id="CALdbl"  name="CALdbl" onClick="radioButton('CALdbl')" value = "0"/>
                        </td>
 
                        <td>
                                <input style="width:50px" type="number" id="priceCAL"  name = "priceCAL">
                        </td>
                    </tr>
                    <tr>
                        <td class="updateCheckBox"> 
                            <input id="checkboxIC" name = "checkboxIC"type="checkbox" onchange="onUpdateCheckBoxChange('IC')"/>
                        </td>
                        <td><strong> Iced Cappucino </strong> </td>
                        <td>
                            Sweetened espresso blended with icy-cold milk and served in a chilled glass.
                            <br> Single $<?php echo $data_table["IC_S"]["price"];?> Double $<?php echo $data_table["IC_D"]["price"];?>
                        </td>
                        <td>
                            <label for="ICsgl">Single</label>
                            <input type="radio" id="ICsgl" name="ICsgl" onClick="radioButton('ICsgl')" value = "1"/>
                            <br />
                            <label for="ICdbl">Double</label>
                            <input type="radio" id="ICdbl" name="ICdbl"onClick="radioButton('ICdbl')" value = "0"/>
                        </td>
                        <td>
                            
                                <input style="width:50px" type="number" id="priceIC" name = "priceIC" >
                            </form>
                        </td>
                    </tr>
                    <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    
                    <td>
                    <input type="submit" />
                    </td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
        </div>
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