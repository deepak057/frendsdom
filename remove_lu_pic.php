<?php

include("environment.php");
check_auth();

//deleting users profile pictures
delete_all_images("user_data/{$_SESSION['userid']}/");

//updating database
update_entity("userdata","id",$_SESSION['userid'],"picture","no");

//confirming success
echo "1";
?>