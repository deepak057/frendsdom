<?php

include("environment.php");

function email_news($from,$news){

include('class_lib.php');

$u=new user($from);
$lu=new user($_SESSION['userid']);

if($lu->get_e_mail_notification()){

if($u->get_sex()=="female"){$h="her";$hh='she';}else {$h='his';$hh='he';}

switch($news){

case "atr_granted":
$t=$u->get_name()." has granted you the authority to change appearance of {$h} profile";
break;
case "atr_rejected":
$t=$u->get_name()." has rejected your authority request";
break;
case "pac":
$t=$u->get_name()." has changed appearance of your profile";
break;
case "atr_revoked":
$t=$u->get_name()." has revoked your authority to change appearance of {$h} profile";
break;
case "invitetion_accepted":
$t=$u->get_name()." has accepted your invitation.".ucwords($hh)." is now in your ".get_list_status($from)." list";
break;
case "invitetion_rejected":
$t=$u->get_name()." has rejected your invitation.";
break;
case "fback2profile":
$t=$u->get_name()." has given {$h} feedback to your profile.";
break;
case "check_in":
$t=$u->get_name()." has viewed your sharebox";
break;
case "commentOnProfile":
$t=$u->get_name()." has made a comment on your profile";
break;
case "commentOnpic":
$t=$u->get_name()." has made a comment on one of your collection picture";
break;
}
mail($lu->get_email(),"Frendsdom.com-news" ,"Frendsdom.com-a social web application\n\nHi ".$lu->get_first().",\n{$t}.\n\nTo see full news please go to your home page \nYour home:http://frendsdom.com/home.php\n\nTo disable further e-mail notification please go through follwong steps:\n\n1)Go to your profile:http://frendsdom.com/visit.php?id={$_SESSION['userid']}\n2)Hover your cursor on 'other actions' menu\n3)Click on 'preferences'\n\n\nContact us:admin@frendsdom.com");
}

}

email_news("8","commentOnpic");

?>