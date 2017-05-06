<?php


//get Slider configuration for cuurent user
$conf=get_slider_conf(get_lu());

?>

<div class="pp-slider-conf-wrapper">
<h3>
<img width="30" src="<?php echo get_image("pref.png"); ?>" align="middle" style="position:relative;top:-8px"/>
Customize Slider
</h3>
<div class="pp-slider-content">
<table cellspacing="5" cellpadding="5">
<tr>
<td><label for="pp-sc-theme">Theme :</label></td>
<td><select class="pp-slider-conf-elem" name="theme" id="pp-sc-theme">
<?php
foreach (array("stitch","light","dark") as $opt){
?>
<option value="<?php echo $opt; ?>" <?php if($opt==$conf['theme']) echo "selected='selected'"; ?>><?php echo ucwords($opt); ?></option>
<?php
}
?>
</select></td>
<td valign="bottom"><label for="pp-sc-fslide">&nbsp;First Slide :</label></td>
<td>
<select class="pp-slider-conf-elem" name="firstSlide" id="pp-sc-fslide">
<?php
foreach (array("Feedback & Comments","Recent Status","Cover Picture","Basic Info","Share Box") as $k=>$opt){$k++;
?>
<option value="<?php echo $k?>" <?php if($k==$conf['firstSlide']) echo "selected='selected'"; ?>><?php echo $opt; ?></option>
<?php
}
?>
</select>
</td>
</tr>
<tr>
<td><label for="pp-sc-activateOn">Activate On :</label></td>
<td colspan="3">
<select class="pp-slider-conf-elem" name="activateOn">
<option value="click" <?php if($conf['activateOn']=="click") echo "selected='selected'"; ?>>Click</option>
<option value="mouseover" <?php if($conf['activateOn']=="mouseover") echo "selected='selected'"; ?>>Hover</option>
</select>
</td>
</tr>
<tr>
<td><label for="pp-sc-autoPlay">Auto Play :</label></td>
<td colspan="3">
<input class="pp-slider-conf-elem-autoplay" type="radio"  name="autoPlay" value="true" id="pp-sc-autoPlay-r1" <?php if(parseBool($conf['autoPlay'])) echo " checked='checked'";?>/><label for="pp-sc-autoPlay-r1">Yes</label>
<input class="pp-slider-conf-elem-autoplay" type="radio" name="autoPlay" value="false" id="pp-sc-autoPlay-r2" <?php if(!parseBool($conf['autoPlay'])) echo " checked='checked'";?>/><label for="pp-sc-autoPlay-r2">No</label>
</td>
</tr>
</table>
<div class="center"><input onclick="pp_slider_save_conf()" class="special_btn" type="button" value="Save"/>
<input class="special_btn grey-back pp-slider-preview-btn" type="button" value="Preview"/>
</div>
</div>
</div>