<?php

include("environment.php");
check_auth();

if(!empty($_POST['n']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

if($_POST['n']==1)
{
$i=0;

//retreiving new news
$mysqli =new mysqli($host,$db_user,$db_passwd,$news_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($result=$mysqli->query("select news_id,from_id from news4user{$_SESSION['userid']} where viewed=0 || when1>'".entity_value("userdata","last_home_visit","id",$_SESSION['userid'])."' ORDER BY when1 DESC"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if(account_status($row['from_id']))
{
$req[$i]=$row['news_id'];
$i++;
}
}
}
}

if(!isset($req))
{
echo "<h3><img src='alert.gif' align='middle'>Sorry ! You don't have any new news yet</h3><input type='button' value='Okay' class='special_btn' onclick='had_no_news();'>";
die("");
}

//deleting temporary userrequest table if already exists
$mysqli->query("drop table tempnews4user{$_SESSION['userid']}");

//creating temporary user request table 

foreach( $req as $row ) {$ql[] ='("'.$row.'")'; }


if($mysqli->query("create table tempnews4user{$_SESSION['userid']} (id Int Unsigned Not Null Auto_Increment,primary key(id),news_id varchar (20) not null)"))
{
if($mysqli->query("insert into tempnews4user{$_SESSION['userid']} (news_id) values ".implode(",",$ql))===false)
die( "Failed to create your database");
}
else die ("Failed to create your database");
}

$news_id=entity_value("tempnews4user".$_SESSION['userid'],'news_id','id',$_POST['n']." DESC",$news_db);
$from_id=entity_value("news4user{$_SESSION['userid']}","from_id","news_id",$news_id,$news_db);
$news=entity_value("news4user{$_SESSION['userid']}","news","news_id",$news_id,$news_db);
$t=sizeof(return_array_tweaked($news_db,"tempnews4user{$_SESSION['userid']}","id"));

//noting the time this news is viewed and updating it's status to 1(means viewed)
$mysqli =new mysqli($host,$db_user,$db_passwd,$news_db);if($mysqli===false){die("<p>Error :".mysqli_connect_error());}if($mysqli->query("update news4user{$_SESSION['userid']} set viewed='1',viewed_on='".date('Y-m-d H:i:s')."' where news_id={$news_id}")===false)die("Error: Failed to update your database");

?>
<span class='red_onhover' style='position:absolute;right:8px;top:2px;' title='Close' onclick='hide_news();'>&#215;</span>
<table cellpadding='3'>
<tr>
<td>
<h2><img src='news.gif' align='middle'>&nbsp;News&nbsp;(<?php echo $_POST['n']."/{$t}";?>)</h2>

<?php
if(user_sex($from_id)=="female"){$h="her";$hh='she';}else {$h='his';$hh='he';}

if(strpos($news,"commentOnProfile")!==false)
{
$news=explode("_",$news);
echo "<h3>Comment on profile <span class='bronze point' title='Bronze point'>+1</span></h3><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> on <a href='".get_profile_url($_SESSION['userid'])."'><b>your profile</b></a>:</br></br> ".nl2br(print_comment_news(entity_value("profilecomments4user{$_SESSION['userid']}","comment","comment_no",intval($news[1]),$comment_on_profile_db)));
}

else if(strpos($news,"commentOnpic")!==false)
{
$news=explode("*",$news);
$n=explode("&",$news[1]);
$n=explode("=",$n[1]);
echo "<h3>Comment on collection  picture <span class='bronze point' title='Bronze point'>+1</span></h3><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> on ";?>

<a href='collection.php?<?php echo $news[1];?>'  title="&lt;img src='get_pic.php?<?php echo $news[1]; ?>' height='160' width='160' /&gt;">

<?php echo "
<b>your picture</b></a>:</br></br> ".nl2br(print_comment_news(entity_value($n[1],"comment","comment_index",intval($news[2]),$picdata_db)));
}
else if(strpos($news,"fback2post")!==false)
{
$p_id=explode("*",$news);
$p_id=$p_id[1];
$fback=entity_value($p_id,"fback","fromid",$from_id,$fback_to_posts_db);
function get_fback_string($fback){$fback=$fback=="awesom"?awesome:$fback;
switch($fback){ case "like":return "{$fback}d your post";break;case "awesome":case "best":return "thought your post was {$fback}";break;default:return "cancled feedback"; break;}}

//determining suitable color corresponding to obtained points
if(get_points_for_fback($fback)=="1"){
$point_class="bronze";$title="Bronze point";}
else if(get_points_for_fback($fback)=="2"){
$point_class="silver";$title="Silver point";}
else{
$point_class="gold";$title="Gold point";}


$p_id_parameter='"'.$p_id.'"';

echo "<h3>Feedback to post <span class='{$point_class} point' title='{$title}'>+".get_points_for_fback($fback)."</span></h3>

<div class='news_post_content' onclick='display_post(".$p_id_parameter.");'><b>Your post: </b>".nl2br(print_comment_news(auto_link_text(stripslashes(entity_value("posts_record_of_user{$_SESSION['userid']}","post_content","post_id",$p_id,$posts_db)))))."<span class='pointer small'> &nbsp;<b>(View post)</b></span></div>

<br/><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> ".get_fback_string($fback)."&nbsp;<img style='position:relative;top:5px;' width='20' height='20' src='{$fback}.bmp'/>";

}

else if(strpos($news,"comment2post")!==false)
{

$temp=explode("*",$news);
$p_id=$temp[1];
$cmnt_id=$temp[2];

$p_id_parameter='"'.$p_id.'"';

echo "<h3>Comment on post <span class='bronze point' title='Bronze point'>+1</span></h3>
<div class='news_post_content' onclick='display_post(".$p_id_parameter.");'><b>Your post: </b>".nl2br(print_comment_news(auto_link_text(stripslashes(entity_value("posts_record_of_user{$_SESSION['userid']}","post_content","post_id",$p_id,$posts_db)))))."<span class='pointer small'> &nbsp;<b>(View post)</b></span></div>
<br/><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> on your post: <br/><i>".nl2br(print_comment_news(auto_link_text(stripslashes(entity_value($p_id,"comment","comment_id",$cmnt_id,$cmnt_on_posts_db)))))."</i>";

}

else if(strpos($news,"alsocommented")!==false)
{

$temp=explode("*",$news);
$p_id=$temp[1];
$cmnt_id=$temp[2];

$p_id_parameter='"'.$p_id.'"';

echo "<h3>Comment on post</h3>
<div class='news_post_content' onclick='display_post(".$p_id_parameter.");'><b>Post: </b>".nl2br(print_comment_news(auto_link_text(stripslashes(entity_value("posts_record_of_user".owner_from_post_id($p_id),"post_content","post_id",$p_id,$posts_db)))))."<span class='pointer small'> &nbsp;<b>(View post)</b></span></div>
<br/><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> on post: <br/><i>".nl2br(print_comment_news(auto_link_text(stripslashes(entity_value($p_id,"comment","comment_id",$cmnt_id,$cmnt_on_posts_db)))))."</i>";

}


else if(strpos($news,"donated_points")!==false){

$temp=explode("*",$news);
$p=$temp[1];
//$cmnt_id=$temp[2];
echo "<h3>Points Received <span class='bronze point' title='Bronze point'>+{$p}</span></h3>
<a href='".get_profile_url($from_id)."' class='dui' data-hovercard-id='{$from_id}'><b>".user_name($from_id)."</b></a> has donated you {$p} points";
}


else
{
switch($news)
{
case "atr_granted":
echo "<h3>Authority granted</h3><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> has granted you the authority to change </br>appearance of {$h} profile";
break;
case "atr_rejected":
echo "<h3>Authority request rejected</h3><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> has rejected your authority request.";
break;
case "pac":
echo "<h3>Profile appearance changed&nbsp</h3>
The appearance of <a href='".get_profile_url($_SESSION['userid'])."'><b>your profile</b></a> was changed by <a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a>";
break;
case "atr_revoked":
echo "<h3>Authority revoked&nbsp;</h3>Your authority to be able to change appearance of {$h} profile</br> has been revoked by <a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a>";
break;
case "invitetion_accepted":
echo "<h3>Invitetion accepted&nbsp;<span class='bronze point' title='Bronze point'>+1</span></h3><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> has accpted your invitetion.".ucwords($hh)." is now in your <b>".get_list_status($from_id)."</b> list";  
break;
case "invitetion_rejected":
echo "<h3>Invitation rejected</h3><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> has rejected your invitetion.";  
break;
case "fback2profile":
function get_fback_string($fback){$fback=$fback=="awesom"?awesome:$fback;switch($fback){case "like":case "dislike":case "hate":case "love":return "{$fback}d your profile";break;case "stupid":case "awesome":return "thought color combination was {$fback}";break;case "likeminded":return "thought you two were likeminded";break;case "alterd":return "thought color combination should be alterd";break;case "best":return "thought this was the best you could do";break;}}
echo "<h3>Feedback to <a href='".get_profile_url($_SESSION['userid'])."'>your profile</a></h3><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> ".get_fback_string(entity_value("profilefeedback4user{$_SESSION['userid']}","feedback1","fromid",$from_id,$feedback_to_profile_db));
break;
case "check_in":
echo "<h3>Your share box viewed</h3><a class='dui' data-hovercard-id='{$from_id}' href='".get_profile_url($from_id)."'><b>".user_name($from_id)."</b></a> viewed your <a href='".get_profile_url($_SESSION['userid'])."'>sharebox</a>";
break;
}
}

echo "</br><br/><span style='color:white;' class='small'>On ".
entity_value("news4user{$_SESSION['userid']}","DATE_FORMAT(when1,'%d %M %Y')","news_id",$news_id,$news_db)
." ( about ".ago(entity_value("news4user{$_SESSION['userid']}","UNIX_TIMESTAMP(when1)","news_id",$news_id,$news_db)).")</span>";

?>
</td>
<td align='right'>
</br>
<img src='<?php echo prof_pic($from_id); ?>' height='200' width='200' title='<?php echo user_name($from_id) ?>'>
</td>
</tr>
<?php

if($t>1)
{

echo "<tr><td align='left'>";

if($_POST['n']>1)
echo "<img src='redb1.png' height='20' width='30' title='Previous news' style='cursor:pointer;' onclick='prev_news();'>";

if($_POST['n']<$t)
echo "&nbsp;<img src='redf1.png' height='20' width='30' title='Next news' style='cursor:pointer;' onclick='receive_news();'>";

echo "</td></tr>";

}

?>
</table>
<?php

}
else 
{
header('location:home.php');
}
?>