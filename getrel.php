<?php

include("environment.php");
check_auth();

if(!empty($_POST['n']))
{

include('class_lib.php');

//compressing HTML content 
//ob_start("ob_gzhandler"); 


if($_POST['n']==0)
$_POST['n']=1;

$lu=new user($_SESSION['userid']);


$mysqli =new mysqli($host,$db_user,$db_passwd,$selected_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($result=$mysqli->query("select listid from user{$_SESSION['id']} limit ".(($_POST['n']-1)*10).",10"))
{

if($result->num_rows>0)
{

while($row=$result->fetch_array())  
{

if(!empty($row['listid']) && account_status($row['listid']))
{
?>

<li>
<table>
<tr>
<td><a href='<?php echo get_profile_url($row['listid']);?>' title="&lt;img src='<?php echo prof_pic($row['listid']); ?>' height='160' width='160' /&gt;"><b><?php echo user_name($row['listid']);?></a></b>
<span style="color:grey;"><?php echo $lu->get_relation_status($row['listid']);?></span>
</td>
</tr>
</table>
</li>

<?php
}
}
}
}

}

else
{
header('location:home.php');
}
?>