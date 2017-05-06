<?php

include("environment.php");
check_auth();

if(!empty($_POST['toid']) && !empty($_POST['gen']))
{

if(!if_alreadyexists($_SESSION['userid'],$_POST['toid']) && !if_alreadyexists($_POST['toid'],$_SESSION['userid']) && !if_exists("user{$_POST['toid']}","requestid",$_SESSION['userid']) && !if_exists("user{$_SESSION['userid']}","requestid",$_POST['toid']))
{

if($_POST['gen']=="female")$hh= 'her'; else $hh='him';

?>
<div class='fl'><b>How do you know <span class='fp_hh'><?php echo $hh ?></span> ?</b><p><input type='radio' name='fp_invite_type' value='friend' id='fp-invite-friend'><label for='fp-invite-friend' class='pointer'>Friend</label><br/><input id='fp-invite-family' type='radio' name='fp_invite_type' value='family'><label for='fp-invite-family' class='pointer'>Family</label><br/><input id='fp-invite-colleague' type='radio' name='fp_invite_type' value='col'><label for='fp-invite-colleague' class='pointer'>Colleague</label><br/><input type='radio' name='fp_invite_type' value='aqu' id='fp-invite-aqu'><label class='pointer' for='fp-invite-aqu'>Acquaintance</label><br/><input type='radio' name='fp_invite_type' value='no' checked='checked' id='fp-invite-npa'><label class='pointer' for='fp-invite-npa'>No Prior Acquaintance</label></p><p class='light_text'><i>You should offer <?php echo $hh ?>:<?php echo get_recommended_points($_POST['toid']); ?> point(s)</i></p><p><img style='position:relative;top:-5px;' src='images/spend.png' align='middle' width='20'/>Offer <?php echo $hh;?> <input class='blue_onhover offer_point_field' type='text' onkeyup='checkInput(this)' size='2'/> points</p><p><input type='button' value='Invite Now' class='special_btn fp_invite_btn1'/>&nbsp;<input type='button' value='Cancel' onclick="hide_invite_pop_up()" class='special_btn redback fp_close_popup'/></p></div><div class='fr'><img src="<?php echo prof_pic($_POST['toid']);?>" width='230' height='265'/></div><div class='clear'></div>
<?php
//displaying logged in user's sum of points
put_lu_points($_SESSION['userid'],"position:absolute;top:1px;left:-120px;");

}
else{
echo "Error: failed to send request";
}

}
else{
header('location:home.php');
}

?>