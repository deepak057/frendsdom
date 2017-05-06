<?php

/*

This class is used to generate Share Box on profile page
This class relies on FunctionList.php which must already be included

*/


class share_box{

private $user;

function __construct($user){

$this->user=$user->user;

}

//method to get all the "shares" from database

function get_rows(){

return get_all_fields("select * from sboxofuser{$this->user->id}",$GLOBALS['share_box_db']);

}

function get_share_by_id($share_id){
return get_all_fields("select * from sboxofuser{$this->user->id} where share_id='{$share_id}'",$GLOBALS['share_box_db']);
}

function put_share($share_id){
ob_start();
$this->put_share_blocks($this->get_share_by_id($share_id));
return ob_get_clean();
}

function get_count($rows){

$i=0;
foreach($rows as $row)
$i++;

return $i;

}

function put_sbox(){

//get data
$shares=$this->get_rows();


?>

<div class="back-1" id="pp-sbox-head">
<div class="pp-sbox-top-header">
<div class="fl"><strong class="font17"><?php echo $this->user->first; ?>'s Share Box</strong><span class="small">&nbsp;(<span class="sb-blocks-count"><?php echo $this->get_count($shares); ?></span> Shares)</span></div>
<div class="fr"><?php echo $this->get_button(); ?></div>
<div class="clear"></div>
</div>
</div>
<div class="pp-sbox-container overflow-auto">
<?php

if($this->get_count($shares)>0){

//put shares
$this->put_share_blocks($shares);

}

else {

?>

<div class="center pp-no-shares" id="pp-no-shares"><h3 class="grey"><img align="middle" src="<?php echo get_image("empty.png"); ?>"/>No Shares Yet</h3></div>


<?php
}

?>
</div>
<?php
}

function put_share_blocks($shares){

foreach ($shares as $share){
?>
<div cl-callback="sb_update_bg_color" original-back="<?php echo $share->background; ?>" class="pp-sbox-block sb-clist-target-block" style="background:<?php echo $share->background; ?>" share-id="<?php echo $share->share_id; ?>">

<?php
if($this->own_profile()){
?>
<div class="no_wh">
<div class="sb-onhover-visible none">
<span class="sb-cl-trigger pointer">&#916;</span>
<img title="Delete this share" share-id="<?php echo $share->share_id; ?>" class="pointer pp-remove-sb-trigger" src="<?php echo get_image("close.png"); ?>"/>
</div>
</div>

<?php
}

?>

<?php if(!empty($share->share_pic_type)){
?>
<div class="pp-sb-img">
<?php echo get_share_image($share,$this->user->id); ?>
</div>
<?php
}
?>
<div id="sbtitle-<?php echo $share->share_id; ?>" class="pp-sb-title left">
<?php  echo text($share->share_title); ?>
</div>
<div id="sbdes-<?php echo $share->share_id; ?>" class="pp-sb-des left small">
<?php echo text($share->share_data); ?>
</div>
</div>
<?php
}
}

function own_profile(){
return $this->user->id==uid();
}

function get_button(){

//if user is visiting their own profile
if($this->own_profile()){

return '<input class="special_btn pp-create-share-btn" type="button" value="Add New"/>';

}

else {

return $this->put_notify_btn();

}


}


//method to check whether the one visiting profile has marked Share Box as seen


function has_notified(){

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['news_db']);
if($result=$mysqli->query("select * from news4user".$this->user->id." where news='check_in' && from_id='".uid()."' && viewed=0"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                           
{
return true;
}
}
}

}

function put_notify_btn(){

ob_start();

if($this->has_notified()){
?>

<input type='button' class='special_btn' style='background:red;' onclick="check_out(this,'<?php echo $this->user->id;?>','<?php echo $this->user->sex; ?>');" value='Cancel notification' title='let this user know that you viewed their share box' id='check_in_btn'>

<?php
}

else {
?>

<input type='button' class='special_btn' onclick="check_in(this,'<?php echo $this->user->id;?>','<?php echo $this->user->sex;?>');" value='Notify <?php echo get_gender_noun($this->user); ?> about this visit' title='let this user know that you viewed their share box' id='check_in_btn'>

<?php
}

return ob_get_clean();

}




}


?>