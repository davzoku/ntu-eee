// radio_click2.js
//   An example of the use of the click event with radio buttons,
//   registering the event handler by assigning an event property

// The event handler for a radio button collection

function planeChoice (plane) {

// Put the DOM address of the elements array in a local variable

  var dom = document.getElementById("myForm");

// Determine which button was pressed

  for (var index = 0; index < dom.planeButton.length; 
       index++) {
    if (dom.planeButton[index].checked) {
      plane = dom.planeButton[index].value;
      break;
  }
}

// Produce an alert message about the chosen airplane

  switch (plane) {
    case "152": 
      alert("A small two-place airplane for flight training");
      break;
    case "172": 
      alert("The smaller of two four-place airplanes");
      break; 
    case "182":
      alert("The larger of two four-place airplanes");
      break;    
    case "210":
      alert("A six-place high-performance airplane");
      break; 
    default:
      alert("Error in JavaScript function planeChoice");
      break;
  }
}
