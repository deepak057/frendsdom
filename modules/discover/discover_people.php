<?php

/*

This class is used to manipulate Posts records to help generate content on Discover People page
This class relies on FunctionList.php which must already be included

*/

class discover_people{


/*
variable to decide how many posts have to 
be sent down on every run/call/execution of this script
*/

private $posts_count=15,

/*
Variable to decide how many posts can be shown from same user
*/

$posts_from_same_user=1;


function get_post_ids($last_uid=false){

//get last registerd user's id
$last_user_id=!$last_uid?get_last_id():($last_uid-1);

//variable to keep track of how many posts have been found in this run
$posts_found=0;

//the array to hold final results
$post_ids=array();

/*
start going backward and check each user's status view
to see if there are public posts

*/

while ($last_user_id){

//get Post_IDs from this user's post record
$ids=$this->get_user_post_ids($last_user_id);

if(count($ids)){ //if posts were found

$posts_found+=count($ids); //increment counter by total size of array

foreach($ids as $id)$post_ids[]=$id;

}

//breaking the loop if number of posts for this run have been processed
if($posts_found>=$this->posts_count)break;

$last_user_id--;

}

return $post_ids;

}


function get_user_post_ids($uid){

//array to hold final results
$return=array();

if(account_status($uid) && $uid!=uid()){

//connect to Post Records database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['posts_db']);

if($result=$mysqli->query("select * from posts_record_of_user{$uid} where `public`=1 AND ".SQL_not_in($GLOBALS['banned_posts_ids'],'post_id')." ORDER BY `created` DESC limit {$this->posts_from_same_user}"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{

if(!empty($row['post_id']))
$return[]=array("post_id"=>$row['post_id'],"uid"=>$uid,"row"=>$row);

}
}
}
}

return $return;

}

function get_view($last_uid=false){

return $this->get_posts_view($this->get_post_ids($last_uid));

}


function get_posts_view($post_ids){

//get colors
$colors=light_colors();

foreach ($post_ids as $id){

//get the user that created this post
$user=new user($id['uid']);

//checking if this post contains picture
if(!if_empty($id['row']['pic_id'])){
$post_img_content="<img class='dp-post-pic' title='Enlarge this picture' src='".get_post_pic($id['row']['pic_id'])."'/>";
}
else{
$post_img_content=null;
}

//checking if this post contains any news
if(!if_empty($id['row']['news_id'])){
$post_news_content=hp_post_news_content($id['row']['news_id']);
}
else{
$post_news_content='';
}

//checking if this post contains any movie
if(!if_empty($id['row']['movie_id'])){
$post_movie_content=hp_post_movie_content($id['row']['movie_id']);
}
else{
$post_movie_content='';
}

//checking if this post contains any video
if(!if_empty($id['row']['video_id'])){
$post_video_content=hp_post_video_content($id['row']['video_id']);
}
else{
$post_video_content='';
}


?>

<div uid="<?php echo $id['uid']; ?>" post-id="<?php echo $id['post_id']; ?>" class="dp-post-block" style="background:<?php echo pick_random($colors);?>;">

<div class="fl dp-post-owner-meta">


<div>
<a class="bold dui" data-hovercard-id="<?php echo $user->user->id; ?>" href="<?php echo get_profile_url($user->user->id); ?>">

<?php echo tunethename($user->user->first." ".$user->user->last); ?></a>
</div>

<a href="<?php echo get_profile_url($user->user->id); ?>">
<img class="dp-profile-pic br-50" src="<?php echo $user->prof_pic() ?>"/>

</a>

</div>

<div class="fr dp-post-content" >

<?php echo text($id['row']['post_content']);?>

<div class="post_content_img"><?php echo $post_img_content; ?></div>

<div><?php echo $post_news_content; ?></div>

<div><?php echo $post_movie_content; ?></div>

<div><?php echo $post_video_content; ?></div>
</div>

<div class="clear"></div>


<div>

<input class="special_btn dp-show-post-btn center hidden" type="button" value="See full post" onclick="dp_display_post(this,'<?php echo $id['post_id']; ?>')"/>

</div>

</div>



<?php
}


}

}
?>