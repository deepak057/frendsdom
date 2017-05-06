<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{
function get_label($fback){switch($fback){case "like":case "dislike":case "love":case "hate":return "Response text when someone {$fback}s your profile";break;case "stupid":case "awesome":case "awesom":return "Response text when someone thinks color combination is {$fback}";break;case "alterd":return "Response text when someone thinks color combination should be altered";break;case "likeminded":return "Response text when someone thinks you two are like-minded ";break;case "best":return "Response text when someone thinks it's the best you can do";break;}}

$fback=return_array_tweaked($autoresponses_db,"autoresponses4user{$_SESSION['userid']}","feedback");
$rt=return_array_tweaked($autoresponses_db,"autoresponses4user{$_SESSION['userid']}","response");

//compressing HTML content 
//ob_start("ob_gzhandler");

if(entity_value("userdata","auto_response","id",$_SESSION['userid'])=="on")
{
$state="enabled";
echo "<table><tr><td><h3><img src='response.png'  align='middle'>&nbsp;Auto responses</h3><span id='auto_response_description'>Choose the auto responses that will be displayed to those<br/> who give their feedback to your profile</span></td><td><input type='button' id='e_ar_button'  value='Disable' onclick='dis_autor();' class='special_btn' style='background:red;'></td></tr>";
}

else 
{
$state="disabled";
echo "<table><tr><td><h3><img src='response.png'  align='middle'>&nbsp;Auto responses</h3><span id='auto_response_description'>Choose the auto responses that will be displayed to those<br/> who give their feedback to your profile</span></td><td><input type='button' id='e_ar_button' value='Enable' onclick='control_autor();' class='special_btn'></td></tr>";
}

for($i=0;$i<sizeof($fback);$i++)
{
echo "<tr>

<td class='small'>
".get_label($fback[$i])."
</br>
<textarea class='flexible_textarea autor_text shaded_fields' id='{$fback[$i]}_rt' name='{$fback[$i]}_rt' {$state} style='width: 450px; height: 25px;' maxlength='200' >{$rt[$i]}</textarea>

</td>

<td>
</td>

</tr>";

}

echo "</table></br><div align='center'><input id='save_autor' type='button' value='Save' class='special_btn' {$state}>&nbsp;<input type='button' class='special_btn redback' value='Close' onclick='hide_otherAction();'></div>";

}

else
{
header('location:home.php');
}
?>