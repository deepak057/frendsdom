<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//getting user's sex
if(user_sex($_POST['id'])=="female")
$hh="her";else $hh="him";


echo "

<div class='fr'><span class='red_onhover' onclick='hide_otherAction();' title='Close'>&#215;</span></div><div class='clear'></div><table cellspacing='10'><tr><td align='left' valign='top'><h3><img src='images/spend.png' align='middle' />Donate your points</h2>

<p class='light_text' style='position:relative;top:-10px;'>Points donated by you will be deduced from <br/>your  account and will be added to receiver's account</p>

Donate {$hh} <input class='blue_onhover offer_point_field' type='text' onkeyup='checkInput(this)' size='2'/> points<br/><br/><input type='button' class='special_btn' value='Donate' id='donate_points'/></td><td><img height='230' width='230' src='".prof_pic($_POST['id'])."'/></td></tr></table>

";


//displaying logged in user's sum of points
put_lu_points($_SESSION['userid'],"position:absolute;top:1px;left:-110px;");


}
else{
header('location:home.php');
}
?>