<?php

$to = "ckatz2009@gmail.com";
$subject = "Contact Us";
$email = $_REQUEST['email'] ;
$message = $_REQUEST['message'] ;
$headers = "From: $email";
$sent = mail($to, $subject, $message, $headers) ;
if($sent)
{print "Your mail was sent successfully"; }
else
{print "We encountered an error sending your mail"; }


?> 

