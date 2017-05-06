<?php

include("includes.php");

//subject
$sub="Share something interesting, make more points";

//for($i=2457;$i<=2857;$i++){ //needs to resume from here

$lu=new user(0);

if($lu->get_account_status()){

$msg="<!doctype html><head>

<style type='text/css'>
p{margin:10px 0;}
</style>
</head><body>
<p style='margin-bottom:30px;'><img src='".SITE_URL."/frendsdom.gif'/></p>
<p style='margin-bottom:30px'>Hi {$lu->get_first()}, hope you're doin' well !</p>

<p>
You don't seem to have had a chance to share your status very often. You have very few status updates so your relations don't really know what you've been up to. We would like to encourage you to come over and say Hello to the world to let them know you are alright.
</p>

<p>By posting interesting status you get -</p>

<h4>1) Extra points</h4>
<p>If someone makes a comment on your post, you get one extra point. So if you get, let's say 10 comments, you get 10 more points</p>

<h4>2) Even more points</h4>
<p>If someone gives their feedback to your post, again you get points incremented in this way-</p>
<div><img src='".SITE_URL."/like.bmp' height='15' width='15'/>&nbsp;Like- 1 point</div>
<div><img src='".SITE_URL."/awesom.bmp' height='15' width='15'/>&nbsp;Awesome- 2 points</div>
<div><img src='".SITE_URL."/best.bmp' height='15' width='15'/>&nbsp;Best- 3 points</div>
<h3>On Frendsdom, we made it easy to come up with interesting status post</h3>
<p>We have recently launched a feature called 'Post suggestion' that lets you easily discover something interesting that you can set as your post. You can surf through quotes, news, movies etc to find an attractive status that would help you earn more points.</p>
<p>So Let's start having fun, go to your <a href='".SITE_URL."/home.php?noty_action=s_v'>home</a> and try 'Post Suggestion'.</p>
<div style='margin-top:50px;text-align:center;border-top:1px dotted #d2d2d2;padding-top:10px;'>
<div>Thank you! Hope you are coming soon.</div>
<p>Visit <a href='http://blog.frendsdom.com'>Our Blog</a>&nbsp;|&nbsp;Feel free to contact us at: admin@frendsdom.com&nbsp;|&nbsp;".current_year()." &copy; Frendsdom.com</p>
</div>

</body></html>";



if(mail($lu->get_email(),$sub,$msg,$headers))
echo "sent";
else echo "failed";
}
//}
?>