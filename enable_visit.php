<?php

include("environment.php");
check_auth();

if(!empty($_GET['k'])){

//get user id
$id=entity_value($tbl_key_id_mapping,"user_id","`key`",$_GET['k'],$GLOBALS['other_data_db']);

//redirect to user's profile
header('location:'.get_profile_url($id));


}

?>