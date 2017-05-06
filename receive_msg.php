<?php 

include("environment.php");
check_auth();

if(!empty($_POST['n']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 


$n=$_POST['n'];

if($n==1)
{

//retrieving data from user msg box which is prerequisite for creating temporary msg box table

$msgid=array();
$i=0;

$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select* from msgboxofuser{$_SESSION['userid']}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if($row['read1']=="no" && account_status($row['from1id']))
{
$msgid[$i]=$row['msgid'];
$i++;
}
}
}
}

//deleting temporary msg box table if already exists
$mysqli->query("drop table tempmsgboxofuser{$_SESSION['userid']}");


//creating temporary msgbox table

foreach( $msgid as $row ) {$ql[] ='("'.$row.'")'; }


if($mysqli->query("create table tempmsgboxofuser{$_SESSION['userid']} (msgid text (200),id Int Unsigned Not Null Auto_Increment,primary key(id))"))
{
if($mysqli->query("insert into tempmsgboxofuser{$_SESSION['userid']} (msgid) values ".implode(',',$ql))===false)
die("Failed to store temporary data"); 
}
}

$msgid=entity_value("tempmsgboxofuser".$_SESSION['userid'],"msgid","id",$n,$msg_inbox);

if(!update_entity("msgboxofuser".$_SESSION['userid'],"msgid",$msgid,"read2","yes",$msg_inbox))die("Error: Failed to update your database");

//displaying the message

$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
if($result=$mysqli->query("select DATE_FORMAT(when1,'%d %M %Y'),DATE_FORMAT(when1,'%r'),from1id,msgid,title1,read1,read2,msg  from msgboxofuser{$_SESSION['userid']} where msgid='{$msgid}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(!empty($row['msg']))
{
$name=user_name($row['from1id']);
?>
<style type="text/css">
#msgbutton li{list-style-type:none;float:right;}
#msgbutton li input {background:pink;border:1px solid black;font-size:.7em;margin-right:-5px;}
</style>

<span id='msgbutton' style="position:absolute;top:40px;right:5px;"><li><input type="button" value="Delete" onclick="delmsg1('<?php echo $msgid;?>');"></li><li><input type="button" value="Reply" onclick="showmsgmenu1();"></li></span>
<span id="message_count" style="position:absolute;top:70px;right:10px;font-size:1.3em;color:black;background:grey;padding:0 5;border:1px solid black;"></span>
<p><b>From:</b><a class="dui" data-hovercard-id="<?php echo $row['from1id']; ?>" href='<?php echo get_profile_url($row['from1id']); ?>'><?php echo $name;?> </a></p><p ><b>Sent:</b><?php echo $row[0]." at ".$row['1'];?></p><p><u><b><?php echo $row['title1'];?></b></u></p><div class="msg_text_container nice_scroll"><?php echo nl2br(auto_link_text(stripslashes($row['msg'])));?></div>
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