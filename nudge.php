<?php

include("environment.php");
check_auth();

if((!empty($_POST['send'])) && ($_POST['send']=="yes") && (!empty($_POST['nudgetext'])) && (!empty($_POST['userlist'])))
{

$nudgetext=null;$list=null;$userlist=null;$letbeknown=null;$file_ok="yes";

//verifying received text
if(strlen($_POST['nudgetext'])>100)
$nudgetext=addslashes(split_into_lines( htmlentities(trim(substr($_POST['nudgetext'],0,99))),70));
else
$nudgetext=addslashes(split_into_lines(htmlentities(trim($_POST['nudgetext'])),70));

//list of recepeints
$userlist=$_POST['userlist'];

//if any list included, then retrieving ids of recipients from corresponding lists
$j=0;
$userlist1=array();
$list=null;

if(!empty($_POST['list1']))
{
$list=explode(" ",$_POST['list1']);
for($i=0;$i<sizeof($list);$i++)
{
$mysqli=$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select * from user{$_SESSION['userid']}";

if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
$index=$list[$i]."id";
if(!empty($row[$index]))
{
$userlist1[$j]=$row[$index];
$j++;
}
}
}
else die("failed");
}
}
$userlist=array_unique(array_merge(explode(" ",$userlist),$userlist1));
$userlist=implode(",",$userlist);
$list=implode(",",$list);
}
else
{
$list=null;
$userlist=explode(" ",$userlist);
$userlist=implode(",",$userlist);
}


//checking whether recipients are to know who else got included in same nudge set
if(!empty($_POST['known']))
$letbeknown=$_POST['known'];
else 
$letbeknown="no";

//creating nudgeset table
$nudgeset="nudgeset".$_SESSION['userid'].mktime();
$mysqli=$mysqli=new mysqli($host,$db_user,$db_passwd,$nudgesets_db);
if($mysqli===false){die("Could not connect to database");}
if(!$mysqli->query("create table {$nudgeset} (`id` Int Unsigned Not Null Auto_Increment,`fromid` VarChar(50) Not Null ,`when1` datetime,`nudgetext` varchar(100) not null default 'No text',`recepeints` text(5000),`letbeknown` varchar (5) default 'no',`nudgeclip` MediumBlob ,`nudgeclip_type` varchar(20) ,`nudgeclip_size` varchar(50),`nudgepic` MediumBlob,`nudgepic_type` varchar(20) ,`nudgepic_size` varchar(50),`included_lists` varchar(100) , PRIMARY KEY (`id`))") || !$mysqli->query("insert into {$nudgeset} (fromid,when1,nudgetext,recepeints,letbeknown,included_lists) values('{$_SESSION['userid']}','".date('Y-m-d H:i:s')."','{$nudgetext}','{$userlist}','{$letbeknown}','{$list}')"))
die ("Error: failed to create database");


//updating recipients nudgeboxes
$userlist=explode(",",$userlist);
$success=0;
$mysqli=new mysqli($host,$db_user,$db_passwd,$nudgeset_records);
if($mysqli===false)
{
die("Could not connect to database");
}
for($i=0;$i<sizeof($userlist);$i++)
{
$sql="insert into nudgeboxofuser{$userlist[$i]} (fromid,fromname,nudgeset) values ('{$_SESSION['userid']}','{$_SESSION['userfulname']}','{$nudgeset}')";
if($mysqli->query($sql)===true)
{
$success++;
//email_news($userlist[$i],"nudge");
}
}

//uploading files and confirming deleivery of nudgeset

if(($success==sizeof($userlist)) || ($success==sizeof($userlist)-1))
{
$clip_uploaded=null;$pic_uploaded=null;$all_done=true;

//uploading nudgeclip
if(($_FILES["nudgeclip"]["type"] == "audio/wav") && ($_FILES["nudgeclip"]["size"]<=800000))
{
if(isset($_FILES['nudgeclip'])) 
{									
if($_FILES['nudgeclip']['error'] == 0) 
{
$dbLink=$mysqli=new mysqli($host,$db_user,$db_passwd,$nudgesets_db);
if(mysqli_connect_errno()) {
die("MySQL connection failed: ". mysqli_connect_error());
}
if($dbLink->query("update {$nudgeset} set nudgeclip_type='".$dbLink->real_escape_string($_FILES['nudgeclip']['type'])."',nudgeclip_size='".intval($_FILES['nudgeclip']['size'])."',nudgeclip='".$dbLink->real_escape_string(file_get_contents($_FILES  ['nudgeclip']['tmp_name']))."' where id=1")) 
$clip_uploaded="yes";
else $clip_uploaded="no";
}
}
}
else if(($_FILES["nudgeclip"]["type"] == "audio/wav") && ($_FILES["nudgeclip"]["size"]>800000))
$clip_uploaded="bad";
else if(empty($_FILES['nudgeclip']['name']))
$clip_uploaded=null;
else if($_FILES["nudgeclip"]["type"] != "audio/wav") 
$clip_uploaded="bad";



//uploading nudgepic
if((($_FILES["nudgepic"]["type"] == "image/gif")|| ($_FILES["nudgepic"]["type"] == "image/jpeg")) && ($_FILES["nudgepic"]["size"]<=800000))
{
if(isset($_FILES['nudgepic'])) 
{
if($_FILES['nudgepic']['error'] == 0) 
{
$dbLink = $mysqli=new mysqli($host,$db_user,$db_passwd,$nudgesets_db);
if(mysqli_connect_errno()) {
die("MySQL connection failed: ". mysqli_connect_error());
}
if($dbLink->query("update {$nudgeset} set nudgepic_type='".$dbLink->real_escape_string($_FILES['nudgepic']['type'])."',nudgepic_size='".intval($_FILES['nudgepic']['size'])."',nudgepic='".$dbLink->real_escape_string(file_get_contents($_FILES  ['nudgepic']['tmp_name']))."' where id=1")) 
$pic_uploaded="yes";
else
$pic_uploaded="no";
}
}
}
else if((($_FILES["nudgepic"]["type"] == "image/gif")|| ($_FILES["nudgepic"]["type"] == "image/jpeg")) && ($_FILES["nudgepic"]["size"]>800000))
$pic_uploaded="bad";
else if ( ($_FILES["nudgepic"]["type"] != "image/gif") && ($_FILES["nudgepic"]["type"] == "image/jpeg") )
$pic_uploaded="bad";
else if(empty($_FILES['nudgepic']['name']))
$pic_uploaded=null;

if( ($pic_uploaded=="bad") || ($clip_uploaded=="bad"))
$all_done=false;

//if all the data was successfully handled
if($all_done)
{
echo "success";
$result=1;
}

//else deleting just created nudgeset due to uploading of bad files
else
{
$mysqli=$mysqli=new mysqli($host,$db_user,$db_passwd,$nudgesets_db);
if($mysqli->query("drop table {$nudgeset}"))
{
echo  "failed to upload files";$result=0;
}
}
}

else
echo "Failed to nudge";

?>
<script>
window.top.window.stopUpload1(<?php echo $result; ?>);
</script>
<?php
}

else
{
header('location:home.php');
}
?>