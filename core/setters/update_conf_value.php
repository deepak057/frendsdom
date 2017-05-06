<?php

$lu=new user($_SESSION['userid']);

//update configuration variable's value
if($lu->update_conf_option_value($_REQUEST['var'],$_REQUEST['value']))
echo "1";
else 
echo "0";

?>