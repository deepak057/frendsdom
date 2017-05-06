<?php

class MailController extends CController{

/**
** Method to send mails, accepts recepeint's email, 
*** subject and mail's content as parameters
**/

function SendMail($to,$sub,$message){

return @mail($to,$sub,$this->MailLayout($message),$this->MailHeaders());

}

/**
** Method to wrap the given content in a common HTML layout
** for all the mails that system sends out
**/

function MailLayout($content){

return $this->renderPartial("mail_layout",array(

"content"=>$content

),true);

}

/**
** Get mail headers
**/

function MailHeaders(){

$headers = 'From: Be Happy <deepak057@yahoo.com>' . "\r\n" .
'Reply-To: deepak057@yahoo.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";
$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";

return $headers;

}

}

?>