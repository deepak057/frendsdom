<?php

include("environment.php");
check_auth();

if(!empty($_POST['col_id']) && !empty($_POST['pic_id']) && !empty($_POST['n']) )
{

//compressing HTML content 
//ob_start("ob_gzhandler");

if(!empty($_POST['refresh']))
{
echo "<div style='margin-bottom:4px;'><b><span id='pic_name'>".entity_value($_POST['col_id'],"pic_name","pic_id",$_POST['pic_id'],$picdata_db)."</span></b></br>
Uploaded on ".entity_value($_POST['col_id'],"DATE_FORMAT(uploaded,'%d %M %Y')","pic_id",$_POST['pic_id'],$picdata_db)." (about ".ago(entity_value($_POST['col_id'],"UNIX_TIMESTAMP(uploaded)","pic_id",$_POST['pic_id'],$picdata_db)).")
</br><span class='light_text'><b>Comments(<span id='total_cmnt'>".total_entries($_POST['pic_id'],"fromid",$picdata_db)."</span>)</span>&nbsp;
</div>";

echo "<table class='comment' id='pic_comment_table'>";
}


if($_POST['n']>15)
$sql="select DATE_FORMAT(when1,'%d %M %Y'),UNIX_TIMESTAMP(when1),comment_index,fromid,comment from {$_POST['pic_id']} order by when1  LIMIT ".($_POST['n']-15).",{$_POST['n']}";
else
$sql="select DATE_FORMAT(when1,'%d %M %Y'),UNIX_TIMESTAMP(when1),comment_index,fromid,comment from {$_POST['pic_id']} order by when1 LIMIT 0,{$_POST['n']}";

$mysqli=new mysqli($host,$db_user,$db_passwd,$picdata_db);
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

$arg1='"'.$row['comment_index'].'"';

echo "
<tr id='remove_cmt".$row['comment_index']."' class='remove_cmt' >
<td></td>
<td>
<span class='red_onhover' title='Remove this comment' style='position:relative;right:-60px;' onclick='remove_cmt({$arg1});'>&#215</span>
</td>
</tr>

<tr class='bottom_border1' id='cmt".$row['comment_index']."'>
<td colspan='2'>

<div style='width:390px;' class='comment_content'>
<div class='fl'>
<div class='image_part'>
<img src='".prof_pic($row['fromid'])."' align='middle'>
</div>
<div class='text_part'>
<a href='".get_profile_url($row['fromid'])."' class='fback_from1' id='{$row['fromid']}'><b>".TuneTheName(user_name($row['fromid']),11).":</b></a>
<br/><span class='tiny light_text'>{$rel_text}</span>
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


echo "<tr class='bottom_border'><td colspan='2'>
<div style='width:390px;' class='comment_content'>
<div class='fl'>
<div class='image_part'>
<img src='".prof_pic($row['fromid'])."' align='middle'>
</div>
<div class='text_part'>
<a href='".get_profile_url($row['fromid'])."' class='fback_from1' id='{$row['fromid']}'><b>".TuneTheName(user_name($row['fromid']),11).":</b></a>
<br/><span class='tiny light_text'>{$rel_text}</span>
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

//putting textarea for writing a new comment
echo "<tr id='postcomment_tr'><td><textarea name='txt_comment' style='width:300px; height:25px;' placeholder='Your comment' id='txt_comment' class='flexible_textarea'></textarea></td><td><input type='button' value='Comment' id='post_comment'></td></tr></table>";

if(!empty($_POST['refresh']))
{
echo "<div id='img_container'><img id='prev_comments' src='ngreyb.bmp' title='Previous set of comments'><img id='next_comments' src='ngreyf.bmp'  title='Next set of comments'></div>";
}
}
else
{
header('location:home.php');
}
?>