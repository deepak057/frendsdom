<?php

if(!empty($_REQUEST['conf'])){

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);

//form Updation query
$query=SQL_updation_query(

json_decode(stripslashes($_REQUEST['conf']),true),//configuration array
"userdata" ,//table to update
"where id=".uid() //condition

);

//execute query to update database
if($mysqli->query($query)){

//confirm success
echo "1";

}


else {

echo "0";

}


}


?>