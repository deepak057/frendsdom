<?php

include("environment.php");
check_auth();

if(!empty($_POST['active'])) 
{

//first, update user's online status
update_entity("userdata","id",$_SESSION['userid'],"last_active",date('Y-m-d H:i:s'));

//if(!empty($_POST['home'])){

//check and manipulate other values supplied 
$news=(empty($_POST['news'])) ? 0 : $_POST['news'];
$in_req=(empty($_POST['in_req'])) ? 0 : $_POST['in_req'];
$atr_req=(empty($_POST['atr_req'])) ? 0 : $_POST['atr_req'];
$nudges=(empty($_POST['nudges'])) ? 0 : $_POST['nudges'];
$msgs=(empty($_POST['msgs'])) ? 0 : $_POST['msgs'];
$lu_points=(empty($_POST['lu_points'])) ? 0 : $_POST['lu_points'];
$lp_id=(empty($_POST['lp_id'])) ? 0 : $_POST['lp_id'];

//getting the number of new news
$news=max((get_new_news($_SESSION['userid'])-$news),0);

//getting the number of unread messages
$msgs=max((get_unread_msgs($_SESSION['userid'])-$msgs),0);

//getting the number of new nudges
$nudges=max((get_new_nudges($_SESSION['userid'])-$nudges),0);

//getting the number of new authority requests
$atr_req=max((get_atr_req($_SESSION['userid'])-$atr_req),0);

//getting the number of new invitations
$in_req=max((get_invitations($_SESSION['userid'])-$in_req),0);

//getting user's current points
$lu_points=max((get_points($_SESSION['userid'])-$lu_points),0);

/******getting number of msgs sent to strangers******/
$count=in_array($_SESSION['userid'],$GLOBALS['privileged_ids'])?false:conf_option_value($_SESSION['userid'],"msgs_to_strangers");
$temp=(!$count)?array(0,0):explode(":",$count);
$count=$temp[0];$ts=$temp[1];
//check if it's been x hours since the message was sent to first stranger
if(hours_old($ts)>=$GLOBALS['msgs_to_stangers_hours'])
$count=0;
if($count>=$GLOBALS['max_msgs_to_stangers'])
$mtos="
<div class='left'>
<h3><img src='alert.gif' align='middle'/>Message limit exceeded for today</h3>
You have sent {$count} messages to strangers. No more than {$GLOBALS['max_msgs_to_stangers']} messages can be sent to strangers within {$GLOBALS['msgs_to_stangers_hours']} hours. You might get success message but messages will not actually be delivered to recipients that are not in your relation lists.
</div>
";
else{
$mtos=0;
 setcookie("mtos_msg", "", time()-3600);
}


//getting number of new posts
$np_limit=array();
if(strpos($lp_id,"undefined")!==false){
$np_limit['l1']=0;
$np_limit['l2']=total_entries("status_view_of_user{$_SESSION['userid']}","post_id",$GLOBALS['status_view_db']);
}
else{
//new logic
if($_POST['inv_accepted']!="true"){
$ga=get_new_posts_wrt($_SESSION['userid'],$lp_id);
$np_limit['l2']=$ga['l2'];
$np_limit['l1']=$ga['l1'];
}
else{
$ga=get_posts_aia($_SESSION['userid'],$_POST['inv_from_id']);
$np_limit['l2']=$ga['l2'];
$np_limit['l1']=$ga['l1'];
}
/*
//old logic
$np_limit['l2']=get_records("status_view_of_user{$_SESSION['userid']}","post_id",$lp_id,$GLOBALS['status_view_db']);
if($np_limit['l2']>0)
$np_limit['l1']=total_entries("status_view_of_user{$_SESSION['userid']}","status_index",$GLOBALS['status_view_db'])-$np_limit['l2'];
else $np_limit['l1']=0;
*/

}

//displaying data
echo json_encode(array("news"=>$news,"msgs"=>$msgs,"nudges"=>$nudges,"atr_req"=>$atr_req,"in_req"=>$in_req,"lu_points"=>$lu_points,"lp_limit"=>$np_limit,"mtos"=>$mtos));
}
//}

else
{
header('location:home.php');
}
?>