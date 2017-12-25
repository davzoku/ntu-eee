// validator2.js
//   An example of input validation using the change and submit 
//   events, using the DOM 2 event model
//   Note: This document does not work with IE8

// ********************************************************** //
// The event handler function for the name text box

function chkName(event) {

// Get the target node of the event

  var myName = event.currentTarget;

// Test the format of the input name 
//  Allow the spaces after the commas to be optional
//  Allow the period after the initial to be optional

  var pos = myName.value.search(/^[A-Z][a-z]+, ?[A-Z][a-z]+ ?[A-Z]\.$/);

  if (pos != 0) {
    alert("The name you entered (" + myName.value + 
          ") is not in the correct form. \n" +
          "The correct form is: " +
          "Last-name, First-name I. \n" +
          "First letters are capitalized");
    myName.focus();
    myName.select();
	return false;
  } 
}

// ********************************************************** //
// The event handler function for the phone number text box

function chkPhone(event) {

// Get the target node of the event

  var myPhone = event.currentTarget;

// Test the format of the input phone number
 
  var pos = myPhone.value.search(/^\d{3}-\d{3}-\d{4}$/);
 
  if (pos != 0) {
    alert("The phone number you entered (" + myPhone.value +
          ") is not in the correct form. \n" +
          "The correct form is: ddd-ddd-dddd \n" +
          "Please go back and fix your phone number");
    myPhone.focus();
    myPhone.select();
	return false;
  } 
}
