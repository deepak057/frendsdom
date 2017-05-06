<?php 

include("environment.php");
check_auth();

if((!empty($_POST['toids'])) && (!empty($_POST['msg'])) && (!empty($_POST['title'])) )
{

//extracting recipients ids 
$rcp_ids=array_unique(explode("|",$_POST['toids']));

//sending them messages
for($i=0;$i<sizeof($rcp_ids);$i++)
{
send_msg($_SESSION['userid'],$rcp_ids[$i],$_POST['title'],$_POST['msg']);
}

//if everything goes fine, then confirm it
echo "success";

}

else
{
header('location:home.php');
}

?>