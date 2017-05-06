<?php 

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['type']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 


if($_POST['type']=="unread")
{
$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
if($mysqli===false)
{				
die("<p>Error :".mysqli_connect_error());
}
$sql="select DATE_FORMAT(when1,'%d-%m-%y'),msgid,title1,read1,read2 from msgboxofuser{$_SESSION['userid']} where from1id='{$_POST['id']}'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if($row['read1']=='no' && $row['read2']=='no' )
{
?>
<a id="<?php echo $row['msgid'];?>" href="javascript:loadmsg('unread','<?php echo $row['msgid'];?>','<?php echo $_POST['id'];?>');" title="Load this message">
<li>
<table><tr><td width="300"><?php echo $row['title1'];?></td>
<td style="color:grey;"><?php echo $row[0];?></td></tr>
</table>
</li></a>
<?php 
}
}
}
}
}


if($_POST['type']=="read")
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
if($mysqli===false)
{				
die("<p>Error :".mysqli_connect_error());
}
$sql="select DATE_FORMAT(when1,'%d-%m-%y'),msgid,title1,read1,read2 from msgboxofuser{$_SESSION['userid']} where from1id='{$_POST['id']}'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if($row['read1']=='yes' || $row['read2']=='yes' )
{
?>
<a id="<?php echo $row['msgid'];?>" href="javascript:loadmsg('read','<?php echo $row['msgid'];?>','<?php echo $_POST['id'];?>');" title="Load this message">
<li>
<table><tr><td width="300"><?php echo $row['title1'];?></td>
<td style="color:grey;"><?php echo $row[0];?></td></tr>
</table>
</li></a>
<?php 
}
}
}
}
}

else if($_POST['type']=="sent")
{
$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_sentbox);
if($mysqli===false)
{				
die("<p>Error :".mysqli_connect_error());
}
$sql="select DATE_FORMAT(when1,'%d-%m-%y'),msgid,title1 from sentboxofuser{$_SESSION['userid']} where to1id='{$_POST['id']}'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
?>
<a id="<?php echo $row['msgid'];?>" href="javascript:loadmsg('sent','<?php echo $row['msgid'];?>','<?php echo $_POST['id'];?>');" title="Load this message">
<li>
<table><tr><td width="300"><?php echo $row['title1'];?></td>
<td style="color:grey;"><?php echo $row[0];?></td></tr>
</table>
</li></a>
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