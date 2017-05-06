<?php

include('includes.php');

//for($i=2043;$i<=2115;$i++){

$u=new user(0);

if($u->get_account_status()){

$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


if(mail($u->get_email(),"You have very few relations on Frendsdom","<p style='margin-bottom:30px;'><img src='".SITE."/frendsdom.gif'/></p>Hi ".$u->get_first().",<p><br/>You haven't been very active on Frendsdom. Maybe because you didn't like it or don't understand it. We suggest you read on:

<style type='text/css'>

ul li{

MARGIN:10px;
}

</style>

<ul>

<li>
You don't seem to be having enough relations on Frendsdom.
</li>

<li>
Sadly, without your friends this website is not going to be of any use for you. Since Frendsdom is so innovative that most people don't understand the real intention behind it ie. to expand your world.
</li>

<li>
With each relation added you get one extra point and then these points can be offered to others so that they can accept your invitations.
</li>

<li>
Got it? If so, please log in to your account <a href='".SITE_URL."/home.php?noty_action=invite_fr'>here</a> and populate your relation lists by inviting your contacts from Gmail, yahoo or Facebook and enjoy making new friends from all around the world. 
</li>


</ul>



<p style='margin-top:50px;'>Have fun!</p>
<p>Frendsdom</p>

<div style='margin-top:20px;text-align:center'>
<p>Visit <a href='http://blog.frendsdom.com'>Our Blog</a>&nbsp;|&nbsp;Feel free to contact us at admin@frendsdom.com</p>
<p>2013 &copy; Frendsdom.com</p>

</div>


",$headers))


echo "mail sent";

else echo "failed";

}
//}



?>