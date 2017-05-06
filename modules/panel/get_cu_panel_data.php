<?php

//include system's environment 
include("includes.php");

if(!empty($_POST['flag']))
{

//instantiating class user
$lu=new user($_SESSION['userid']);

//getting countries
$countries=return_array("countries","country");

?>
<div id="cu-lp-accordion" class="ic_accordion">
<h3><img align="middle" class="img1 panel-imgs" src="<?php echo get_image("people_1.png");?>"/>&nbsp;People</h3>
<div class="acc_block white-back">
<fieldset>
<legend><p>Show people only whose:</p></legend>
<table cellspacing='1'><tr><td align='right'>Age:</td><td><select name='age' id='hp_fp_age'><option value='all' <?php if(!$lu->conf_option_value('lp_conf_age') || $lu->conf_option_value('lp_conf_age')=="all")echo "selected"; ?>>All<option value='13-18' <?php if($lu->conf_option_value('lp_conf_age')=="13-18")echo "selected"; ?>>13-18<option value='19-25' <?php if($lu->conf_option_value('lp_conf_age')=="19-25")echo "selected"; ?>>19-25<option value='26-35' <?php if($lu->conf_option_value('lp_conf_age')=="26-35")echo "selected"; ?>>26-35<option value='36-45' <?php if($lu->conf_option_value('lp_conf_age')=="36-45")echo "selected"; ?>>36-45<option value='46-60' <?php if($lu->conf_option_value('lp_conf_age')=="46-60")echo "selected"; ?>>46-60<option value='60+' <?php if($lu->conf_option_value('lp_conf_age')=="60+")echo "selected"; ?>>60+</select></td></tr><tr><td align='right'>Sex:</td><td><select name='sex' id='hp_fp_sex'><option value='all' <?php if(($lu->conf_option_value('lp_conf_sex')=="all") || !$lu->conf_option_value('lp_conf_sex'))echo "selected"; ?>>All<option value='male' <?php if($lu->conf_option_value('lp_conf_sex')=="male")echo "selected"; ?>>Male<option value='female' <?php if($lu->conf_option_value('lp_conf_sex')=="female")echo "selected"; ?>>Female</select></td></tr><tr><td align='right'>Location:</td><td><select name='country' id='hp_fp_country'><option value='all' <?php if($lu->conf_option_value("lp_conf_country")=="all" || !$lu->conf_option_value("lp_conf_country")) echo "selected";?>>Country (All)
<?php
for($i=0;$i<sizeof($countries);$i++)
{
?>
<option value='<?php echo $countries[$i]; ?>' <?php if($lu->conf_option_value("lp_conf_country")==$countries[$i]) echo "selected";?> ><?php echo $countries[$i];?>
<?php
}
?>
</select>&nbsp;<input type='text' name='state' <?php if($lu->conf_option_value("lp_conf_state")) echo "value='".$lu->conf_option_value("lp_conf_state")."'";?> id='hp_fp_state' placeholder='State (optional)' class='blue_onhover'/>&nbsp;<input type='text' <?php if($lu->conf_option_value("lp_conf_city")) echo "value='".$lu->conf_option_value("lp_conf_city")."'";?> name='city' placeholder='City (optional)' class='blue_onhover' id='hp_fp_city'/></td></tr><tr><td></td><td>
<input type="checkbox" id="lm_cu_pp" <?php if($lu->conf_option_value("lp_conf_pp")=="true" || !$lu->conf_option_value("lp_conf_pp")) echo "checked"; ?>/>Show only those having a profile picture  
</td></tr>
</table>
</fieldset>
</div>
<h3><img src="<?php echo get_image("view_1.png");?>" class="img1 panel-imgs" align="middle"/>&nbsp;View</h3>
<div class="acc_block white-back">
<fieldset>
<legend>View:</legend>
<table>
<tr>
<td>Panel view</td><td>
<input id='lp-view-option-carousel' type='radio' name='cu_lm_view' value='carousel' <?php if(!$lu->conf_option_value("lp_conf_view") || $lu->conf_option_value("lp_conf_view")=="carousel") echo "checked='true'";?>/><label for='lp-view-option-carousel'>Carousel</label>
<input id='lp-view-option-grid' type='radio' name='cu_lm_view' value='grid' <?php if($lu->conf_option_value("lp_conf_view")=="grid") echo "checked='true'";?>/><label for='lp-view-option-grid'>Grid</label>
</td>
</tr>
</table>
</fieldset>
</div>
</div>
<table>
<tr>
<td></td>
<td><input type='submit' style='margin-top:10px;' class='special_btn cu_lm_btn' value='Update'/></td>
</tr>
</table>
<?php

}
else{
header('location:home.php');
}
?>
