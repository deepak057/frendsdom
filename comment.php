<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']) && !empty($_POST['n']))
{

//compressing HTML content 
//ob_start("ob_gzhandler");

//putting a cross sign allowing to close comment menu
echo "<tr><td>";

if($_POST['id']==$_SESSION['userid'])
{
$arg='"'.$_POST['id'].'"';
echo "<span class='red_onhover' id='comment_clist' onclick='colorlist4comment({$arg});' title='Get the colorlist to change the comment background color'>&#916;</span>";
}

echo "</td><td class='red_onhover' style='float:right;' title='Close' onclick='close_comment();'><b>&#215</b></td></tr>";


if($_POST['n']!="no_comment")
{

//displaying comments

if($_POST['n']>15)
$sql="select DATE_FORMAT(when1,'%d %M %Y'),UNIX_TIMESTAMP(when1),comment_no,fromid,comment from profilecomments4user{$_POST['id']} order by when1  LIMIT ".($_POST['n']-15).",{$_POST['n']}";
else
$sql="select DATE_FORMAT(when1,'%d %M %Y'),UNIX_TIMESTAMP(when1),comment_no,fromid,comment from profilecomments4user{$_POST['id']} order by when1 LIMIT 0,{$_POST['n']}";

$mysqli=new mysqli($host,$db_user,$db_passwd,$comment_on_profile_db);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(account_status($row['fromid']))
{

if($row['fromid']==$_SESSION['userid'])
{

$arg1='"profilecomments4user'.$_POST['id'].'","'.$row['comment_no'].'"';

echo "
<tr id='remove_cmt".$row['comment_no']."' class='remove_cmt' >
<td></td>
<td>
<span class='red_onhover' title='Remove this comment' style='position:relative;right:-60px;' onclick='remove_cmt({$arg1});'>&#215</span>
</td>
</tr>

<tr class='bottom_border1' id='cmt".$row['comment_no']."'>
<td colspan='2'><div style='width:540px;' class='comment_content'>
<div class='fl'>
<div class='image_part'>
<a href='visit.php?id={$row['fromid']}'><img src='".prof_pic($row['fromid'])."' align='middle'/></a>
</div>
<div class='text_part'>
<a href='visit.php?id={$row['fromid']}' class='fback_from1' id='{$row['fromid']}'><b>".TuneTheName(user_name($row['fromid']),11).":</b></a>
</div>
<div class='clear'></div>
</div>
<div class='fr'>
".nl2br(auto_link_text(stripslashes($row['comment'])))."
</div>
<div class='clear'></div>
<div class='bottom'><span class='light_text'> about ".ago($row[1])." (on {$row[0]})</span></div>
</div>
</td>
</tr>";

}

else
{
$rel=get_list_status($row['fromid']);
if(!$rel)
{
$rel_text="No relation";
}
else
{
if($rel=="No prior aquaintance")
{
$rel_text="In NPA list";
}
else if($rel=="aquantaince")
{
$rel_text="Acquaintance";
}

else
{
$rel_text="In {$rel} list";
}
}


echo "<tr class='bottom_border'><td colspan='2'><div style='width:540px;' class='comment_content'>
<div class='fl'>
<div class='image_part'>
<a href='visit.php?id={$row['fromid']}'><img src='".prof_pic($row['fromid'])."' align='middle'/></a>
</div>
<div class='text_part'>
<a href='visit.php?id={$row['fromid']}' class='fback_from1' id='{$row['fromid']}'><b>".TuneTheName(user_name($row['fromid']),11).":</b></a>
<br/><span class='light_text'>{$rel_text}</span>
</div>
<div class='clear'></div>
</div>
<div class='fr'>
".nl2br(auto_link_text(stripslashes($row['comment'])))."
</div>
<div class='clear'></div>
<div class='bottom'><span class='light_text'> about ".ago($row[1])." (on {$row[0]})</span></div>
</div>
</td></tr>";
}
}
}
}
}
}

//arguments to be passed to javascript functions
$arg='"'.$_POST['id'].'","'.$_SESSION['userid'].'","'.user_name($_SESSION['userid']).'","'.prof_pic($_SESSION['userid']).'"';$arg1='"next","'.$_POST['id'].'"';$arg2='"prev","'.$_POST['id'].'"';

//putting textarea for writing a new comment
echo "<tr id='postcomment_tr'><td><textarea class='flexible_textarea' name='txt_comment' style='width:450px; height:25px;' placeholder='Your comment' id='txt_comment' ></textarea></td><td><input type='button' value='Comment' onclick='post_comment({$arg});'></td></tr><div style='position:relative;right:80px;top:-10px;'>";

//now showing and hiding previous ,next buttons
if($_POST['n']>15)echo "<img id='prev_comments' src='ngreyb.bmp' style='cursor:pointer;' title='Previous set of comments' onclick='get_profilecomments({$arg2});'>";if($_POST['n']<total_entries("profilecomments4user{$_POST['id']}","fromid",$comment_on_profile_db))echo "<img id='next_comments' src='ngreyf.bmp' style='cursor:pointer;' title='Next set of comments' onclick='get_profilecomments({$arg1});'>";echo "</div>";

}
else
{
header('location:home.php');
}
?>