<?php // page2.php
if (!isset($_SESSION))  session_start();
  var_dump($_SESSION);
  $id = session_id();
  echo "<br> Session id in page 2 = $id <br>";
  
  echo '<br>The content of $_SESSION[\'sess_var2\'] before unset() is '
        .$_SESSION['sess_var2'].'<br />';

  unset($_SESSION['sess_var2']);
?>
<a href="page3.php">Next page</a>
