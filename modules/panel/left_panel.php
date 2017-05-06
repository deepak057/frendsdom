<?php

//retrieving slide panel's configuration
require('conf.php');

class panel{

public $users=array();


function __construct($id){
$this->users=$this->get_users($id);
}


function get_users($id){
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
$arr=array();
if($result=$mysqli->query(get_asl_query()))
{
if($result->num_rows>0){
while($row=$result->fetch_array()){
if($row['id']!=$id && !if_alreadyexists($id,$row['id'])){
array_push($arr,array("id"=>$row['id'],"name"=>$row['first']." ".$row['last'],"country"=>country_name($row['country'])));
}
}
}
}
return $arr;
}


//method to show user pics arranged in grid

function put_grid_view($rows=7,$cols=3){
?>
<script type="text/javascript" src="js/modernizr.custom.26633.js"></script>
<script type="text/javascript" src="js/jquery.gridrotator.js"></script>
<link rel="stylesheet" type="text/css" href="css/gridrotator.css" />
<div id="ri-grid" class="ri-grid ri-shadow">
<img class="ri-loading-image" src="images/loading.gif"/>
<ul>
<?php 
foreach ($this->users as $user){
?>
<li><a class="cluetip_obj" rel="/displayuserinfo.php?id=<?php echo $user['id']; ?>" href="<?php echo get_profile_url($user['id']); ?>"><img alt="<?php echo $user['name'];?>" src="<?php echo get_thumb($user['id']); ?>" /></a></li>
<?php
}
?>
</ul>
</div>
<script>
	$("#cu_lpanel").css("top","-32px");
	$( '#ri-grid' ).gridrotator({w240 : {rows : <?php echo $rows; ?>,columns :<?php echo $cols; ?> },preventClick:false});
</script>
<?php
}


//method to show user pics arranged in vertical carousel

function put_carousel_view(){
?>
<div class="jcarousel-skin-tango"><div style="position: relative; display: block;" class="jcarousel-container jcarousel-container-vertical"><div style="position: relative;" class="jcarousel-clip jcarousel-clip-vertical">
<ul style="overflow: hidden; position: relative; top: -595px; margin: 0px; padding: 0px; left: 0px; height: 950px;" id="left_panel_carousel" class="jcarousel jcarousel-list jcarousel-list-vertical">
<?php
foreach ($this->users as $user){
?>
<li>
<a href="<?php echo get_profile_url($user['id']); ?>" class="cluetip_obj hp-sp-img-link" rel="/displayuserinfo.php?id=<?php echo $user['id']; ?>"><img alt="<?php echo $user['name'];?>" src="<?php echo get_thumb($user['id'],160,160); ?>" class='adipoli hp-caurosel-pic'/><br/><span class="small"><?php echo $user['name'];?></span><br/><span class="small grey"><?php echo $user['country']; ?></span></a>
</li>
<?php
}
?>
</ul></div><div disabled="false" style="display: block;" class="jcarousel-prev jcarousel-prev-vertical"></div><div disabled="true" style="display: block;" class="jcarousel-next jcarousel-next-vertical jcarousel-next-disabled jcarousel-next-disabled-vertical"></div></div></div>
<script>
function left_panel_initCallback(carousel)
{

    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });
    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });

$("#left_panel_carousel").mouseleave(function(){
carousel.startAuto(lp_auatoScroll);
});
};
var lp_auatoScroll=2;
	$("#left_panel_carousel").jcarousel({
auto: lp_auatoScroll,
        wrap: 'circular',
        vertical: true,
	scroll:1,
animation:"slow",
initCallback:left_panel_initCallback
});
var lpc_obj = jQuery('#left_panel_carousel').data('jcarousel');
$("#cluetip").live("mouseenter",function(){
lpc_obj.startAuto(0);
}).live("mouseleave",function(){
lpc_obj.startAuto(lp_auatoScroll);
});
</script>
<?php
}


function put_left_panel($enabled=true){
?>
<div class="vs_container">
<div class="no_wh">
<div id="cu_lpanel" class="cu_lpanel pointer none">
<img src="./pref.png" title="Customize sliding panel"/>
</div>
</div>
<div id="panel"></div>
<p class="slide"><a href="javascript:void(0);" id="lp-slider" class="btn-slide special_btn">Slide Panel</a></p>
</div>
<script>
var lp_enabled=<?php echo $enabled; ?>;
$("#lp-slider").attr('onclick','enable_left_panel()');
function enable_left_panel(){
$("#panel").slideToggle("slow");
$(this).toggleClass("active");
if($("#lp_ads").css("display")=="block"){
$("#lp_ads").css("display","none");
}
else{
$("#lp_ads").css("display","block");
}
if(lp_enabled)lp_enabled=0;else lp_enabled=1; 
w.postMessage("update_boolean entity=slide_panel&value="+lp_enabled);
w.onmessage=function(e){if(parseInt(e.data)!=1)alert("Error:failed to disable/enable slide panel");};
return false;
}
</script>
<?php if($enabled) {?>
<style type="text/css">
#panel{display:block;}
</style>
<?php } else{ ?>
<style type="text/css">
#lp_ads{display:block;}
</style>
<?php
}
}


/*

Method to return the Content of Slide Panel depending upon current

user's panel configuration

*/


function get_panel_content($lu=false){
?>
<?php 
$lu=!$lu?$GLOBALS['lu']:$lu;
if(!$lu->conf_option_value("lp_conf_view") || $lu->conf_option_value("lp_conf_view")=="carousel")
$this->put_carousel_view();
else
$this->put_grid_view();
?>
<?php

}

}
?>