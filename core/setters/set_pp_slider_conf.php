<?php

if(!empty($_REQUEST['conf'])){

//save Profile Page Slider configuration
update_entity("userdata","id",uid(),"pp_slider_conf",$_REQUEST['conf']);

//confirm success
echo "1";

}


?>