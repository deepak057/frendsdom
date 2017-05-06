<?php

include('includes.php');

$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$sub="Know some random people from all around the world";

//for($i=32;$i<=100;$i++){//needs to resume from here

$lu=new user(0);

if($lu->get_account_status()){

//retrieve slide panel configuration
include('../modules/panel/conf.php'); 

//get suggestions
$suggetions=$lu->get_suggestions(get_asl_query());


$msg ="<!doctype html><head><style type='text/css'>
.fl{float:left;}
.fr{float:right;text-align:left;width:240px;}
.clear{clear:both;}
.block{margin:10px;width:400px;padding:10px;background:#eee;}
.grey{color:#999;}
.name{text-decoration:none;color:#000;font-weight:bold;}
.button{cursor:pointer;background:#000;color:#fff;opacity:.8;border:none;padding:3px 5px;text-decoration:none;}
p{margin:10px 0px;padding:10px 0px;}.make_sure{padding:5px;background:pink;border:1px solid #000;margin-bottom:10px;}
</style>
</head>
<body>
<div>

<div class='make_sure'>Please make sure you enable images contained in this mail in case they are blocked by your email service provider.</div>
<p style='margin-bottom:30px;'><img src='".SITE_URL."/frendsdom.gif'/></p><p>Hi {$lu->get_first()}, hope you're doin' well !</p>
<p>You currently have ".get_points($i)." points. Here are some random people you might want to send invitation to and offer them a few points so that they actually accept it. </p>";


foreach($suggetions as $suggetion){

$hh=($suggetion['sex']=="female")? "her": "him";



$msg=$msg."<div class='block'>
<div class='fl'>
<a href='".get_profile_url($suggetion['id'],true)."'><img src='".prof_pic($suggetion['id'])."' width='150' height='150'/></a>
</div>
<div class='fr'><a class='name' href='".get_profile_url($suggetion['id'],true)."'>".$suggetion['first']." ".$suggetion['last']."</a>
<div class='grey'>{$suggetion['country']}</div>
<p>You should offer {$hh} ".get_recommended_points($suggetion['id'])." point(s)</p>
<p><a class='button' href='".get_profile_url($suggetion['id'],true)."'>Invite {$hh}</a></p>
</div>
<div class='clear'></div>

</div>";

}




$msg=$msg."</div><div style='margin-top:50px;text-align:center;'>
<div>Thank you! Hope you are coming soon.</div>
<p>Visit <a href='http://blog.frendsdom.com'>Our Blog</a>&nbsp;|&nbsp;Feel free to contact us at: admin@frendsdom.com&nbsp;|&nbsp;".current_year()." &copy; Frendsdom.com</p>
</div>
</body></html>";

if(mail($lu->get_email(),$sub,$msg,$headers))echo "sent";else echo "failed";
}
//}
?>
