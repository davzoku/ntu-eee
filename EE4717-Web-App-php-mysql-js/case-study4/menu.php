<!doctype html>
<html lang="en">
<head>
<title>JavaJam Coffee House</title> 

<meta charset=“utf-8”>
<link rel="stylesheet" href = "CSS/style.css">
    <style>
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
        var items = [];
        
        function onLoad() {

            var oReq = new XMLHttpRequest();
            oReq.open("get","PHP/get_price.php",true);


            

            document.getElementById('CALsgl').checked = true;
            document.getElementById('ICsgl').checked = true;

            document.getElementById('qtyJJ').addEventListener("change", qtyChanged('JJ'), false);
            document.getElementById('qtyCAL').addEventListener("change", qtyChanged('CAL'), false);
            document.getElementById('qtyIC').addEventListener("change", qtyChanged('IC'), false);
        }
        function increment(item) {
            var qtyDOM = document.getElementById('qty' + item);
            var qty = parseInt(qtyDOM.value);

            if (qty < 99) {
                qty+=1
            }
            //debugPrint(debug, "qty:" + qty);
            qtyDOM.value = qty;
            subtotal(item);
            total();
        }
        function decrement(item) {
            var qtyDOM = document.getElementById('qty' + item);
            var qty = parseInt(qtyDOM.value);
            console.log("Quantity: " + qty);


            if (qty > 0) {
                qty -= 1;
            }
            //debugPrint(debug, "qty:" + qty);
            qtyDOM.value = qty;
            subtotal(item);
            total();
        }
        function debugPrint(on, string) {
            if (on) {
                console.log(string);
                //document.write(string);
            }
        }

        function qtyChanged(item){
            var qtyDOM = document.getElementById('qty' + item);
            

            var regex_num = /^[0-9]+$/;   //contains only number
            if(!regex_num.test(qtyDOM.value)){
                
                alert("Please enter a valid number.");
            }
            var qty = parseInt(qtyDOM.value);

            if(qty > 99 || qty <0){
                alert("Pleae enter a quantity between 1 - 99. ")
                if(qty<0) qty = 0;
                if(qty>99) qty = 99;
            }
            subtotal(item);
            total();
        }
        function subtotal(item) {
            debugPrint(debug, "func Subtotal(" + item +")");
            var qtyDOM = document.getElementById('qty' + item);
            var qty = parseInt(qtyDOM.value);
            debugPrint(debug, "func Subtotal" +" qty "+ qty);
            var basePrice = 0.0;
            if (item != "JJ") {
                var double = document.getElementById(item + "dbl").checked;
                debugPrint(debug, "func Subtotal" + " double " + double);
            }

            var sub_total =0.0;
            switch (item) {
                case "JJ"||'JJ': basePrice = <?php echo $data_table["JJ"]["price"];?>;
                            break;
                case "CAL"||'CAL':
                    if (double)
                        basePrice = <?php echo $data_table["CALdbl"]["price"];?>;
                    else
                        basePrice = <?php echo $data_table["CALsgl"]["price"];?>;
                    break;
                case "IC"||'IC':
                    if (double)
                        basePrice = <?php echo $data_table["ICdbl"]["price"];?>;
                    else
                        basePrice = <?php echo $data_table["ICsgl"]["price"];?>;
                    break;
                default:
                    debugPrint(debug, "func Subtotal" + " no such case");
            };
            debugPrint(debug, "func Subtotal" + " basePrice " + basePrice);
            sub_total = basePrice * qty;

            document.getElementById('price' + item).innerHTML = "$" + sub_total.toFixed(2);
            return sub_total;

        }
        function total() {
            var sum = subtotal("CAL") + subtotal("JJ") + subtotal("IC");

            document.getElementById("Total").innerHTML = "$" + sum.toFixed(2);
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
                debugPrint(debug, "dbl");
            }
            if (sgldbl == "sgl") {
                document.getElementById(drink + "dbl").checked = false;
                debugPrint(debug, "sgl");
            }

            subtotal(drink.toString());
            total();
        }
    </script>
</head>
<div id="wrapper">
    <body onload = "onLoad()">      
        <header>
            <img src="javalogo.gif" height ="95em" width ="500em"></a>
        </header>
        <div>
            <nav>
                <ul >
                <li><a href = "index.html">Home </a> &nbsp </li>
                <li><a href = "menu.php" style="color:chocolate"> Menu </a> &nbsp  </li>
                <li><a href = "music.html"> Music </a> &nbsp </li>
                <li><a href = "jobs.html"> Jobs </a> &nbsp </li>
                </ul>
            </nav>
        </div>
        <div id="main_content">
        <div >
                <h1 id="title" > Coffee at Java </h1>
        </div>
            <table id="menu_table">
                <tbody>
                    <thead style="visibility:hidden">
                        <td> Coffee </td>
                        <td> Description</td>
                        <td> Type</td>
                        <td> Quantity </td>
                        <td> Subtotal </td>
                    </thead>
                    <tr>
                        <td> <strong> Just Java </strong> </td>
                        <td>
                            Regular hour blend, decaffeinated coffee, or flavor of the day.
                            <br> Endless Cup $<?php echo $data_table["JJ"]["price"];?>
                        </td>
                        <td>
                            <p style="margin:0 0 0 0"> Endless Cup</p>
                        </td>
                        <td>
                            <input class="upDownButton" type="button" value="+" onClick="increment('JJ')" />
                            <input input="text" class="qtyLabel" name="qtyJJ" id="qtyJJ" value ="0" onchange="qtyChanged('JJ')"/>
                            <input class="upDownButton" type="button" value="-" onClick="decrement('JJ')" />

                        </td>
                        <td>
                            <p id="priceJJ">$0.00</p>
                        </td>

                    </tr>
                    <tr>
                        <td> <strong> Cafe au Lait </strong> </td>
                        <td>
                            House blended coffee infused into a smooth, steamed milk.
                            <br> Single $<?php echo $data_table["CAL_sgl"]["price"];?> Double $<?php echo $data_table["CAL_dbl"]["price"];?>
                        </td>
                        <td>
                            <label for="CALsgl">Single</label>
                            <input type="radio" id="CALsgl" onClick="radioButton('CALsgl')" />
                            <br />
                            <label for="CALsgl">Double</label>
                            <input type="radio" id="CALdbl" onClick="radioButton('CALdbl')" />
                        </td>
                        <td>
                            <input class="upDownButton" type="button" value="+" onClick="increment('CAL')" />
                            <input type="text" class="qtyLabel" name="qtyCAL" id="qtyCAL" value="0" onchange="qtyChanged('JJ')"/>
                            <input class="upDownButton" type="button" value="-" onClick="decrement('CAL')" />
                        </td>
                        <td>
                            <p id="priceCAL">$0.00</p>
                        </td>
                    </tr>
                    <tr>
                        <td><strong> Iced Cappucino </strong> </td>
                        <td>
                            Sweetened espresso blended with icy-cold milk and served in a chilled glass.
                            <br> Single $<?php echo $data_table["CAL_sgl"]["price"]?> Double $<?php echo $data_table["CAL_dbl"]["price"]?>
                        </td>
                        <td>
                            <label for="ICsgl">Single</label>
                            <input type="radio" id="ICsgl" onClick="radioButton('ICsgl')" />
                            <br />
                            <label for="ICsgl">Double</label>
                            <input type="radio" id="ICdbl" onClick="radioButton('ICdbl')" />
                        </td>
                        <td>
                            <input class="upDownButton" type="button" value="+" onClick="increment('IC')" />
                            <input type="text" class="qtyLabel" name="qtyIC" id="qtyIC" value ="0" onchange="qtyChanged('JJ')" />
                            <input class="upDownButton" type="button" value="-" onClick="decrement('IC')" />
                        </td>
                        <td>
                            <p id="priceIC">$0.00</p>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <td class="empty"></td>
                    <td class="empty"></td>
                    <td class="empty"></td>
                    <td>
                        <p>Total:</p>
                    </td>
                    <td>
                        <p style="text-decoration:underline; font-weight:bold" id="Total">$0.00</p>
                    </td>
               </tfoot>
            </table>
        </div>
    </body >
    <footer>
        <p>
            <em> Copyright &copy 2014 JavaJam Coffee House </em>
            <br>
            <a href = "mailto:zhiwei@tan.com"><em> zhiwei@tan.com </em></a>
        </p>
    </footer>
</div>
</html>