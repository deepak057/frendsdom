<?php

//class containing various general purpose methods
 class lib
{

//$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);


//method to determine the time span between the time specified and now
public function ago($time){ $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade"); $lengths = array("60","60","24","7","4.35","12","10"); $now = time();     $difference     = $now - $time;     $tense         = "ago"; for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {     $difference /= $lengths[$j]; } $difference = round($difference); if($difference != 1) {     $periods[$j].= "s"; } return "$difference $periods[$j] ago ";}

//method to dynamically load external java script 
public function import_script($script){echo "<script>if(!file_exists('{$script}','js')){var script=document.createElement('script');script.setAttribute('type','text/javascript');script.setAttribute('src', '{$script}');document.getElementsByTagName('head')[0].appendChild(script);}</script>";}

//method to determine total number of entries in specified table
public function total_entries($table,$entity,$database=false){$connect = mysql_connect($GLOBALS['host'], $GLOBALS['db_user'], $GLOBALS['db_passwd']) or die ("unable to connect");mysql_select_db(database($database), $connect);$result = mysql_query("SELECT COUNT(*) FROM {$table} where {$entity}!='' ") or die(mysql_error());return mysql_result($result, 0);}

//method for retrieving array of entries for a specified entity
function return_array($table,$entity,$id=null,$idvalue=null){if( (!empty($table)) && (!empty($entity))){$list=array();$i=0;$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false){die("<p>Error :".mysqli_connect_error());}if(!empty($id) && !empty($idvalue)){$sql="select {$entity} from {$table} where {$id}='{$idvalue}'";}else{$sql="select {$entity} from {$table}";}if($result=$mysqli->query($sql)){if($result->num_rows>0){while($row=$result->fetch_array()){if(!empty($row[$entity])){$list[$i]=$row[$entity];$i++;}}}}return $list;}else return null;}

//method to determine total deleted/closed accounts in specified table for specified entity
function deleted_accounts($table,$entity,$database=false,$filter_unique=false)
{
$connect = mysql_connect($GLOBALS['host'], $GLOBALS['db_user'],$GLOBALS['db_passwd']) or die ("unable to connect");
mysql_select_db(database($database), $connect);

$result = mysql_query("SELECT {$entity} FROM {$table} where {$entity}!='' ") or die(mysql_error());
$i=0;$arr=array();
while($row=mysql_fetch_array($result))
{
if(!account_status($row[$entity])){
$arr[$i]=$row[$entity];$i++;}
}

if(!$filter_unique)
return sizeof($arr);
else
return sizeof(array_unique($arr));
}

}


class user extends lib
{
var $id,$first,$last,$name,$sex,$points,$day,$month,$year,$dob,$email,$password,$city,$state,$country,$created,$pv_public,$save_pv_conf,$pv_relations,$pv_excluded,$e_mail_notification,$msg_notification,$email_verified,$account_status,$email_visibility,$slide_panel,$intro_enabled,$intro_enabled_visit,$home_main_view,$home_pic_view,$ecp_scroller_enabled,$pop_up,$strip_color,$nudgemenu_color,$btnsetcolor,$rel_status,$visit_backg,$rel_color,$comment_backg,$post_block_back,$auto_response,$gritter_vars=array(
array("var"=>"gritter_too_few_rel","threshold"=>20),
array("var"=>"gritter_too_few_points","threshold"=>25),
array("var"=>"gritter_invalid_country","threshold"=>null)
);

protected static $instance=null;

function set_name($n)
{
$this->name=$n;
}

function set_sex($s)
{
$this->sex=$s;
}

function set_dob($d)
{
$this->dob=$d;
}

function set_email($e)
{
$this->email=$e;
}

function get_id()
{
return $this->id;
}

function get_first()
{
return $this->first;
}

function get_last()
{
return $this->last;
}

function get_name()
{
return $this->name;
}

function get_sex()
{
return $this->sex;
}

function get_day()
{
return $this->day;
}

function get_month()
{
return $this->month;
}

function get_year()
{
return $this->year;
}

function get_dob()
{
return $this->dob;
}

function get_email()
{
return $this->email;
}

function get_password()
{
return $this->password;
}

function get_city()
{
return $this->city;
}

function get_state()
{
return $this->state;
}

function get_country()
{
return $this->country;
}

function get_created()
{
return $this->created;
}

function get_e_mail_notification()
{
return $this->e_mail_notification;
}

function get_msg_notification()
{
return $this->msg_notification;
}

function get_email_verified()
{
return $this->email_verified;
}

function get_email_visibility()
{
return $this->email_visibility;
}

function get_intro_enabled()
{
return $this->intro_enabled;
}

function get_points()
{
return $this->points;
}

function get_account_status()
{
if($this->account_status=="open")
return true;
else
return false;
}

function get_intro_enabled_visit()
{
return $this->intro_enabled_visit;
}

function get_pv_public()
{
return $this->pv_public;
}

function get_save_pv_conf()
{
return $this->save_pv_conf;
}

function get_pv_relations()
{
return $this->pv_relations;
}

function get_pv_excluded()
{
return $this->pv_excluded;
}

function get_home_main_view()
{
return $this->home_main_view;
}

function get_home_pic_view()
{
return $this->home_pic_view;
}

function get_ecp_scroller_status()
{
return $this->ecp_scroller_enabled;
}

function get_pop_up()
{
return $this->pop_up;
}

function get_strip_color()
{
return $this->strip_color;
}

function get_nudgemenu_color()
{
return $this->nudgemenu_color;
}

function get_auto_response()
{
return $this->auto_response;
}

function get_btnset_color()
{
return $this->btnsetcolor;
}

function get_rel_status()
{
return $this->rel_status;
}

function get_slide_panel()
{
return $this->slide_panel;
}

function get_visit_backg()
{
return $this->visit_backg;
}

function get_rel_color()
{
return $this->rel_color;
}

function get_comment_backg()
{
return $this->comment_backg;
}

function get_post_block_back()
{
return $this->post_block_back;
}

function conf_option_value($option){
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['other_conf_db2']);
if($result=$mysqli->query("SELECT `value` FROM conf_for_user".$this->id." where `option`='{$option}'"))
{
if($result->num_rows>0){
while($row=$result->fetch_array()){
return $row['value'];
break;
}
}
else return false;
}
}

function update_conf_option_value($option,$value){
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['other_conf_db2']);
if(if_exists("conf_for_user".$this->id,"`option`",$option,$GLOBALS['other_conf_db2']))
$q=" update conf_for_user".$this->id." set `value`='".mysql_real_escape_string($value)."' where `option`='{$option}'";
else
$q="insert into conf_for_user".$this->id." (`option`,`value`) values('".mysql_real_escape_string($option)."','".mysql_real_escape_string($value)."')";
if($mysqli->query($q))
return true;
else return false;
}


function update_userdata($entity,$value)
{
if((!empty($table))  && (!empty($id)) && (!empty($entity)) && (!empty($value)) )
{
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("Could not connect to database");
}
$sql2="update userdata set {$entity}='{$value}' where id='{$this->id}'";
if($mysqli->query($sql2)===true)
return true;
else return false;
}
else return null;
}

//method to return the instance of this class if it already exists
 static public function getInstance($id,$conf=false)
   {
      if( !(self::$instance instanceof self) ){
                self::$instance = new self($id,$conf);           
            }
             return self::$instance;
   }

function __construct($id,$other_conf=false)
{

$user=get_user($id);

$this->user=$user;
$this->id=$user->id;
$this->first=$user->first;
$this->last=$user->last;
$this->name=$user->first." ".$user->last;
$this->sex=$user->sex;
$this->day=$user->day;
$this->month=$user->month;
$this->year=$user->year;

//getting month
if($user->month==1)$user->month="Jan";if($user->month==2)$user->month="Feb";
if($user->month==3)$user->month="Mar";
if($user->month==4)$user->month="Apr";
if($user->month==5)$user->month="May";
if($user->month==6)$user->month="Jun";
if($user->month==7)$user->month="Jul";
if($user->month==8)$user->month="Aug";
if($user->month==9)$user->month="Sep";
if($user->month==10)$user->month="Oct";
if($user->month==11)$user->month="Nov";
if($user->month==12)$user->month="Dec";

$this->dob=$user->day." ".$user->month." ".$user->year;
$this->email=$user->user_id;
$this->password=$user->password;
$this->city=$user->city;
$this->state=$user->state;
$this->country=$user->country;
$this->created=$user->created;
$this->e_mail_notification=$user->e_mail_notification;
$this->msg_notification=$user->message_notification;
$this->email_verified=$user->email_verified;
$this->email_visibility=$user->email_visibility;
$this->intro_enabled=$user->intro_enabled;
$this->intro_enabled_visit=$user->intro_enabled_visit;
$this->account_status=$user->account_status;
$this->home_main_view=$user->home_main_view;
$this->home_pic_view=$user->home_pic_view;
$this->slide_panel=$user->slide_panel;
$this->ecp_scroller_enabled=$user->ecp_scroller_enabled;
$this->pop_up=$user->pop_up;
$this->strip_color=$user->back_strip_color;
$this->nudgemenu_color=$user->nudgemenu_color;
$this->auto_response=$user->auto_response;
$this->btnsetcolor=$user->visit_buttonset;
$this->rel_status=$user->show_rel_status;
$this->visit_backg=$user->visit_backg;
$this->rel_color=$user->rel_color;
$this->comment_backg=$user->comments_backg;
$this->post_block_back=$user->post_block_back;
$this->points=$user->points;


if($other_conf)
{
$fields=get_all_fields("select * from user_conf where id={$this->id}",$GLOBALS['conf_db']);
foreach ($fields as $field){
$this->pv_public=$field->public;
$this->save_pv_conf=$field->save_pv_conf;
$this->pv_relations=$field->relations;
$this->pv_excluded=$field->excluded;
}
}
}

//method to get users and their info based on user's slide panel configuration
function get_suggestions($asl_query){

$arr=array();

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($result=$mysqli->query($asl_query))
{
if($result->num_rows>0){
while($row=$result->fetch_array()){
if($row['id']!=$this->id && !if_alreadyexists($this->id,$row['id'])){
array_push($arr,array("id"=>$row['id'],"first"=>$row['first'],"last"=>$row['last'],"sex"=>$row['sex'],"country"=>$row['country'],"state"=>$row['sex'],"city"=>$row['city']));
}
}
}
}
return $arr;
}


//method to handle requests/invitetions manipulation

function get_rel($userid)
{
if($this->id!=$userid)
{

//checking if vu is already in any of lu's list

$requestingalready=0;
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
$sql="select * from user{$this->id}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())      
{
if(!empty($row['familyid']))
{
if($row['familyid']==$userid)
{
$list="family";
break;
}
}
if(!empty($row['friendid']))
{
if($row['friendid']==$userid)
{
$list="friend";
break;
}
}
if(!empty($row['colid']))
{
if($row['colid']==$userid)
{
$list="collegue";
break;
}
}
if(!empty($row['aquid']))
{
if($row['aquid']==$userid)
{
$list="aquantaince";
break;
}
}
if(!empty($row['noid']))
{
if($row['noid']==$userid)
{
$list="No aquintance";
break;
}
}
if(!empty($row['requestid']))
{
if($userid==$row['requestid'])
{
$requestingalready++;
$type=$row['type'];
break;}}}}}


//getting vu's sex
$u=new user($userid);$sex=$u->get_sex();if($sex=="female") $h="She" ; else $h="He";
if($sex=="female") $hh="her"; else $hh="him";


//if vu is not in any of lu's lists
if(empty($list))
{

//importing script containing all the functions needed to handle invitetions
$this->import_script("invitetion_script.js");

//if vu requests lu 
if($requestingalready==1)
{
$arg1='"reject","'.$userid.'","'.$type.'","'.$sex.'"';
$arg2='"add","'.$userid.'","'.$type.'","'.$sex.'"';


echo "
<p id='invitetionmsgText'>{$h} wants to add you in ";


if($type=="col")
{
echo "<span title='Colleague List'>Colleague</span> list</p>";
}

else if($type=="aqu")
{
echo "<span title='Acquaintance'>Aquaintance</span> list</p>";
}

else if($type=="no")
{
echo "<span title='No Prior Acquaintance'>NPA</span> list</p>";
}



else 
{
echo "{$type} list</p>";
}
echo "
<span id='aldlbuttonset'>
<input type='button' class='special_btn' value='Allow' onclick='accept_reject({$arg2})'>
<input type='button' class='special_btn' style='background:red;' value='Do not allow' onclick='accept_reject({$arg1});'>
</span>
<input type='button' id='invite_btn' onclick='popMenu()' value='Invite {$hh} ' class='hidden invite_btn special_btn'>";
}


//checking if lu has already sent a request to vu
else
{
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
$sql="select * from user{$userid}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())      
{
if(!empty($row['requestid']))
{
if($row['requestid']==$this->id)
{
$requestingalready="2";
break;}}}}}


//if lu is found to be already requesting vu, then putting button allowing lu to cancel the request just in case
if($requestingalready=="2")
{

$arg='"'.$userid.'","'.$sex.'"';

echo "
<p id='invitetionmsgText'>(You have invited {$hh})</p><input type='button' id='invite_btn' class='invite_btn special_btn redback' value='Cancel invetetion to {$hh}' onclick='cancelInvitetion({$arg})'>";
}

//and if neither of lu or vu is already in other's list or not requesting ,then putting button allowing lu to send requests
else 
{

if($u->user->accept_invitations){

echo "
<p id ='invitetionmsgText'></p>
<input type='button' id='invite_btn' class='invite_btn special_btn' onclick='popMenu()' value='Invite {$hh}'>";
}

}
}
}
else 

echo "<span style='text-shadow: 5px 5px 5px green;' id='inlist_msg'>  
<b style='color:green;'>{$h}</b><span style='color:red;'> is in your </span><b style='color:green;'>{$list} </b><span style='color:red;'>list</span>
</span>";
}
}

//method to determine whether user's profile pic exists or not

function user_pic()
{

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select picture from userdata where id={$this->id}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if($row['picture']=="yes")
return true;
else return false;
}
}
}
}


//method for getting path of user's profile pic

function prof_pic($type="small")
{
return prof_pic($this->id,$type);
}


//method to get the relation status with the user of specified id

function get_relation_status($userid)
{

$useridlist=$this->return_array("user".$this->id,"listid");
if(in_array($userid,$useridlist) || requesting("user".$this->id,$userid))
{
$requestingalready=0;
$list=null;
$type=null;

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
$sql="select * from user{$this->id}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())      
{
if(!empty($row['familyid']))
{
if($row['familyid']==$userid)
{
$list="family";
break;
}
}
if(!empty($row['friendid']))
{
if($row['friendid']==$userid)
{
$list="friend";
break;
}
}
if(!empty($row['colid']))
{
if($row['colid']==$userid)
{
$list="collegue";
break;
}
}
if(!empty($row['aquid']))
{
if($row['aquid']==$userid)
{
$list="aquantaince";
break;
}
}
if(!empty($row['noid']))
{
if($row['noid']==$userid)
{
$list="No aquintance";
break;
}
}
if(!empty($row['requestid']))
{
if($userid==$row['requestid'])
{
$requestingalready++;
$type=$row['type'];
break;
}
}
}
}
}

if(empty($list) && !empty($type))
{
echo "wants to add you in <b>{$type}</b> list";
}
if(!empty($list) && empty($type))
{
echo "in your <b>{$list}</b> list";
}
}
else
{
if(requesting("user".$userid,$this->id))
{
$sex=user_sex($userid);
if($sex=="female") $sex="her";else $sex="him";
echo "You have <b>invited</b> {$sex}";
}
else
{
if(!empty($useridlist))
{
$comman=array_intersect($useridlist,return_array("user".$userid,"listid"));
if(sizeof($comman)>0)
echo sizeof($comman). " comman relations";
else echo "No comman relations";
}
else 
echo "No comman relations";
}
}
}

//method to check whether user has uploaded any voice sample audio clip or not

function clip_exists()
{
$dbLink = new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['soundclips_db']);
if(mysqli_connect_errno()) 
{
die("MySQL connection failed: ". mysqli_connect_error());
}
$query = "select *from soundclipsofuser{$this->id} where set1='yes'";
$result = $dbLink->query($query);
if($result) 
{            
if($result->num_rows >= 1)
{
return true;
}
}
else return false;
}


//method to check whether user with specified id exists in any list

function if_exists($userid)
{
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select listid from user{$this->id} where listid='{$userid}'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
return true;
}
}
else return false;
}
}


//method to get feedback for profile from user of specified id 

function get_feedback4profile($userid)
{
$feedback_to_profile_db=$GLOBALS['feedback_to_profile_db'];
$html=false;$feedback="no";
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$feedback_to_profile_db);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
if($result=$mysqli->query("select DATE_FORMAT(when1,'%d %M %Y'),UNIX_TIMESTAMP(when1),feedback1 from profilefeedback4user{$this->id} where fromid='{$userid}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{

//getting the noun accordig to user'sex
if($this->sex=="female") {$hh="her";$h="she";}else {$hh="his"; $h="he";}

/*
//if feedback smiley is to be displayed
if($show_pic=="y")
{
if($this->id!=$userid)
echo "<img id='fback_pic' src='{$row['feedback1']}.bmp' title='{$row['feedback1']} smiley'>";
else echo "<img id='fback_pic' style='right:340px;' src='".fback_icon($row['feedback1'])."' title='{$row['feedback1']} smiley'>";
}
*/

//tweak to correct spelling mistake
$row['feedback1']=$row['feedback1']=="awesom"?"awesome":$row['feedback1'];

switch($row['feedback1'])
{
case "like":
case "dislike":
case "hate":
case "love":
$html= "<span title='about ".$this->ago($row[1])." (on {$row[0]})'>You ".$row['feedback1']."d ".$hh." profile</span>";
break;
case "stupid":
case "awesome":
$html= "<span title='about ".$this->ago($row[1])." (on {$row[0]})'>You thought color combination was {$row['feedback1']}</span>";
break;
case "likeminded":
$html= "<span title='about ".$this->ago($row[1])." (on {$row[0]})'>You thought you two were likeminded</span>";
break;
case "alterd":
$html= "<span title='about ".$this->ago($row[1])." (on {$row[0]})'>You thought color combination should be alterd</span>";
break;
case "best":
$html= "<span title='about ".$this->ago($row[1])." (on {$row[0]})'>You tought this was the best ".$h." could do</span>";
break;
default:
$html="No feedback from you";
break;
}
$feedback=$row['feedback1'];
}
}
else $html= "No feedback from you";
}

return array(
"html"=>$html,
"feedback"=>$feedback
);

}


//method to handle user's response/reaction on other user's profile 

function user_response($userid,$show_smiley='n')
{

$feedback_to_profile_db=$GLOBALS['feedback_to_profile_db'];
$comment_on_profile_db=$GLOBALS["comment_on_profile_db"];

//importing required javascript file
$this->import_script("userResponse_script.js");

//getting the noun accordig to user'sex
if($this->sex=="female") {$hh="her";$h="she";}else {$hh="his"; $h="he";}

$arg1='"'.$this->sex.'"';
$arg2='"'.$this->id.'"';
$arg3='"fback_statistic"';
$arg4='"body"';
$arg5='".2"';
$arg6='"all"';

//get feedback
$fback_arr=$this->get_feedback4profile($userid);

//displaying user's feedback

echo "<table class='pp-ur-table'>

<tr><td colspan='2'><h3>";

//get the feedback icon
if($fback_arr['feedback']!="no")
echo "<img id='fback_pic' class='fback-icon' title='Your feedback: ".ucwords($fback_arr['feedback'])."' src='".fback_icon($fback_arr['feedback'])."'/>&nbsp;";

echo "User's response</h3></td></tr>
<tr>
<td align='left'>
<span id='lu_feedback' onclick='show_fback_option({$arg1});'>".$fback_arr['html']."</span></br>
<a href='percentagebar.php?id={$this->id}' class='no_backg' target='fback_statistic' id='fs_link' onclick='show({$arg3});el({$arg4}).style.opacity={$arg5};'>Feedback</a> from <span onclick='fback_from({$arg2},{$arg6});'>".($this->total_entries("profilefeedback4user".$this->id,"fromid",$feedback_to_profile_db)-$this->deleted_accounts("profilefeedback4user".$this->id,"fromid",$feedback_to_profile_db))." others</span>
</td>

<td align='left'>
<span onclick='comments_from({$arg2});'>".(sizeof(array_unique(return_array_tweaked($comment_on_profile_db,"profilecomments4user{$this->id}","fromid")))-$this->deleted_accounts("profilecomments4user{$this->id}","fromid",$comment_on_profile_db,true))." people reacted</span></br>
<span id='total_comments' onclick='show_profileComments({$arg2},true);' title='make or see comments on {$hh} profile'>".($this->total_entries("profilecomments4user{$this->id}","fromid",$comment_on_profile_db)-$this->deleted_accounts("profilecomments4user{$this->id}","fromid",$comment_on_profile_db))." comments </span>
</td>
</tr>
</table>";

}

//method for handling user's response on website

function userResponseOnWebsite($div_id)
{

//importing required javascript file
$this->import_script("Fbackonwebsite_script.js");

$div_id='"'.$div_id.'"';
$arg2='"'.$this->id.'"';
$arg3='"fback_statistic"';
$arg4='"body"';
$arg5='".2"';
$arg6='"all"';


//displaying user's feedback
echo "

<table>
<tr>

<td>
<span id='lu_feedback' onclick='show_fback_option({$div_id});' >{$this->get_feedback4website(true)}</span></br>
<a href='percentagebar4website.php?id={$this->id}' class='no_backg' target='fback_statistic' onclick='show({$arg3});el({$arg4}).style.opacity={$arg5};' ><b>Feedback</b></a> from <span onclick='fback_from({$arg2},{$arg6});'>".($this->total_entries("feedbackonwebsite","fromid",$GLOBALS['feedback_to_website'])-$this->deleted_accounts("feedbackonwebsite","fromid",$GLOBALS['feedback_to_website']))." others</span>
</td><td>
<span onclick='comments_from({$arg2});' >".(sizeof(array_unique(return_array_tweaked($GLOBALS["comment_on_website"],"commentsonwebsite","fromid")))-$this->deleted_accounts("commentsonwebsite","fromid",$GLOBALS["comment_on_website"],true))." people reacted</span></br>
<span id='total_comments' onclick='show_profileComments({$arg2},true);'  title='make or see comments'>".($this->total_entries("commentsonwebsite","fromid",$GLOBALS["comment_on_website"])-$this->deleted_accounts("commentsonwebsite","fromid",$GLOBALS["comment_on_website"]))." comments </span>
</td>

</tr>

</table>
<div style='position:absolute;top:195px;right:565px;width:100px;margin-right:8px;' id='comment_colorlistContainer' class='colorlist'></div>";
}

//method for obtaining user's feedback on website

function get_feedback4website($show_pic=false)
{
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['feedback_to_website']);

if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select DATE_FORMAT(when1,'%d %M %Y'),UNIX_TIMESTAMP(when1),feedback from feedbackonwebsite where fromid='{$this->id}'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{

//if feedback smiley is to be displayed
if($show_pic)
{
echo "<img id='fback_pic' src='{$row['feedback']}.bmp' style='position:relative;top:-45px;right:-142px;'>";
}

//tweak to correct a spelling mistake
$row['feedback']=$row['feedback']=="awesom"?"awesome":$row['feedback'];

switch($row['feedback'])
{
case "like":
case "dislike":
case "hate":
case "love":
return "<span title='about ".$this->ago($row[1])." (on {$row[0]})'>You ".$row['feedback']."d this website</span>";
break;
case "stupid":
case "awesome":
return "<span title='about ".$this->ago($row[1])." (on {$row[0]})'>You thought the idea of this website was {$row['feedback']}</span>";
break;
case "best":
return "<span title='about ".$this->ago($row[1])." (on {$row[0]})'>You tought this was the best website</span>";
break;
default:
return "No feedback from you";
break;
}
}
}
else return "No feedback from you";
}
}


function other_actions($id)
{

//importing required javascript file
$this->import_script("otherActions.js");


}

function get_total_rel($get_arr=false){

return get_total_rel($this->id,$get_arr);

}


/*
*
*This method is used to place different notices for user using Jquery's plugin 'gritter'
*
*/


function put_gritter(){

/*if it's not first visit*/ 
if(!$this->get_intro_enabled()){
$gritter_var=$this->get_gritter_var();
if($gritter_var){

switch($gritter_var){
case "gritter_too_few_rel":
$title='<img src="dislike.bmp" height="15" width="15"/>&nbsp;You have too few relations!';
$text='<span class=" pointer underline-1" onclick="get_invite_popup();">Try inviting your contacts</span> or <span class=" underline-1 pointer show_expand_rel">Find people</span>';
break;

case "gritter_too_few_points":
$title='<img src="dislike.bmp" height="15" width="15"/>&nbsp;You have too few points!';
$text='<span class="underline-1 pointer" onclick="switch_view();">Try posting an interesting status</span> or <span onclick="switch_to_mp();" class=" underline-1 pointer">Earn points</span>';
break;

case "gritter_invalid_country":
$title='<img src="dislike.bmp" height="15" width="15"/>&nbsp;Country name invalid!';
$text='<a class="underline_onHover pointer" style="color:#fff !important;" href="update.php">Update your details</a>';
break;
}

//put gritter notice
$this->put_gritter_script($title,$text,$gritter_var);

}
}
}


function get_gritter_var(){
$vars=$this->gritter_unclosed_vars();
$arr=array();
$arr2=array();
if($vars!=false){
foreach($vars as $var){
array_push($arr,$this->check_gritter_var($var));
}
}
if(sizeof($arr)>=1)
{
foreach($arr as $val){
if($val['verified'])array_push($arr2,$val['var']);
}
if(sizeof($arr2)>=1)
return $arr2[array_rand($arr2)];
else
return false;
}
else 
return false;
}


function check_gritter_var($var){
$verified=false;
$threshold=searchSubArray($this->gritter_vars,"var",$var);
$threshold=$threshold['threshold'];
switch($var){
case "gritter_too_few_rel":
if($this->get_total_rel()<=$threshold)
$verified=true;
break;
case "gritter_too_few_points":
if($this->get_points()<=$threshold)
$verified=true;
break;
case "gritter_invalid_country":
if(!in_array($this->country,return_array("countries","country")))
$verified=true;
break;
}
return array("verified"=>$verified,"var"=>$var);
}


function gritter_unclosed_vars(){
$vars=array();
foreach($this->gritter_vars as $var){
array_push($vars,array($var['var']=>$this->conf_option_value($var['var'])=="closed"?false:true));
}
$arr=array();
foreach($vars as $k=>$var){
$k=array_keys($var);
if($var[$k[0]])array_push($arr,$k[0]);
}
if(sizeof($arr)>=1)
return $arr;
else 
return false;
}


function put_gritter_script($title,$text,$notice_var){
?>
<script type="text/javascript" src="js/jquery.gritter.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.gritter.css" />
<script>
$.gritter.add({
	title: '<?php echo $title ?>',
	text: '<?php echo $text; ?>',
	sticky: true,
class_name: 'sticky_notice',
before_close: function(e, manual_close){
apprise("Don't show this message again?", {'verify':true}, function(r) {
if(r) { 
$.post("controller/core.php",{"core_action":"setters","core_file":"update_conf_value.php","var":"<?php echo $notice_var; ?>","value":"closed"},function(d){if(parseInt(d)!=1)alert("Error: failed to save gritter configuration");});
} 
});
}
});
</script>
<?php
}



}


?>