<?php //page3.php
  session_start();
  var_dump($_SESSION);
  $id = session_id();
  echo "<br> Session id in page 3 = $id <br>";

  echo '<br>The content of $_SESSION[\'sess_var\'] is '
        .$_SESSION['sess_var'].'<br />';
  echo 'The content of $_SESSION[\'sess_var2\'] is '
        .$_SESSION['sess_var2'].'<br />';

  session_destroy();
  $id=session_id();
  echo '<br>The content of $_SESSION[\'sess_var\'] after destroy is '
        .$_SESSION['sess_var'].'<br />';
  echo "<br>Session id after destroy in page 3 = $id <br>";
?> 
