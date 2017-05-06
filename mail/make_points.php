<?php

include("includes.php");

//subject
$sub="Lets play a game, make more points";


//for($i=2101;$i<=2383;$i++){

$lu=new user(0);

if($lu->get_account_status()){

$msg=$mail_header."

<style type='text/css'>
ol li {
margin-bottom:8px;
}
ol li,p,h3{color:#666;}
</style>

<p style='margin-bottom:30px'>Hi {$lu->get_first()}, hope you're doin' well !</p>

<p>Here's another innovation at Frendsdom. The new feature is called 'Make Points'. The feature's functionality sounds more like a casual video game. This it how it works.</p>

<h3>Lets make some points and know more random people</h3>

<ol>

   <li> You will be shown pictures of five random users.</li>
   <li> You have to drag the picture and drop it to the name you think belongs to it.</li>
   <li> For every right match you'll get one extra point.</li>
    <li>For every 3 wrong drops you'll get one point deduced.</li>
   <li>Remember, you've got 30 seconds to complete.</li>

</ol>


<p style='margin-top:30px;'>The feature aims to get you to see more and more random people from all around the world.</p>

<p>Hope you're going to like it. Click <a href=".SITE_URL."/home.php?noty_action=view_mp>here</a> to see it in action.</p>

".$mail_footer;


if(mail($lu->get_email(),$sub,$msg,$headers))
echo "sent";
else echo "failed";

}

//}





?>