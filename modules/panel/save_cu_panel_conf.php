<?php

include("includes.php");

if(!empty($_POST['flag']))
{

//instantiating class user
$lu=new user($_SESSION['userid']);

//updating values
$lu->update_conf_option_value("lp_conf_sex",$_POST['sex']);
$lu->update_conf_option_value("lp_conf_age",$_POST['age']);
$lu->update_conf_option_value("lp_conf_country",$_POST['country']);
$lu->update_conf_option_value("lp_conf_state",$_POST['state']);
$lu->update_conf_option_value("lp_conf_city",$_POST['city']);
$lu->update_conf_option_value("lp_conf_pp",$_POST['cu_lm_pp']);
$lu->update_conf_option_value("lp_conf_view",$_POST['cu_lm_view']);

//confirming success
echo "1";

}

else{
header('location:home.php');
}
?>