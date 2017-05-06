<?php 

include("environment.php");
check_auth();

if(!empty($_POST['list']))
{

//function for determining total number of messages by specified user
function total_msgs_by($msgbox,$id,$type){if((!empty($type)) && (!empty($id)) && (!empty($msgbox))){$link = mysql_connect($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd']);if($type=="unread"){mysql_select_db($GLOBALS['msg_inbox'], $link);$result = mysql_query("SELECT * FROM {$msgbox} where from1id={$id} && read1='no' && read2='no'", $link);}if($type=="read"){mysql_select_db($GLOBALS['msg_inbox'], $link);$result = mysql_query("SELECT * FROM {$msgbox} where from1id={$id} && (read1='yes' || read2='yes')", $link);}if($type=="sent"){mysql_select_db($GLOBALS['msg_sentbox'], $link);$result = mysql_query("SELECT * FROM {$msgbox} where to1id={$id}", $link);}return mysql_num_rows($result);}else return null;}

//compressing HTML content 
//ob_start("ob_gzhandler"); 

$i=0;

if($_POST['list']=="unread")
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
if($mysqli===false)
{				
die("<p>Error :".mysqli_connect_error());
}
$sql="select* from msgboxofuser{$_SESSION['userid']} where read1='no' && read2='no'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(!empty($row['from1id']))
{
$senders[$i]=$row['from1id'];
$i++;
}
}
}
}

if($i>0)
{
$unique=array_unique($senders);
array_multisort($unique);
for($i=0;$i<sizeof($unique);$i++)
{
?>
<li id="li<?php echo $unique[$i] ;?>"><a id="div<?php echo $unique[$i];?>" href='javascript:load_msglist("<?php echo $unique[$i];?>","unread");' title="click to see messages sent by this user"><div><table><tr><td width="250"><?php echo user_name($unique[$i])."</td><td style='color:grey;' id='msgsfromuser{$unique[$i]}'> ".total_msgs_by("msgboxofuser".$_SESSION['userid'],$unique[$i],"unread");?></td></tr></table></div></a><div id="<?php echo "user{$unique[$i]}";?>" class="list_space nice_scroll"></div></li>
<?php
}
}
else echo "No unread messages";
}

else if($_POST['list']=="read")
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
if($mysqli===false)
{				
die("<p>Error :".mysqli_connect_error());
}
$sql="select* from msgboxofuser{$_SESSION['userid']} where read1='yes'||read2='yes'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(!empty($row['from1id']))
{
$senders[$i]=$row['from1id'];
$i++;
}
}
}
}

if($i>0)
{
$unique=array_unique($senders);
array_multisort($unique);
for($i=0;$i<sizeof($unique);$i++)
{
?>
<li id="li<?php echo $unique[$i] ;?>"><a id="div<?php echo $unique[$i];?>" href='javascript:load_msglist("<?php echo $unique[$i];?>","read");' title="click to see messages sent by this user"><div><table><tr><td width="250"><?php echo user_name($unique[$i])."</td><td style='color:grey;' id='msgsfromuser{$unique[$i]}'> ".total_msgs_by("msgboxofuser".$_SESSION['userid'],$unique[$i],"read");?></td></tr></table></div></a><div id="<?php echo "user{$unique[$i]}";?>" class="list_space"></div></li>
<?php
}
}
else echo "No read messages";
}

else if($_POST['list']=="sent")
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_sentbox);
if($mysqli===false)
{				
die("<p>Error :".mysqli_connect_error());
}
$sql="select* from sentboxofuser{$_SESSION['userid']}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(!empty($row['to1id']))
{
$receivers[$i]=$row['to1id'];
$i++;
}
}
}
}

if($i>0)
{
$unique=array_unique($receivers);
array_multisort($unique);
for($i=0;$i<sizeof($unique);$i++)
{
?>
<li id="li<?php echo $unique[$i] ;?>"><a id="div<?php echo $unique[$i];?>" href='javascript:load_msglist("<?php echo $unique[$i];?>","sent");' title="click to see messages sent by this user"><div><table><tr><td width="250"><?php echo user_name($unique[$i])."</td><td style='color:grey;' id='msgsfromuser{$unique[$i]}'> ".total_msgs_by("sentboxofuser".$_SESSION['userid'],$unique[$i],"sent");?></td></tr></table></div></a><div id="<?php echo "user{$unique[$i]}";?>" class="list_space"></div></li>
<?php
}
}
else echo "No sent messages";
}
}

else
{
header('location:home.php');
}
?> 