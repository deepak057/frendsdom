<?php 

include("environment.php");
check_auth();

if((!empty($_POST['id'])) && (!empty($_POST['msgid'])) && (!empty($_POST['list'])))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

$list=$_POST['list'];

if($list=="read" || $list=="unread")
{
if($list=="unread")
{
if(!update_entity("msgboxofuser".$_SESSION['userid'],"msgid",$_POST['msgid'],"read2","yes",$msg_inbox))
die("Error : Failed to update your database");
}

//displaying message

$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
if($result=$mysqli->query("select DATE_FORMAT(when1,'%d %M %Y'),DATE_FORMAT(when1,'%r'),from1id,msgid,title1,read1,read2,msg from msgboxofuser{$_SESSION['userid']}  where msgid='{$_POST['msgid']}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{

$account_status=account_status($row['from1id']);

if($account_status)
{

echo "<div><div id='msg_container'><p><b>From:</b><a href='".get_profile_url($row['from1id'])."' class='dui' data-hovercard-id='{$row['from1id']}'>".user_name($row['from1id'])."</a></p><p><b>Sent:</b> {$row[0]} at {$row[1]}</p><p><b><u>{$row['title1']}</u></b></p><div class='msg_text_container nice_scroll'>".nl2br(auto_link_text(stripslashes($row['msg'])))."</div></div>";
}

else
{
echo "<div><div id='msg_container'><p><b>From:</b><a  href='#'>".user_name($row['from1id'])."</a></p><p><b>Sent:</b> {$row[0]} at {$row[1]}</p><p><b><u>{$row['title1']}</u></b></p><div class='msg_text_container nice_scroll'>".nl2br(auto_link_text($row['msg']))."</div></div>";
}
if($account_status)
{
?>
<ul class='msgbutton'>
<a href='javascript:delmsg("in","<?php echo $row['msgid'];?>","<?php echo $row['from1id'];?>")'><li>Delete</li></a>
<a href='javascript:reply();'><li >Reply</li></a>
<?php
}
else
{
?>
<ul class='msgbutton' style='right:100px;'>
<a><li >This user has closed his/her account</li></a>
<a href='javascript:delmsg("in","<?php echo $row['msgid'];?>","<?php echo $row['from1id'];?>")'><li>Delete</li></a>
<?php
}
echo "</ul>
</div>
<div id='msgmenu'>
<p style='text-align:left'>To: ".user_name($row['from1id'])."</p>
<p style='text-align:left'>From: {$_SESSION['userfulname']}</p>
<p>
<form name='msgform' onsubmit='return false'>
<input type='hidden' name='fromid' value='{$row['from1id']}'>
<div style='text-align:left'>Title <input type='text' name='title' placeholder='No title' value=' No title ' class='blue_onhover' size='45'></div>
</br><div style='text-align:left'>Type your text here</div><textarea name='msg' style='width:350px;height:170px;' id='txt_msg' class='blue_onhover flexible_textarea'></textarea>
</br></br><input type='submit' class='special_btn' value='Send now' onclick='sendmsg()'>&nbsp;&nbsp;<input type='button' onclick='offmsg()' class='special_btn redback' value='Cancel' >
</form></p>
</div>";}}}

}

else if($list=="sent")
{

$msgread=0;$msg=null;$bgcolor=null;

$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
if($result=$mysqli->query("select read1,read2 from msgboxofuser{$_POST['id']}  where msgid='{$_POST['msgid']}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if($row['read1']=="yes" || $row['read2']=="yes" )
$msgread++;
}
}
else $msgread++;
}


if($msgread>=1){$bgcolor="grey";$msg="Msg read by recpeint";}
else{$bgcolor="pink";$msg="Msg not read by recpeint yet";}

$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_sentbox);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
if($result=$mysqli->query("select DATE_FORMAT(when1,'%d %M %Y'),DATE_FORMAT(when1,'%r'),to1id,title1,msg,msgid from sentboxofuser{$_SESSION['userid']}  where msgid='{$_POST['msgid']}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{

$account_status=account_status($row['to1id']);

if($account_status)
{


echo "<div><div id='msg_container'><p><b>To :</b><a class='dui' data-hovercard-id='{$row['to1id']}' href='".get_profile_url($row['to1id'])."'>". user_name($row['to1id'])."</a></p><p><b>Sent:</b> {$row[0]} at {$row[1]}</p><p><b><u>{$row['title1']}</u></b></p><div class='msg_text_container nice_scroll'>".nl2br(auto_link_text(stripslashes($row['msg'])))."</div></div>";
}

else
{
echo "<div><div id='msg_container'><p><b>To :</b><a href='#'>". user_name($row['to1id'])."</a></p><p><b>Sent:</b> {$row[0]} at {$row[1]}</p><p><b><u>{$row['title1']}</u></b></p><div class='msg_text_container nice_scroll'>".nl2br(auto_link_text($row['msg']))."</div></div>";
}
if($account_status)
{

?>
<ul class='msgbutton' style="right:150px;">
<li style='background:<?php echo $bgcolor;?>;'><?php echo $msg;?></li>
<a href='javascript:delmsg("sent","<?php echo $row["msgid"];?>","<?php echo $row['to1id'];?>");'><li >Delete</li></a>
<a href ='javascript:reply();'><li>Text again</li></a>
<?php
}
else
{
?>
<ul class='msgbutton' style="right:50px;">
<a href ='#'><li>This user has closed his/her account</li></a>
<a href='javascript:delmsg("sent","<?php echo $row["msgid"];?>","<?php echo $row['to1id'];?>");'><li >Delete</li></a>
<li style='background:<?php echo $bgcolor;?>;'><?php echo $msg;?></li>

<?php
}
echo "
</ul>
</div>
<div id='msgmenu'>
<p style='text-align:left'>To: ".user_name($row['to1id'])."</p>
<p style='text-align:left'>From: {$_SESSION['userfulname']}</p>
<p>
<form name='msgform' onsubmit='return false'>
<input type='hidden' name='fromid' value='{$row['to1id']}' class='field blue_onhover'>
<div style='text-align:left'>Title <input type='text' name='title' value=' No title ' size='45'></div>
</br><div style='text-align:left'>Type your text here</div><textarea name='msg' style='width:350px; height:170px;' id='txt_msg' class='blue_onhover flexible_textarea'></textarea>
</br></br><input type='submit' class='special_btn' value='Send now' onclick='sendmsg()'>&nbsp;&nbsp;<input class='special_btn redback' type='button' onclick='offmsg()' value='Cancel' >
</form></p>
</div>";}}}
}
}

else
{
header('location:home.php');
}

?>