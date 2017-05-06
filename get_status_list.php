<?php

include("environment.php");
check_auth();

if(!empty($_POST['l']) && in_array($_POST['l'],array("f","fam","col1","aqu1","no1")))
{

//manipulating the supplied variable

if($_POST['l']=="f")
$_POST['l']="friendid";
if($_POST['l']=="fam")
$_POST['l']="familyid";
if($_POST['l']=="col1")
$_POST['l']="colid";
if($_POST['l']=="aqu1")
$_POST['l']="aquid";
if($_POST['l']=="no1")
$_POST['l']="noid";

//getting the corresponding array
$l=array_values(array_filter(return_array("user{$_SESSION['userid']}",$_POST['l'])));


for($i=0;$i<sizeof($l);$i++)
{
if(account_status($l[$i]))
{
$user_name=user_name($l[$i]);
$is_online=is_online($l[$i]);

?>
<li>

<?php if($is_online){?>
<div class="inline u_online">
<img width='15' title="<?php echo $user_name." is online"; ?>"  src='images/online_icon.png' alt='online'/>
</div>
<?php
}
?>

<a href="<?php echo get_profile_url($l[$i]);?>" title="&lt;img src='<?php echo prof_pic($l[$i]); ?>' height='160' width='160' /&gt;"><?php echo $user_name;?></a>

<img onClick="chatWith('<?php echo $l[$i]."','".$user_name ;?>');" class="start_chat pointer" title="Start chatting with <?php echo $user_name; ?>" src="images/chat.png" alt="Start chat"/>

<?php if(!$is_online){ ?>
<br/>

<span class="light_text">Was last online: <?php echo ago(strtotime(user_last_online($l[$i]))); ?></span>
<?php
}
else
{
?>
<br/>
<span class="light_text">is now online</span>
<?php
}

?>

</li>
<?php
}
}
}

else 
{
header('location:home.php');
}
?>