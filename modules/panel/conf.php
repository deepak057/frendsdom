<?php

/*
*This script retrieves the configuration for slide panel.
*This script relies on object of class 'user' and assumes that class 'user' has already been instantiated with object '$lu'. 
*So class user must be initialized with object $lu prior to calling this script
*/

$_POST['sex']=(!$lu->conf_option_value("lp_conf_sex"))? "all":$lu->conf_option_value("lp_conf_sex");
$_POST['age']=(!$lu->conf_option_value("lp_conf_age"))? "all":$lu->conf_option_value("lp_conf_age");
$_POST['country']=(!$lu->conf_option_value("lp_conf_country"))? "all":$lu->conf_option_value("lp_conf_country");
$_POST['state']=$lu->conf_option_value("lp_conf_state");
$_POST['city']=$lu->conf_option_value("lp_conf_city");
$_POST['check_pic']=($lu->conf_option_value("lp_conf_pp")=="false")? "":"true";
$_POST['filter_ids']=true;


?>