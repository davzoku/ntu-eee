<!DOCTYPE html>
<html>
<body>

<h1>Hello Mail</h1>

<p>My first mail test.</p>

<?php
$to      = 'f32ee@localhost';
$subject = 'the subject';
$message = 'hello from php mail';
$headers = 'From: f32ee@localhost' . "\r\n" .
    'Reply-To: f32ee@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers,'-ff32ee@localhost');
echo ("mail sent to : ".$to);
?> 

</body>
</html>
