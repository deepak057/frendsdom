<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['table']) && !empty($_POST['entity']))
{

if(empty($_POST['database']))
$_POST['database']=$selected_db;

echo total_entries($_POST['table'],$_POST['entity'],$_POST['database']);
}

else
{
header('location:home.php');
}
?>