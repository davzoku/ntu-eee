<?php
$a =5;
echo '$a before reference is '.$a."<br>";
$b =&$a;
$a =7; // $a and $b are now both 7
echo '$b after reference is '.$b."<br>";
echo '$a after reference is '.$a."<br>";
?>