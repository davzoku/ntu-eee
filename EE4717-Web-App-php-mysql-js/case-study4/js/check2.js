// validator2.js
//   Note: This document does not work with IE8

// ********************************************************** //
// The event handler function for the name text box

window.onload = init;


var nameNode = document.getElementById("myName");
var passwordNode = document.getElementById("myPassword");
var emailNode = document.getElementById("myEmail");
var dateNode = document.getElementById("myDate");
var submitNode = document.getElementById("form_information");

nameNode.addEventListener("change", chkName, false);
passwordNode.addEventListener("change", chkPassword, false);
emailNode.addEventListener("change", chkEmail, false);
dateNode.addEventListener("change", chkDate, false);

// $('#information').css('background', 'red');
function chkSubmit(){
  // var passorfail = ()
  return chkName();
}

function init (){
  submitNode.onsubmit=chkName;
}

function chkName(event) {

  var myNameTarget = event.currentTarget;
  var patt = /^[a-zA-Z\s]+$/;
  var pos = myNameTarget.value.search(patt);

  if (pos != 0) {
    alert("The name you entered (" + myNameTarget.value + ") is invalid. \n" + "The name should only contain alphabet characters and character spaces.");
    returnFalse(myNameTarget);
  } 
}

function chkPassword(event) {
  var pwStrengthMsg = {
    length:"Password needs to be at least 8 characters long \n",
    uppercase:"Password needs at least two Upper Case \n",
    number:"Password needs at least 1 number \n",
    special:0,
  };

  var myPasswordTarget = event.currentTarget;
  var myPasswordVal = myPasswordTarget.value;
  var myPasswordLength = myPasswordVal.length;

  // var anUpperCase = /^([A-Z]+[a-z]){2,}S/;
  var anUpperCase = /^(.*?[A-Z]){2,}/;
  var aLowerCase = /[a-z]/; 
  var aNumber = /[0-9]{1,}/;
  var aSpecial = /[!|@|#|$|%|^|&|*|(|)|-|_]{1,}/;

// Test the format of the input name 
  var patt = /^[a-zA-Z._-]+@[0-9]{2,3}$/;

// performing checks
  var isUppCase = anUpperCase.test(myPasswordVal);
  var isLong = (myPasswordLength>8);
  var isNum = aNumber.test(myPasswordVal)
  // to check password strength
  // if(isUppCase){pwStrength.uppercase+=1}
  // if(isLong){pwStrength.length+=1}
  // if(isNum){pwStrength.number+=1}
  if(!isUppCase || !isLong || !isNum){
    var outputMsg = "";
    if(!isUppCase){ outputMsg += pwStrengthMsg.uppercase}
    if(!isLong){ outputMsg += pwStrengthMsg.length}
    if(!isNum){ outputMsg += pwStrengthMsg.number}
    alert(outputMsg);
    returnFalse(myPasswordTarget);
  }   
}


function chkEmail(event) {
  var myEmailTarget = event.currentTarget;
  // pattern for multiple email extensions
  // this is the Regex for a standard email domain that does not accept unicode
  var patt = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; 
  // var patt = /^[\w.-]+@[\w]{1,}([.]{1}[\w]{1,}){1,3}[.]{1}[\w]{2,4}$/; // This is the ReGex for the standard email domain
// Test the format of the input email
  // var patt = /^[\w.-_]{1,}[@]{1}[\w]{1,}[.]{1}[\w]{2,4}$/;
  // this is the ReGex for the xxx@yyy.zzz.com form
  // var patt = /^[\w.-_]{1,}[@]{1}[\w]{1,}([.]{1}[\w]{1,}){1,3}[.]{1}[\w]{2,4}$/; 

  var pos = myEmailTarget.value.search(patt);
  if (pos != 0) {
    alert("The email you entered (" + myEmailTarget.value + ") is not in the correct form. \n" + "The correct form is: xxxx@yyy.zzz.com \n" + "Please go back and fix your email");
    returnFalse(myEmailTarget);
  } 
}

function chkDate(event) {
  // Get the target node of the event
  var checknewfuture = function myself(input, today, index){
    if(index==-1){ return false;}
    if(input[index] >= today[index])
      return true;
    else
      return myself(input, today, (index-1));
   }

  var myDateTarget = event.currentTarget;
  var myDate = myDateTarget.value.split('-');
  var today = new Date();

  today = parseTodayDate(today);
  myDate = parseInputDate(myDate);
  
  // check if input is todays date
  var isToday = checkToday(myDate, today);
  var isFuture = checknewfuture(myDate, today,2);
  console.log("is it future: " +isFuture);

  var isPast = checkPast(myDate, today, 2);
  if(isToday || isPast){
    if(isToday){ alert("You cannot start today"); }
    else{ alert("You cannot start on a past date");}

    returnFalse(myDateTarget);
  }

  function parseInputDate(date){
    var day=parseInt(date[2]);
    var month=parseInt(date[1]);
    var year=parseInt(date[0]);
    return [day, month, year]
  }

  function parseTodayDate(date){
    var day = date.getDate()
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    return [day, month, year]
  }
   function checkToday(input, today){
    if(input[2] == today[2]){
      if(input[1] == today[1])
        if(input[0] == today[0])
          return true;
    
      return false
    }
   }

  function checkFuture(input, today, index){
    if(index<0){return false;}
    if(input[index] > today[index]) {return true;}
    return checkFuture(input, today, index-1)
  }

  function checkPast(input, today, index){
    if(index<0){return false;}
    if(input[index] < today[index]) {return true;}
    return checkPast(input, today, index-1)
  }

}

function returnFalse(obj) {
  obj.focus()
  obj.select();
  return false
}
