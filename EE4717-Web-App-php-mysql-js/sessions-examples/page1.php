<?php  //page1.php
  session_start();
  var_dump($_SESSION);
  $id = session_id();
  echo "<br> Session id in page 1 = $id <br>";
  
  $_SESSION['sess_var'] = "Hello world!";
  $_SESSION['sess_var2'] = "Hello world2!";

  echo 'The content of $_SESSION[\'sess_var\'] is '
        .$_SESSION['sess_var'].'<br />';
  echo 'The content of $_SESSION[\'sess_var2\'] is '
        .$_SESSION['sess_var2'].'<br />';
?>
<a href="page2.php">Next page</a> 
