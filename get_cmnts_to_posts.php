<?php

include("environment.php");
check_auth();

if(!empty($_POST['p_id']) && !empty($_POST['total']) && !empty($_POST['start']) && !empty($_POST['end']))
{

//displaying comments
put_comments_on_post($_POST['p_id'],$_POST['total'],$_POST['start'],$_POST['end'],false,false);


}

else 
{
header('location:home.php');
}

?>