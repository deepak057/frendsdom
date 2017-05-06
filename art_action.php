<?php

include('environment.php');
check_auth();

if(!empty($_POST['id']) && !empty($_POST['action']) && if_exists("userdata","id",$_POST['id']) && if_exists("user{$_SESSION['userid']}","listid",$_POST['id']) && if_exists("authorityrecpients4user".$_SESSION['userid'],'request_from',$_POST['id'],$authority_recpients_db) && !(if_exists("authorityrecpients4user".$_SESSION['userid'],'recpient_id',$_POST['id'],$authority_recpients_db)))
{
$d=date('Y-m-d H:i:s');

$mysqli =new mysqli($host,$db_user,$db_passwd,$authority_recpients_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}

if($_POST['action']=="allow")
{
if($mysqli->query("update authorityrecpients4user{$_SESSION['userid']} set recpient_id='{$_POST['id']}',when1='{$d}',request_from='' where request_from='{$_POST['id']}'") && $mysqli->query("insert into authorityrecpients4user{$_POST['id']} (recpient_id,when1 ) values ('{$_SESSION['userid']}','{$d}')")){
$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
if($mysqli->query("insert into news4user{$_POST['id']} (news,from_id,when1 ) values ('atr_granted','{$_SESSION['userid']}','{$d}')")){

//handling notification e-mail
email_news($_POST['id'],"atr_granted");

$r=true;
echo "1";
}
else {echo "Failed";$r=false;}
}
else echo "Failed";
}

else
{
if($mysqli->query("delete from authorityrecpients4user{$_SESSION['userid']} where request_from='{$_POST['id']}'")===false){
echo "Failed";$r=false;
}
else {
$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
if($mysqli->query("insert into news4user{$_POST['id']} (news,from_id,when1 ) values ('atr_rejected','{$_SESSION['userid']}','{$d}')")===false){
echo "Failed";$r=false;
}
else{
//handling notification e-mail
email_news($_POST['id'],"atr_rejected");

echo "1";$r=true;}
}


if(!empty($_POST['update'])&& $_POST['update']=="true" && $r)
{

$list=return_array_tweaked($authority_recpients_db,"tempauthorityrecpients4user".$_SESSION['userid'],"request_from");
for($i=0;$i<sizeof($list);$i++)
{
if($list[$i]==$_POST['id'])
{
unset($list[$i]);
break;
}
}

array_multisort($list);

//deleting temporary user table if already exists

$mysqli =new mysqli($host,$db_user,$db_passwd,$authority_recpients_db);
$mysqli->query("drop table tempauthorityrecpients4user{$_SESSION['userid']}");


//creating temporary user table if still there are more requests 

if(!empty($list))
{
foreach( $list as $row ) {$ql[] ='("'.$row.'")'; }

if($mysqli->query("create table tempauthorityrecpients4user{$_SESSION['userid']} (id Int Unsigned Not Null Auto_Increment,primary key(id),request_from varchar (20) not null)"))
{
if($mysqli->query("insert into tempauthorityrecpients4user{$_SESSION['userid']} (request_from) values ".implode(',',$ql)))
die( "Failed to create your database");
}
else die ("Failed to create your database");
}
else echo "Error: failed to update temporary table";
}
}

}
else 
{
header('location:home.php');
}

?>