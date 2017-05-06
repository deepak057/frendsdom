<?php

if(!empty($_GET["type"])){

include("includes.php");

//execute the supplied method and get users
$users=call_user_func(array($get_users,$_GET["type"]));


//display content
?>
<div class="pp-content">

<div class="top-margin">

<!--<span class="pointer pp-choose-all"><input type="checkbox"/> Choose All</span>-->

</div>

<ul>
<?php

foreach ($users as $user){

if($user['id']!=uid()){

//check if this post has already been promoted to this user
$promotional_points=post_promotional_points($user['id'],$_REQUEST['post_id']);

?>

<li class="pp-user-block">

<div>

<div class="fl">

<a href="<?php echo get_profile_url($user['id']); ?>">

<img src="<?php echo prof_pic($user['id']); ?>" height="100" width="100" />

</a>

</div>

<div class="left fr">

<a class="dui" data-hovercard-id="<?php echo $user['id']; ?>" href="<?php echo get_profile_url($user['id']); ?>">

<?php echo tunethename($user['name'],17); ?>

</a>

<div class="small light_text top-margin">
<?php  echo $user['country']; ?>
</div>

<div class="small top-margin">
<i><span class="pp-chosen-label"><?php if(!$promotional_points) echo "Choose"; else echo "Chosen"; ?></span> for <span class="pp-user-rp"><?php if(!$promotional_points) echo get_recommended_points($user['id']); else echo $promotional_points['promotional_points']; ?><span> points</i>
</div>

<div class="top-margin">
<?php 

if(!$promotional_points['seen']){

?>
<button uid="<?php echo $user['id']; ?>" post-id="<?php echo $_REQUEST['post_id']; ?>" class="btn pp-choose-user-btn <?php if($promotional_points) echo "red_bg"; ?>"><?php if(!$promotional_points) echo "Choose"; else echo "Cancel" ?></button>
<?php

}

else {
?>

<div>

<b><img width="20" src="<?php echo get_image("checkmark.gif"); ?>"/><i>Seen</i></b>

</div>

<?php


}

?>

</div>


</div>

<div class="clear"></div>

</div>
</li>

<?php
}
}
?>

</ul>
</div>
<?php


}



?>