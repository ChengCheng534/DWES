<?php

$to = 'yushen740@gmail.com'; 


$name = $_POST['name'];
$tel = $_POST['tel'];
$subject = $_POST['subject'];
$email = $_POST['email'];
$message = $_POST['message'];


// Email Submit
// Note: filter_var() requires PHP >= 5.2.0
if ( isset($email) && isset($name) && isset($tel) && isset($subject) 
&& isset($message) && filter_var($email, FILTER_VALIDATE_EMAIL) ) {

 // detect & prevent header injections
$test = "/(content-type|bcc:|cc:|to:)/i";
foreach ( $_POST as $key => $val ) {
if ( preg_match( $test, $val ) ) {
  exit;
}
}

$body = <<<EMAIL
ASUNTO : $subject

HOLA MI NOMBRE ES, $name.

$message

DE : $name
TEL : $tel
MAIL : $email

EMAIL;


$header = 'From: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
'Reply-To: ' . $_POST["email"] . "\r\n" .
'Cc: yushen740@gmail.com' . "\r\n" .  // esto sería copia normal
'Bcc: yushen740@gmail.com' . "\r\n" . // esto sería copia oculta
'X-Mailer: PHP/' . phpversion();

//
 // mail( $to , $_POST['subject'], $_POST['message'], $headers );
 mail($to, $subject, $body, $header);
  //      ^
  //  Replace with your email 
}?>