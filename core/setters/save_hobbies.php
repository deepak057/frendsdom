<?php


//get "Hobbies" class
include(get_module_path("hobbies".DS."hobbies.php"));

$hb=new hobbies();

if($hb->save_hobbies(json_decode(stripslashes($_REQUEST['hobbies']),true))){

echo "1";

}

else {

echo "0";


}

?>