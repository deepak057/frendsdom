<?php

if(!empty($_REQUEST['last_uid'])){

	//include module
         include(get_module_path("discover/discover_people.php"));
         $dp_module=new discover_people();
        
	//put content
	$dp_module->get_view($_REQUEST['last_uid']);


}

?>