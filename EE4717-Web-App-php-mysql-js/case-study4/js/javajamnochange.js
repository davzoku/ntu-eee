// nochange.js
//   This script illustrates using the focus event
//   to prevent the user from changing a text field

// The event handler function to compute the cost

function computeCost() {
  var java = document.getElementById("java").value;
  var aulait = document.getElementById("aulait").value;
  var cappucino = document.getElementById("cappucino").value;
  var aulait2 = document.getElementById("aulait2").value;
  var cappucino2 = document.getElementById("cappucino2").value;

// Compute the cost
  var javasubtotal = java * 2.00 ;
  var aulaitsubtotal = aulait * 2.00 + aulait2 * 3.00;
  var cappuccinosubtotal =  cappucino * 4.75 + cappucino2 * 5.75;
  var totalcost = java * 2.00 + aulait * 2.00 + aulait2 * 3.00 + cappucino * 4.75 + cappucino2 * 5.75;
    
    document.getElementById("javasubtotal").value = javasubtotal;
     
    document.getElementById("aulaitsubtotal").value = aulaitsubtotal;
     
    document.getElementById("cappucinosubtotal").value = cappuccinosubtotal;
    

    document.getElementById("totalcost").value = totalcost;
}  //* end of computeCost
