<?php

if(!empty($_POST['flag'])){

//create instance of current user
$lu=new user(uid());

//include Slide Panel class definition
include(get_module_path("panel".DS."left_panel.php"));

//display the Content of slide panel
$panel=new panel(uid());
$panel->get_panel_content($lu);

}

?>