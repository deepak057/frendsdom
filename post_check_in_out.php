<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['action'])) 
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}

if($_POST['action']=="notify")
{

if($result=$mysqli->query("select * from news4user{$_POST['id']} where news='check_in' && from_id='{$_SESSION['userid']}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                           
{
if($mysqli->query("update news4user{$_POST['id']} set viewed=0,when1='".date('Y-m-d H:i:s')."',viewed_on='' where news='check_in' && from_id='{$_SESSION['userid']}'"))
{

//handling e-mail news
email_news($_POST['id'],"check_in");

echo '1';
}
else echo '0';

break;

}
}

else {

if($mysqli->query("insert into news4user{$_POST['id']} (news,from_id,when1 ) values ('check_in','{$_SESSION['userid']}','".date('Y-m-d H:i:s')."')")){

//handling e-mail news
email_news($_POST['id'],"check_in");

echo '1';
}
else echo '0';

}

}


}

else {

if($mysqli->query("delete from news4user{$_POST['id']} where news='check_in' && from_id='{$_SESSION['userid']}'"))
echo '1';

else echo '0';

}

}


else 
{
header('location:home.php');
}


?>