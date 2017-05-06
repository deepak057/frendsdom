<?php

include('../includes/includes.php');

$headers = 'From: Frendsdom <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

/*****common variables*****/

$mail_header="<!doctype html><head>
<style type='text/css'>
p{margin:10px 0;}
</style>
</head>
<body><p style='margin-bottom:30px;'><img src='".SITE_URL."/frendsdom.gif'/></p>";


$mail_footer="<div style='margin-top:50px;text-align:center;border-top:1px dotted #d2d2d2;padding-top:10px;'>
<div>Thank you! Hope you are coming soon.</div>
<p>Visit <a href='http://blog.frendsdom.com'>Our Blog</a>&nbsp;|&nbsp;Feel free to contact us at: admin@frendsdom.com&nbsp;|&nbsp;".current_year()." &copy; Frendsdom.com</p>
</div>
</body></html>";


?>