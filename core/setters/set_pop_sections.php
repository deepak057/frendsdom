<?php

if(!empty($_POST['section'])){

//coulmn name
$coulmn=$_POST['section']."_section_enabled";

//get value for current user
$section_value= entity_value("userdata",$coulmn,"id",uid());

//update value
if(update_entity("userdata","id",uid(),$coulmn,!$section_value)){

echo "1";

}

}

?>