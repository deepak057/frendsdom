<?php

//function to notify the browser to use the cached version of this page if page was not modified 
function caching_headers ($file, $timestamp) {$gmt_mtime = gmdate('r', $timestamp);header('ETag: "'.md5($timestamp.$file).'"');if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) || isset($_SERVER['HTTP_IF_NONE_MATCH'])) {if ($_SERVER['HTTP_IF_MODIFIED_SINCE'] == $gmt_mtime || str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == md5($timestamp.$file)) {header('HTTP/1.1 304 Not Modified');exit();}}header('Last-Modified: '.$gmt_mtime);header('Cache-Control: public');}
caching_headers ($_SERVER['SCRIPT_FILENAME'], filemtime($_SERVER['SCRIPT_FILENAME']));

//starting session
session_start();

//compressing HTML content 
ob_start("ob_gzhandler"); 

include('/home/frendryg/FunctionList.php');
set_error_handler('ErrorHandler');   
check_log_in($_SERVER["REQUEST_URI"]);

//including file containing definition of class 'user' 
include('class_lib.php');
$lu=new user($_SESSION['userid'],true);

//updating last_home_visit value to the value of current_home_visit
$d=date('Y-m-d H:i:s');update_entity("userdata","id",$_SESSION['userid'],"last_home_visit",entity_value("userdata","current_home_visit","id",$_SESSION['userid']));update_entity("userdata","id",$_SESSION['userid'],"current_home_visit",$d);

//retrieving number of new news
$news=get_new_news($_SESSION['userid']);

?>
<!doctype html><html>
<head><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><META HTTP-EQUIV="Content-Language" Content="en">
<link rel="icon" href="awesom.bmp"><title>Home-Frendsdom</title>
<script src="test/script.js" type="text/javascript"></script><script src="jquery-1.4.js" type="text/javascript"></script><script src="ajax_tooltip/ajax_tooltip.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script><script src="apprise/apprise.min.js" type="text/javascript"></script><script src="jquery.hovercard.js" type="text/javascript"></script><script src="js/jScroll.js" type="text/javascript"></script>
<script src="jCarousel.js" type="text/javascript"></script><script type="text/javascript" src="resources/jquery/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="resources/jquery/js.js"></script><script type="text/javascript" src="resources/plugin/jquery.ui.combogrid-1.6.2.js"></script><script type="text/javascript" src="jquery.flexibleArea.js"></script><script type="text/javascript" src="chat/chat.js"></script><script src="easing.js"></script><script src="cluetip/jquery.cluetip.js"></script><script src="js/jquery.outside.events.js"></script>
<script src="cluetip/lib/jquery.hoverIntent.js"></script>
<script src="nicescroll.js"></script><script type="text/javascript" src="js/jquery.floatScroll.min.js"></script><script type="text/javascript" src="waypoints.js"></script><script type="text/javascript" src="jeditable.js"></script><script type="text/javascript" src="scroll_to.js"></script><script type="text/javascript" src="fancyBox_source/jquery.fancybox.js"></script><script type="text/javascript" src="tokeninput/src/jquery.tokeninput.js"></script>
<script src="js/jquery.prettyPhoto.js"></script><script type="text/javascript" src="home_script.js"></script>
<link rel="stylesheet" type="text/css" href="test/css8.css"/><link rel="stylesheet" type="text/css" href="test/home_styleSheet.css"/><link rel="stylesheet" type="text/css" href="/skin.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery.ui.combogrid.css"/><link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery-ui-1.8.9.custom.css"/>
<link rel="stylesheet" type="text/css" href="chat/chat.css"/><link type="text/css" rel="stylesheet" media="all" href="apprise/apprise.min.css" /><link rel="stylesheet" type="text/css" href="fancyBox_source/jquery.fancybox.css" media="screen" /><link rel="stylesheet" href="tokeninput/styles/token-input-facebook.css" type="text/css" /><link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" /><link rel="stylesheet" type="text/css" href="ajax_tooltip/style.css"/><link rel="stylesheet" type="text/css" href="css/prettyPhoto.css"/>
<script type="text/javascript">
user_online();var ad_sw_pos=70;changecss(1,'.hp_post_container','background','<?php echo $lu->get_post_block_back(); ?>');
<?php if(!$lu->get_intro_enabled()){?>
$(window).load(function(){
$(".ad_space_wrapper").floatScroll({positionTop: ad_sw_pos});});
<?php 
}
?>
var p_block_id=post_pic_id=post_news_id=post_movie_id=post_video_id=null;
var v=<?php echo $lu->get_ecp_scroller_status();?>;var lu_name="<?php echo $lu->get_name(); ?>";var luid="<?php echo $_SESSION['userid']; ?>";var lu_stripColor="<?php echo $lu->get_strip_color(); ?>";
var excluded_ids="<?php echo $lu->get_pv_excluded(); ?>".split(",");
var excluded_names="<?php
$l=explode(",",$lu->get_pv_excluded());
for($i=0;$i<sizeof($l);$i++)
{
$l[$i]=user_name($l[$i]);
}
$l=implode(",",$l);
echo $l;?>".split(",");
var excluded_arr=new Array();
for(var i=0;i<excluded_ids.length;i++)
{
excluded_arr[i]=new Array();
excluded_arr[i]["id"]=excluded_ids[i];
excluded_arr[i]["name"]=excluded_names[i];
}
</script>
<style type="text/css">
<?php if($lu->get_intro_enabled()){?>
.pop,.fixed-strip,.rel_list,.hp-tu-wrapper{position:absolute;}
<?php }?>
.green{background:<?php echo $lu->get_strip_color(); ?>;}
/*.hp_post_container{background: <?php echo $lu->get_post_block_back(); ?>;}*/
.points_count{background:<?php echo $lu->get_strip_color(); ?>;}
.strip_back{background:<?php echo $lu->get_strip_color(); ?>;}.strip_border{border:1px solid #d2d2d2;}
.tabs input:hover + label {background:<?php echo $lu->get_strip_color(); ?>;}
<?php

if($lu->get_home_main_view()=="status_view")
{
echo "#status_view_wrapper{display:block;}";
}
else if($lu->get_home_main_view()=="pic_view")
{
echo ".lu_pic_wrapper,.lu_info_container{display:block;}";
}
else{
echo ".hp-mp-wrapper{display:block;}";
}
if($lu->get_ecp_scroller_status())
{
echo "#scroller_vc #vc_right{display:inline;}";
if($lu->get_home_pic_view()=="ecp")
echo "#scroller_contanier{display:block;}";
else 
echo "#scroller_contanier{display:none;}";
}
else
{
echo "#scroller_vc #vc_left{display:inline;}#scroller_contanier{display:none;}";
}
echo ".remove_ecp{background:".$lu->get_strip_color().";}";
?>
</style>
</head>
<body>
<?php 

//insert google analytic code
include($ga_file); 

?>

<div id="body">
<div class='points_count show_expand_rel' style='position:fixed;top:-14px;z-index:101;'><span id='points_digit' class='points_digit'>+<?php echo get_points($_SESSION['userid']);?></span>
    <div class='spend_it underline_onHover'>Spend it</div>
  </div>
  <div class="strip clickeffect fixed-strip"><img id="hp-top-logo" class="pointer top-bar-logo none" src="<?php echo get_logo(); ?>"/>
<ul>
<li><a href='friends3.php' title='Logout'><img src="1.gif"></a></li><li><a href='update.php' title='Edit/Update your profile'><img src="update.gif"></a></li><li><a href='msgbox.php' title='Go to your message box'><img src="msgbox.gif"></a></li>
<li><a href='collection.php' title='Manage your pictures'><img src="collection.gif"></a></li>
<li><a <?php if($lu->get_intro_enabled())echo 'id="tni_vp"'; ?> href="visit.php?id=<?php echo $_SESSION['userid'];?><?php if($lu->get_intro_enabled()) echo" &intro_enabled=true";?>"><img src="profile.gif" title="Your profile and account settings"/></a></li>
<li><form method="post" action="/search.php">
<input type="text" name="query" class="shaded_fields" id="search_field" title="Search a user by name,email,country,state,city" placeholder="Search user">
<input type="submit" class="ss-submit" value="Search">
</form>
</li>
</ul>
</div>
<div class="clearboth"></div>
<?php

//determining suitable user_id for given userhome value
$user_id=$_SESSION["userid"];

/*
include("modules/top_users/top_users.php");
$tu=new top_users($_SESSION['userid']);
$tu->put_dock();
*/

?>
<center>
<div class="hp-mp-wrapper none">
<?php
include("modules/make_points/make_points.php");
$mp=new make_points($_SESSION["userid"]);
$mp->put_users();
?>
</div>
<?php
echo '
<div id="status_view_wrapper" class="none status_view_wrapper">
<table class="status_container" id="status_container">
<tr>
<td>
<table style="width:100%;">
<tr>
<td><div id="post-attachments"></div></td>
<td align="right" id="post_pic_option">
<span class="small underline_onHover pointer post_sugg" id="post_sugg"><img src="images/suggestion.png" height="13" width="13"/>Suggestions for post</span> | <span class="small underline_onHover pointer post_add_pic"><img src="add.png" height="10" width="10" />Add a picture</span>
</td>
</tr>
</table>
</td>
<td></td>
</tr>
<tr>
<td id="ST_container">
<textarea id="status_textarea" class="status_textarea hp-textarea-hover flexible_textarea" placeholder="Share your mind"></textarea>
</td>
<td>
<input type="button" value="Share" id="status_share_btn" class="special_btn" />
</td>
</tr>
</table>';

//displaying posts 
display_posts();
?>
<div id="waypoint">&nbsp;</div>
</div>
<div id="lu_pic_wrapper" class="lu_pic_wrapper">

<div class="fl">

<div id="prof_pic_container"><section class="tabs">
            <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" <?php if($lu->get_home_pic_view()=="prof_pic") echo 'checked="checked"'; ?>/>
            <label for="tab-1" id="prof_pic_lable" class="tab_lable tab-label-1">Your Profile picture</label>
            <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" <?php if($lu->get_home_pic_view()=="upload_pic") echo 'checked="checked"'; ?>/>
            <label for="tab-2" id="upload_pic_lable" class="tab_lable tab-label-2">Upload profile pic</label>
            <input id="tab-3"  type="radio" name="radio-set" class="tab-selector-3" <?php if($lu->get_home_pic_view()=="ecp") echo 'checked="checked"'; ?> />
            <label for="tab-3" id="ecp_lable" class="tab_lable tab-label-3">Eyecandy picture</label>
            <div class="clear-shadow"></div>
            <div class="tab_content">
              <div class="content-1">
<?php echo'  <img width="500" id="lu_prof_pic" src="'.prof_pic($_SESSION['userid'],"original").'"><span id="remove_lu_pic" title="Delete your profile picture"><span>&#215;</span></span>
              </div>
              <div class="grey_backg rounded_border_r10 content-2" style="width:500px;text-align:center;margin-top:5px;">
<form action="home.php" method="post" enctype="multipart/form-data">
<p style="text-align:center;">You should put a picture  of yours here!
<input type="file" name="file" />
<input class="special_btn" type="submit" value="Upload" />
</p>               
</form>
<h2>OR</h2>
<p style="text-align:center;">Enter the URL of your profile picture!<br/>
<input type="text" placeholder="Paste or enter URL" class="blue_onhover" size="35" id="prof_pic_url"/>
<input class="special_btn" id="prof_url_btn" type="button" value="Add" />
</p>
</div>
 <div id="content-3" class="content-3">
<img src="'.get_ecp($_SESSION['userid']).'" id="current_ecp" width="500" height="300"/>
<img src="picon3.gif" id="load_ecp" class="none"/>
<ul id="scroller_vc">
<li  title="show scroller" id="vc_left">&#9658;</li>
<li  id="vc_right" title="hide scroller">&#9668;</li>
</ul><div class="clear"></div>

<ul id="add_ecp">
<li id="add_ecp_li">
<input title="Add new eyecandy picture" type="button" id="add_ecp_btn" value="+" class="special_btn1" style="background-color:'.$lu->get_strip_color().';" />
</li>
</ul>
<div class="none grey_backg rounded_border_r10 shaded_border_thick" id="add_ecp_wrapper">
<div class="aew_container">
<div><div class="fl"><h3><img src="add.png" alt="image" align="middle"/>&nbsp;Add new eyecandy picture</h3></div><div class="fr"><span title="Close" onclick="hide_ecp_w();" class="red_onhover">&#215;</span></div><div class="clear"></div></div>
<div id="enter_url">
Enter the URL of picture<br/>
<input class="blue_onhover" placeholder="Paste or enter URL" type="text" size="32" id="ecp_url"/>&nbsp;<input type="button" class="special_btn green_backg" id="ecp_url_btn" value="Add"/>
</div>
<div class="or"><h3>OR</h3></div>
<div id="upload_ecp">
Upload eyecandy picture<br/>
<form action="upload_eyecandy.php" target="upload_target" method="post" enctype="multipart/form-data" onsubmit="return ecp_upload();">
<input class="blue_onhover" type="file" name="ecp_file" id="ecp_file"/>&nbsp;<input type="submit" class="special_btn green_backg" id="ecp_file_btn" value="Add"/>
</form>
</div>
</div>     
</div>
</div>
</div>
</section>
</div>
</div>
<div class="fr" id="scroller_contanier" >
<div class="jcarousel-skin-tango"><div style="position: relative; display: block;" class="jcarousel-container jcarousel-container-vertical"><div style="position: relative;" class="jcarousel-clip jcarousel-clip-vertical">
<ul style="overflow: hidden; position: relative; top: -595px; margin: 0px; padding: 0px; left: 0px; height: 950px;" id="mycarousel" class="jcarousel jcarousel-list jcarousel-list-vertical">
</ul></div><div disabled="false" style="display: block;" class="jcarousel-prev jcarousel-prev-vertical"></div><div disabled="true" style="display: block;" class="jcarousel-next jcarousel-next-vertical jcarousel-next-disabled jcarousel-next-disabled-vertical"></div></div></div>
</div>
<div class="clear">
</div>
</div>
</center>';


// uploading the picture
if(empty($_FILES["file"]["name"]))
{
}
else
{
if (($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png"))
{
if(set_prof_pic($_FILES["file"]["type"],"300",$_FILES["file"]["name"],$_FILES["file"]["tmp_name"],true)){
$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);
if($mysqli->query("update userdata set picture='yes',home_pic_view='prof_pic' where id={$_SESSION['userid']}"))
{
header('location:home.php');
}
}
}
else echo "<b>Invalid file type</b></br>( Make sure you choose image file with 'jpg' or 'gif' format)";
}


//displaying user's info
echo "<center><div id='lu_info_container' class='lu_info_container'></br><a class='no_backg' href='update.php'><b><img src='update.gif' height='30' width='30' align='middle'>&nbsp;<u>Update your profile</u></b></a></br></br><div id='user_info'>

<li class='green'><b>Name:</b>".$lu->get_name()."</li><li class='pink'><b>Sex:</b> ".$lu->get_sex()."</li><li class='green'><b>Date of birth:</b> ".$lu->get_dob()."</li><li class='pink'><b>E-mail:</b>".$lu->get_email()."</li><li class='green'><b>Country:</b>".$lu->get_country()."</li><li class='pink'><b>Location:</b>".$lu->get_city().",".$lu->get_state()."</li></div></div></center>"; 

//getting userlists
$type=array();
$familyid=array();
$friendid=array();
$colid=array();
$aquid=array();
$noid=array();
$requests=0;
$f=0;
$fa=0;
$c=0;
$a=0;
$n=0;
$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select* from user{$_SESSION['userid']}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if($row['familyid']!="" && account_status($row['familyid']))
{ 
$familyid[$fa]=$row['familyid'];
$fa++;
}
if($row['friendid']!="" && account_status($row['friendid']))
{ 
$friendid[$f]=$row['friendid'];
$f++;
}
if($row['colid']!="" && account_status($row['colid']))
{
$colid[$c]=$row['colid'];
$c++;
}
if($row['aquid']!="" && account_status($row['aquid']))
{
$aquid[$a]=$row['aquid'];
$a++;
}
if($row['noid']!="" && account_status($row['noid']))
{
$noid[$n]=$row['noid'];
$n++;
}
if($row['requestid']!="" && account_status($row['requestid']))
{
$requests++;
}
}
}
}

//updating usermsgbox table
$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
$mysqli->query("update msgboxofuser{$_SESSION['userid']} set read1='yes' where read2='yes'");

//determining total number of unread msgs
$totalnewmsg=get_unread_msgs($_SESSION['userid']);

//retrieving number of new nudges
$nudgesets=get_new_nudges($_SESSION['userid']);

//retrieving number of new authority requests
$atr_req=get_atr_req($_SESSION['userid']);

?>

<div class="rel_list light-back nice_scroll" id="f">
<h3><img src="images/friends_icon.png" alt="friends" align="middle"/>Friends</h3>

<ul id="f_ul">
<?php
for($i=0;$i<sizeof($friendid);$i++)
{

$user_name=user_name($friendid[$i]);
$is_online=is_online($friendid[$i]);
?>
<li>

<?php if($is_online){ ?>
<div class="inline u_online">
<img width='15' title="<?php echo $user_name." is online"; ?>" src='images/online_icon.png' alt='online'/>
</div>
<?php
}
?>


<a href="visit.php?id=<?php echo $friendid[$i];?>" title="&lt;img src='<?php echo prof_pic($friendid[$i]); ?>' height='160' width='160' /&gt;"><?php echo $user_name;?></a>
<img onClick="chatWith('<?php echo $friendid[$i]."','".$user_name ;?>');" class="start_chat pointer" title="Start chatting with <?php echo $user_name; ?>" src="images/chat.png" alt="Start chat"/>

<?php if(!$is_online){ ?>
<br/>

<span class="light_text">Was last online: <?php echo ago(strtotime(user_last_online($friendid[$i]))); ?></span>
<?php
}

?>


</li>
<?php
}
?>
</ul>
</div>
<div class="rel_list light-back nice_scroll" id="fam">

<h3><img src="images/family_icon.png" alt="family" align="middle"/>&nbsp;Family</h3>

<ul id="fam_ul">
<?php


for($i=0;$i<sizeof($familyid);$i++)
{
$user_name=user_name($familyid[$i]);
$is_online=is_online($familyid[$i])

?>
<li>

<?php if($is_online){?>
<div class="inline u_online">
<img width='15' title="<?php echo $user_name." is online."; ?>" src='images/online_icon.png' alt='online'/>
</div>
<?php
}
?>
<a href="visit.php?id=<?php echo $familyid[$i];?>" title="&lt;img src='<?php echo prof_pic($familyid[$i]); ?>' height='160' width='160' /&gt;"><?php echo $user_name;?></a>
<img onClick="chatWith('<?php echo $familyid[$i]."','".$user_name ;?>');" class="start_chat pointer" title="Start chatting with <?php echo $user_name; ?>" src="images/chat.png" alt="Start chat"/>
<?php if(!$is_online){ ?>
<br/>
<span class="light_text">Was last online: <?php echo ago(strtotime(user_last_online($familyid[$i]))); ?></span>
<?php
}
?>
</li>
<?php
}
?>
</ul>
</div>

<div class="rel_list light-back nice_scroll" id="col1">

<h3><img src="images/colleague_icon.png" alt="colleague" align="middle"/>&nbsp;Colleague</h3>


<ul id="col1_ul">
<?php
for($i=0;$i<sizeof($colid);$i++)
{
$user_name=user_name($colid[$i]);
$is_online=is_online($colid[$i]);

?>
<li>

<?php if($is_online){?>
<div class="inline u_online">
<img width='15' title="<?php echo $user_name." is online"; ?>" src='images/online_icon.png' alt='online'/>
</div>
<?php
}
?>


<a href="visit.php?id=<?php echo $colid[$i];?>" title="&lt;img src='<?php echo prof_pic($colid[$i]); ?>' height='160' width='160' /&gt;"><?php echo $user_name;?></a>
<img onClick="chatWith('<?php echo $colid[$i]."','".$user_name ;?>');" class="start_chat pointer" title="Start chatting with <?php echo $user_name; ?>" src="images/chat.png" alt="Start chat"/>


<?php if(!$is_online){ ?>
<br/>

<span class="light_text">Was last online: <?php echo ago(strtotime(user_last_online($colid[$i]))); ?></span>
<?php
}

?>


</li>
<?php
}
?>
</ul>
</div>
<div class="rel_list light-back nice_scroll" id="aqu1">
<h3><img src="images/aqu_icon.png" alt="aquaintance" align="middle"/>&nbsp;Aquaintance</h3>

<ul id="aqu1_ul">
<?php
for($i=0;$i<sizeof($aquid);$i++)
{
$user_name=user_name($aquid[$i]);
$is_online=is_online($aquid[$i]);
?>
<li>

<?php if($is_online){?>
<div class="inline u_online">
<img width='15' title="<?php echo $user_name." is online"; ?>" src='images/online_icon.png' alt='online'/>
</div>
<?php
}
?>

<a href="visit.php?id=<?php echo $aquid[$i];?>" title="&lt;img src='<?php echo prof_pic($aquid[$i]); ?>' height='160' width='160' /&gt;"><?php echo $user_name;?></a>

<img onClick="chatWith('<?php echo $aquid[$i]."','".$user_name ;?>');" class="start_chat pointer" title="Start chatting with <?php echo $user_name; ?>" src="images/chat.png" alt="Start chat"/>

<?php if(!$is_online){ ?>
<br/>

<span class="light_text">Was last online: <?php echo ago(strtotime(user_last_online($aquid[$i]))); ?></span>
<?php
}

?>

</li>
<?php
}
?>
</ul>
</div>
<div class="rel_list light-back nice_scroll" id="no1">
<h3><img src="images/no_aqu.png" alt="NPA" align="middle"/>&nbsp;NPA</h3>

<ul id="no1_ul">
<?php
for($i=0;$i<sizeof($noid);$i++)
{

$user_name=user_name($noid[$i]);
$is_online=is_online($noid[$i])

?>
<li>
<?php if($is_online){?>
<div class="inline u_online">
<img width='15' title="<?php echo $user_name." is online."; ?>" src='images/online_icon.png' alt='online'/>
</div>
<?php
}
?>
<a href="visit.php?id=<?php echo $noid[$i];?>" title="&lt;img src='<?php echo prof_pic($noid[$i]); ?>' height='160' width='160' /&gt;"><?php echo $user_name;?></a>
<img onClick="chatWith('<?php echo $noid[$i]."','".$user_name ;?>');" class="start_chat pointer" title="Start chatting with <?php echo $user_name; ?>" src="images/chat.png" alt="Start chat"/>


<?php if(!$is_online){ ?>
<br/>

<span class="light_text">Was last online: <?php echo ago(strtotime(user_last_online($noid[$i]))); ?></span>
<?php
}

?>

</li>
<?php
}
?>
</ul>
</div>
<div class="pop light-back nice_scroll" id="pop">
<p id="friend_f" <?php if(!empty($friendid))  echo 'onclick="get_list(this.id);" title="click to see your friend list"';?> ><img id="fimg" src="right.png" height="15" width="15" class="none">Friends(<?php echo sizeof($friendid);?>)</p>
<p id="family_fam" <?php if(!empty($familyid)) echo 'onclick="get_list(this.id);" title="click to see your family list"';?>><img id="faimg" src="right.png" height="15" width="15" class="none">Family(<?php echo sizeof($familyid);?>)</p>
<p id="col_col1" <?php if(!empty($colid)) echo 'onclick="get_list(this.id);" title="click to see your colleague list"';?>><img id="colimg" src="right.png" height="15" width="15" class="none">Colleagues(<?php echo sizeof($colid);?>)</p>
<p id="aq_aqu1" <?php if(!empty($aquid)) echo 'onclick="get_list(this.id);" title="click to see your acquaintance list"';?>><img id="aqimg" src="right.png" height="15" width="15" class="none">Acquaintance(<?php echo sizeof($aquid);?>)</p>
<p id="no_no1" <?php if(!empty($noid)) echo 'onclick="get_list(this.id);"  title="click to see your no prior aquintance list"';?>><img id="noimg" src="right.png" height="15" width="15" class="none">No prior aquaintance(<?php echo sizeof($noid);?>)</p>
<p class="pop_title">Notifications</p>
<p id='news' onclick='receive_news();'>News<span class="nc_container">(<span id='total_news'><?php echo $news; ?></span>)</span></p>
<p id="invitation" <?php if($requests>0) echo 'onclick="receive_invitetionFiles();" title="click to see invitetions sent to you"'; ?>>Invitations<span class="nc_container">(<?php echo "(<span id='total_req'>".$requests."</span>)</span>"; ?></p>
<p  id='atr_rqst' title='Authority requests' <?php if($atr_req>0) echo "onclick='receive_atr_req();'";?>>Authority req<span class="nc_container">(<span id='total_atr_req'><?php echo $atr_req; ?></span>)</span></p>
<p id="nudge_received" <?php if($nudgesets>0) echo 'onclick="get_nudgeFiles()"'; ?>>New nudges<span class="nc_container">(<span id="unviewed_nudges"><?php echo $nudgesets;?></span>)</span></p>
<p id="mbox" <?php if($totalnewmsg>0) echo 'onclick="receive_msg();"';?>>New Mesgs<span class="nc_container">(<span id="total_msgs"><?php echo $totalnewmsg;?></span>)</span></p>
<p class="pop_title">Others</p>
<p><a href="javascript:void(0)" id="invite_fr" onclick="get_invite_popup();">Invite friends</a></p>
<p><a id="fback_bbar" title="Give your feedback" href="user_feedback.php">Give your feedback</a></p>
<p><a id="intro_to_w" href='enable_intro.php' title='Learn about various features and their functionality'>Introduction to website</a></p>
</div>
<div class="ad_space_wrapper" id="ad_space_wrapper">
<div align='left' id='ad_space'>
<?php 

//run left panel
include("modules/panel/left_panel.php");
$panel=new panel($_SESSION['userid']); 
$panel->put_left_panel($lu->get_slide_panel());

//put gritter notice if any
$lu->put_gritter();

?>
<div id="lp_ads">	
<?php

//include ads 
include($ad_200_600);

?>
</div>
</div>
</div>
</div>
<?php 

//if user gets new invitetions

if($requests>0)
{
?>
<div class="gradient_black auto_adjust_10" id="req"></div><span id="req_count" class="hidden">1</span><ul id="pre_next_req"><li id="prevreq_img"><a href='#'><img  src="/redb1.png" height="20" width="30" onclick="prev_req();"></a></li><li id="nextreq_img"><a href='#'><img  src="/redf1.png" height="20" width="30" onclick="request();"></a></li></ul><span id='req_left' class="hidden"><?php echo $requests;?></span>
<script>
check_left_panel();
function receive_invitetionFiles(){el('body').style.opacity=".2";show('req');el('req').innerHTML="<p style='font-size:1.4em;width:500px;height:200px;'></br></br></br>Loading............";if(!file_exists("/Receiveinvitetion_Script.js","js")){var script=document.createElement('script');script.setAttribute("type","text/javascript");script.setAttribute("src", "Receiveinvitetion_Script.js");document.getElementsByTagName("head")[0].appendChild(script);}else{request();}}
</script>
<?php
}

//if user receives new nudges

//if($nudgesets>0)
//{ 
?>
<div id="nudge_space" class="auto_adjust_100"></div><ul id="pre_next" class="pre_next auto_adjust_250"><li><a href="#"><img id="nextnudge_img" src="/rightm.png" height="20" width="30" onclick="receive_nudge();" title="Next nudge"></a></li><li><a href="#"><img id="prevnudge_img" src="/leftm.png" height="20" width="30" onclick="prev_nudge();" title="Previous nudge"></a></li></ul><span id="nudgecount" class="hidden">1</span><table id="others_included" class='hidden'></table><div id='nudgemenuforReply'></div><span id="replytonudgeid" class="hidden"></span><span id="temp_data"></span><span id="unviewed_left" class="hidden"><?php echo $nudgesets;?></span><span class="hidden" id="nudgemenubackground"><?php echo entity_value('userdata','nudgemenu_color','id',$_SESSION['userid']);?></span>
<script>
function get_nudgeFiles(){el('body').style.opacity=".2";show('nudge_space');el('nudge_space').innerHTML="<div class='gradient_sb' id='textpart' style='font-size:1.3em;'></br>Loading............</div>";Centralize_el("nudge_space");if(!file_exists("/ReceivenudgeScript.js","js")){var script=document.createElement('script');script.setAttribute("type","text/javascript");script.setAttribute("src", "ReceivenudgeScript.js");document.getElementsByTagName("head")[0].appendChild(script);}else{receive_nudge();}}
</script>
<?php
//}

//if user receives new messages
 
//if($totalnewmsg>0)
//{ 
?>
<div id="msg" class="gradient_sb auto_adjust_100"><div id="msgTextPart"></div><input type="button" class="btn" style="position:absolute;right:10px;top:10px;" value="Close"  onclick="msg_close();"/></div><span id="msgcount" class="hidden" >1</span><span id="unviewed_msgs" class="hidden" ><?php echo $totalnewmsg;?></span><span id="replytomsgid" class="hidden"></span><ul id="pre_next_msg" class="pre_next"><li id="nextmsg_img"><a class='no_backg' href="javascript:getmsgtext();" ><img  src="/rightm.png" height="20" width="30"  title="Next message"></a></li><li id="prevmsg_img" ><a class='no_backg' href="javascript:get_prevmsgtext();"><img src="/leftm.png" height="20" width="30"  title="Previous message"></a></li></ul>
<div id="msgmenu1" class="msgmenu"><p style="text-align:left">To: <span id="replyto"></span></p><p style="text-align:left">From: <?php echo $_SESSION['userfulname'];?></p><p><form name="msgform1" onsubmit="return false"><div style="text-align:left">Title <input type="text" name="title" value=" No title " size="45"></div></br><div style="text-align:left">Type your text here</div><textarea class="flexible_textarea" name="msg" rows="8" cols="40"></textarea></br></br><input type="submit" class="btn" value="Send now" onclick="sendmsg1()"><input type="button" class="btn" value="Cancel" onclick="offmsg11()"></form></p></div>
<script>
function receive_msg(){el('msgTextPart').innerHTML="<p class='loading_big' style='height:200px;'>Loading.............</p>";Centralize_el("msg");el('body').style.opacity=".2";show('msg');$('#msg').show();if(!file_exists("/msgScript1.js","js")){var script=document.createElement('script');script.setAttribute("type","text/javascript");script.setAttribute("src", "msgScript1.js");document.getElementsByTagName("head")[0].appendChild(script);}else{getmsgtext();}}
function msg_close(){if(el('msgmenu1')){hide('msgmenu1');}$('#pre_next_msg').hide();$("#msg").hide("slow");el('body').style.opacity="1";el('unviewed_msgs').innerHTML=(parseInt(inner('msgcount'))-1)+parseInt(inner('total_msgs'));if(parseInt(inner('total_msgs'))>0){el('mbox').setAttribute("onclick","receive_msg()");}else el('mbox').setAttribute("onclick","");}
</script>
<?php 
//}

//if user receives new authority requests

//if($atr_req>0)
//{
?>
<div class="gradient_black auto_adjust_10" id="req"></div>
<script>
function receive_atr_req(){el('body').style.opacity=".2";show('req');el('req').innerHTML="<p style='font-size:1.4em;width:500px;height:200px;'></br></br></br>"+loading+"</p>";if(!file_exists("receive_atr_req_Script.js","js")){var script=document.createElement('script');script.setAttribute("type","text/javascript");script.setAttribute("src", "receive_atr_req_Script.js");document.getElementsByTagName("head")[0].appendChild(script);}else{get_atr_req();}}
</script>
<?php
//}

//if user gets new news
//if($news>0)
//{
?>
<div  class="gradient_black auto_adjust_10" id='req'></div>
<script>
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('b.l(\'3\',\'1\');m 3=b.o(\'3\');4 c(){5(\'d\').f.g=\'.2\';5(\'6\').7="<p q=\'r\'></8></8></8>"+s+"</p>";h(\'6\');$("#6").h();i(9(3)>=9(j(\'a\')))3=j(\'a\');i(9(3)<=1)3=1;w.t("u n="+3);w.v=4(e){5(\'6\').7=e.x;y()};3++}4 z(){3-=2;c()}4 k(){$("#6").A("B",4(){5(\'d\').f.g="1"})}4 C(){5(\'a\').7="0";k()}',39,39,'|||news_count|function|el|req|innerHTML|br|parseInt|total_news|sessionStorage|receive_news|body||style|opacity|show|if|inner|hide_news|setItem|var||getItem||class|loading_text_big|loading|postMessage|get_news|onmessage||data|attach_hovercard|prev_news|hide|slow|had_no_news'.split('|'),0,{}))</script>
<?php
//}

//showing pop-up messages if any and if set
pop_up_msg($_SESSION['userid']);

//handling introduction phase 
first_login_greeting($lu->get_intro_enabled());

//function to handle noty actions
handle_noty_actions();

?>

<div id="next_feature_info" class="hidden grey_backg rounded_border_r10 shaded_border_thick_grey"></div><iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe><iframe id='fback_statistic' class='fback_statistic none' name='fback_statistic'></iframe>
<div id="userinfo"></div><div id="success" ></div><div id="uploading"></div>
</body>
</html>