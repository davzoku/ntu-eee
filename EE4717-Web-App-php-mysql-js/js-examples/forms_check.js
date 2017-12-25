// forms_check.js 
//   A function tst_phone_num is defined and tested.
//   This function checks the validity of phone
//   number input from a form 

// Function tst_phone_num
//  Parameter: A string
//  Result: Returns true if the parameter has the form of a valid
//          seven-digit phone number (3 digits, a dash, 4 digits)

function tst_phone_num(num) {

// Use a simple pattern to check the number of digits and the dash

  var ok = num.search(/^\d{3}-\d{4}$/);

  if (ok == 0) 
    return true;
  else 
    return false;

}  // end of function tst_phone_num

// A script to test tst_phone_num 

var tst = tst_phone_num("444-5432");
if (tst) 
  document.write("444-5432 is a valid phone number <br />");
else 
  document.write("Program error <br />");

tst = tst_phone_num("444-r432");
if (tst) 
  document.write("Program error <br />");
else
  document.write("444-r432 is not a valid phone number <br />");

tst = tst_phone_num("44-1234");
if (tst)
  document.write("Program error <br />");
else
  document.write("44-1234 is not a valid phone number <br /");
