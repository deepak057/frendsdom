<?php

include('includes.php');

//for($i=83;$i<=150;$i++){ //needs to resume from here

$u=new user(0);

if($u->get_account_status()){

if(!$u->user_pic())
{
$t="<p><br/>We would also like to encourage you to upload your real picture so that you can increase your chances of getting others interested in your profile.</p>";
}

else 
{
$t=' ';
}

$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


if(mail($u->get_email(),"What is Frendsdom? It expands your world.","<p style='margin-bottom:30px;'><img src='".SITE_URL."/frendsdom.gif'/></p>Hi ".$u->get_first().",<p><br/>You haven't been very active on Frendsdom. Maybe because you don't find your relations already there or you haven't explored it yet.</p> .
<p>Let us take this opportunity to explain to you what Frendsdom is all about. </p>
<p style='background:skyblue;padding:5px;border:1px solid #000;margin:20px 0px;'><b>Recommended: Just follow <a href='".SITE_URL."/enable_intro.php'>this link</a> (Interactive graphical introduction to website) and everything will be clear to you very easily.</b></p>
<h2 style='margin:20px 0px;'>Spend your points, expand your world</h2>
<ul>
<li>
<h3 style='border-bottom:1px dotted #000;margin-bottom:10px;padding-bottom:5px;'>Frendsdom aims to expand your existing friend circle</h3>
<p>In short, on Frendsdom, you have to</p>
<ol>
  <li> Earn points</li>
  <li>Find people of your interest</li>
  <li>Offer them points to be part of your relation lists</li>
</ol>
Regardless of whatever it sounds like, it is huge fun.
</li>
<li>
<h3 style='border-bottom:1px dotted #000;margin-bottom:10px;padding-bottom:5px;'>Earn/make Points</h3>
<p>You get 10 points by default</p>
<p><br/>You get your sum of points incremented every time:</p>
<ol>
    <li>Someone likes your post(+1)</li>
    <li>You accept someone's invitation(+1)</li>
    <li>Someone accepts your invitation(+1)</li>
    <li>Someone comments on any content such as post,profile belonging to you(+1)</li>
    <li>Someone donates you points(+donated points)</li>
</ol>
</li>
<li>
<h3 style='border-bottom:1px dotted #000;margin-bottom:10px;padding-bottom:5px;'>Find people of your interest</h3>
<p>Find people of your interest by </p>
<ol>
<li>Age</li>
<li>Sex</li>
<li>Location</li>
</ol>
<p>Then offer them any sum of your points as a motive for them to accept your invitation.</p>
<p><br/>This way, expand your world.</p>
{$t}
</li>
<li>
<h3 style='border-bottom:1px dotted #000;margin-bottom:10px;padding-bottom:5px;'>Invite your contacts</h3>
<p>Adding your existing relations will provide you initial support for expanding your acquaintance zone worldwide.</p>
<p><br/>
Try to search for your friends,colleagues etc by typing their name or e-mail address.</p>
<p><br/>Ask/invite your friends to join this  website ,send them invitation,nudge them ,control their profile appearance and lot more. Socialize online in completely new way.</p>
<p><br/><b>Remember that it's your relations who will help you increase your points, so more relations you have more points you get and more points you get, more new people you can add.</b></p> 
<p> <br/>To invite your friends, simply go to your <a href='".SITE_URL."/home.php'>home page</a> and click on <b>'Invite your contacts'</b> link on the bottom of right hand sidebar.</p>
</li>
<li>
<h3 style='border-bottom:1px dotted #000;margin-bottom:10px;padding-bottom:5px;'>Your homepage has two views</h3>
<ol>
<li>Post View: for posting your status.</li>
<li>Picture View (default view): for managing your profile pictures.</li>
</ol>
<p>You can switch between those two views anytime you want.</p>
<p style='background:skyblue;padding:5px;border:1px solid #000;margin:20px 0px;'><b>Recommended: Just follow <a href='".SITE_URL."/enable_intro.php'>this link</a> (Interactive graphical introduction to website) and everything will be clear to you very easily.</b></p>
</li>
<li><h3 style='border-bottom:1px dotted #000;margin-bottom:10px;padding-bottom:5px;'>Explore this website</h3>
<p>
Try to explore this website and dig it deep, so that you can get the best out of it.</p>
</li>
<li><h3 style='border-bottom:1px dotted #000;margin-bottom:10px;padding-bottom:5px;'>Give your feedback</h3>
<p>Please give us your feedback <a href='".SITE_URL."/user_feedback.php'>here</a>.</p>
</li>
</ul>
<div style='margin-top:50px;text-align:center;'>
<p><br/>Thank you! Hope you are coming soon.</p>
<p>Visit <a href='http://blog.frendsdom.com'>Our Blog</a>&nbsp;|&nbsp;Feel free to contact us at: admin@frendsdom.com&nbsp;|&nbsp;".current_year()." &copy; Frendsdom.com</p>
</div>
",$headers))


echo "mail sent";

else echo "failed";

}

//}



?>
                            
                            
                            
                            