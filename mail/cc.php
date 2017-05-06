<?php

include('includes.php');

//for($i=1625;$i<=1725;$i++){

$u=new user(0);


$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if($u->get_account_status()){

if(mail($u->get_email(),"Create your Frendsdom profile","


<style type='text/css'>
li,p{color:grey;}
ul h3{border-bottom:1px dotted #d2d2d2;padding-bottom:3px;}
</style>

<p style='margin-bottom:30px;'><img src='http://www.frendsdom.com/frendsdom.gif'/></p><p>Hi ".$u->get_first().",</p>

<p style='margin:20px 0px;'>This email was sent to you to encourage you to create your Frendsdom profile. Please read on-</p>

<ul>

<li>
<h3>Populate your share box</h3>

<p>Populate your share box or say in other words create your Frendsdom profile.</p>
<p>Frendsdom profile is one of its own kind of profile where you answer questions you create yourself.</p>
</li>

<li>
<h3>How?</h3>

<p>For example, in your sharebox (profile), you write a question 'Do I hate dogs?' and then in answer field you may write 'yes, they smell bed'.</p>

<p>Another question could be 'My favorite movies' and answer would be like 'The lord of the rings, She's out of my league.....etc'</p>
</li>



<li>
<h3>Attach pictures</h3>
<p>You are also allowed to attach relevant pictures to those questions.</p>
</li>




<li>
<h3>Your profile your way</h3>
<p>You can create any number of such questions.So, You get your profile your way.</p>
</li>



<li>
<h3>Benefit</h3>
<p>This profile not only tells people what you are like but also shows your creativity. So try creating your Frendsdom profile, it's great fun.</p>
</li>


<li>
<h3>Get started</h3>

<p>To get started:</p>

<ol>
<li>Go to your profile: <a href='http://frendsdom.com/visit.php?id={$i}'>here</a></li>
<li>
Click 'Manage your share box'.
</li>

<li>Create questions and answer them</li>
</ol>


</li>


</ul>






<div style='margin-top:50px;text-align:center;'>
<p><br/>Thank you! Hope you are coming soon.</p>
<p>Visit <a href='http://blog.frendsdom.com'>Our Blog</a>&nbsp;|&nbsp;Feel free to contact us at: admin@frendsdom.com&nbsp;|&nbsp;2013 &copy Frendsdom.com</p>
</div>








",$headers))

echo "mail sent";

else echo "failed";
}

//}






/*
include('/home/frendryg/FunctionList.php');
include('class_lib.php');
//for($i=789;$i<=851;$i++){

$u=new user(0);

if(!$u->user_pic())
{
$t="\nWe would also like to encourage you to upload your real picture so that you can increase your chances of getting others interested in your profile.";
}

else 
{
$t=' ';
}

$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n";


if(mail($u->get_email(),"Give your feedback ","Hi ".$u->get_first()."\n\nYou haven't been very active on frendsdom.com. Maybe because you don't find your relations already there or you haven't explored it yet .Try to search for your friends,colleagues etc by typing their name or e-mail address.\n\nAsk your friends to join this  website ,send them invitation,nudge them ,control their profile appearance and lot more.\n\nTry to explore this website and dig it deep, so that you can get the best out of it which is exactly what we want and not doing so would not leave the real impression on you.\n\n We expect that you would feel that the time you spent exploring it was worth it.{$t}\n\n\nIt's huge fun but only if you explore it.Thank you!\n\nGo to your home :http://www.frendsdom.com/home.php\nGive your feedback:http://www.frendsdom.com/user_feedback.php\n\nContact us : admin@frendsdom.com",$headers))

echo "mail sent";

else echo "failed";

//}

*/






/*
include('/home/frendryg/FunctionList.php');
include('class_lib.php');
//for($i=789;$i<=851;$i++){

$u=new user(811);

if(!$u->user_pic())
{
$t="\nWe would also like to encourage you to upload your real picture so that you can increase your chances of getting others interested in your profile.";
}

else 
{
$t=' ';
}

$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n";


if(mail($u->get_email(),"Take your profile picture down ","Hi ".$u->get_first()."\n\nSomeone reported us about explicitly obscene picture that you have used as your profile picture. We can't tolerate such actions. Take this picture down within 24 hours . Failing to do that would result into permanent deletion of your account from our end.",$headers))

echo "mail sent";

else echo "failed";

//}
*/





?>