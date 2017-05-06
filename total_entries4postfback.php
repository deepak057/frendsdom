<?php

include("environment.php");
check_auth();

if(!empty($_POST['p_id']))
{

echo total_entries($_POST['p_id'],"fromid",$fback_to_posts_db);
}

else
{
header('location:home.php');
}
?>