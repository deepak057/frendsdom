<?php

/**
* This class is used to control all kind 
* of Hobbies related activities
*/


require_once("../includes/includes.php");


class hobbies {


/*
*method to return array of all available hobbies
*/

function get_hobbies($offset=0,$limit=10){

$return=array();

$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['hobbies_db']);

$sql="select * from hobbies limit {$offset}, {$limit}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
$return[]=$row;
}
}
}

return $return;

}


/*
*method to return array containing users that have subscribed
* to hobby of given id
*/

function get_subscribers($hobby_id,$total=10,$exclude=array()){

$users=array();

//part of query to exclude given users
$excluded_part=count($exclude)?" AND ". SQL_not_in($exclude,"uid"):"";

$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['hobbies_subscription_db']);

$sql="select * from hobbies_subscription where hobby_id= {$hobby_id} {$excluded_part} order by RAND() limit {$total}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
$users[]=$row;
}
}
}

return $users;

}


/*
*method to return the array of filtered users that have
* subscribed to a given hobby
*/

function users_by_hobby_id($hobby_id,$total=5,$exclude=array()){

//get subscribers
$users=$this->get_subscribers($hobby_id,$total,$exclude);

//final arrary to be returned
$return=array();

if(!count($users))return $return;

//form SQL query
$sql="select id,first,last,country from userdata where ". SQL_valid_users(false). " && ".SQL_not_in($this->get_uids($users),"id",false)." order by RAND()";

$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);

if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
$return[]=$row;
}
}
}

return $return;

}

/*
* method to strip out uids from given array
*/

function get_uids($arr){
$ids=array();

if(count($arr)){

foreach($arr as $row)
$ids[]=$row['uid'];

}

return $ids;
}



/*
* Method to return the VIEW for displaying subscribers to
* a given hobby
*/

function subscribers_view($hobby_id,$total=10,$exclude=array()){

//get subscribers
$users=$this->users_by_hobby_id($hobby_id,$total+2,$exclude);

//get output into buffer
ob_start();

if(count($users)){

foreach($users as $k=>$user){

if($k==$total)break;

?>
<a href="<?php echo get_profile_url($user['id']) ?>" title="<?php echo $user['first']." ".$user['last']." from ".$user['country']; ?>"><img class="hb-us-pp" src="<?php echo get_thumb($user['id'],25,25); ?>"/></a>
<?php
}

if(count($users)>$total){
?>

<a title="More people who like <?php echo hobby_title($hobby_id); ?>" h-id="<?php echo $hobby_id; ?>" class="blue-link small all-subscribers-trigger" href="javascript:void(0)">More</a>

<?php
}

}


else echo "<span class='grey small'>No one yet</span>";

return ob_get_clean();

}


function all_subscribers_view($hobby_id,$total,$exclude){

//get subscribers
$users=$this->users_by_hobby_id($hobby_id,$total,$exclude);

if(count($users)){

ob_start();

?>
<div class="all-subscribers-wrap">
<ul>

<?php
foreach($users as $user){

?>

<li>


<div class="fl">

<a  href="<?php echo get_profile_url($user['id']) ?>"><img src="<?php echo get_thumb($user['id'],50,50); ?>"/></a></div>
<div class="fr left">

<div>
<a class="small dui" data-hovercard-id="<?php echo $user['id']; ?>" href="<?php echo get_profile_url($user['id']) ?>"><?php echo $user['first']." ". $user['last']?></a>
</div>

<div class="grey small"><?php echo country_name($user['country']); ?></div>

</div>
<div class="clear"></div>
</a>

</li>


<?php

}

?>

</ul>
</div>

<?php
return ob_get_clean();

}

 return "<span class='small grey'>No one yet</span>";

}



/**
* method to generate HTML view for stack of Hobbies 
*/

function hobbies_stack($uid=false,$offset=0,$limit=10){

//get subscribed hobbies by given user
$subscribed_hobbies=subscribed_hobbies(uid($uid));

foreach ($this->get_hobbies($offset,$limit) as $row){
?>
<p class="hobby-row" hobby-id="<?php echo $row['id']; ?>"><input value="<?php echo $row['id']; ?>" type="checkbox" <?php if(in_array($row['id'],$subscribed_hobbies)) echo "checked='checked'"; ?>/> I like <?php echo $row['hobby']; ?></p>
<?php
}

}


/*
*method to return VIEW for Hobbies welcome popup
*/

function welcome_popup($uid=false){

ob_start();
?>
<div class="pull-up">
<h2>What do you like, choose a few hobbies</h2>
<p>Discover people worldwide who share similar interests with you</p>
</div>
<div class="hobbies-wrap">
<div class="hobbies-container fl">
<?php
$this->hobbies_stack();
?>
</div>
<div class="fr pp-similar-hobbies-wrap"></div>
<div class="clear"></div>
</div>
<p><input type="button" class="btn-special-blue btn-special-blue-primary" id="save-hobbies-btn" value="Save"/></p>
<?php
return ob_get_clean();
}

/**
* Method to subscribe given user to given hobbies
*/

function save_hobbies($selected_hobbies,$uid=false){

//first, get hobbies subscribed currently
$current_hobbies=subscribed_hobbies($uid);	

//get hobbies to be removed if any
$hobbies_to_be_removed=array_diff($current_hobbies,$selected_hobbies);

//hobbies to be inserted if any
$hobbies_to_insert=array_diff($selected_hobbies,$current_hobbies);

//connect to database
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['hobbies_subscription_db']);

if(count($hobbies_to_be_removed)){
$mysqli->query("delete from hobbies_subscription where ".SQL_not_in($hobbies_to_be_removed,"hobby_id",false)." AND uid=".uid($uid));

}

if(count($hobbies_to_insert)){

$query="insert into hobbies_subscription (uid,hobby_id,`date`) values ";
foreach ($hobbies_to_insert as $h)
$query.=" (".uid($uid).",{$h},'".get_date_time()."'), ";



if($mysqli->query(str_lreplace(",","",$query))){

echo "success";

}

else echo str_lreplace(",","",$query);exit;





}

return true;

}



}


?>