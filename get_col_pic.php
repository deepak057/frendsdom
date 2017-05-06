<?php

include("environment.php");
check_auth();

if(!empty($_POST['col_id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler");

$t=total_entries($_POST['col_id'],'pic_id',$picdata_db);

echo "<table cellspacing='5' class='pic_collection_operations'><tr>";

if(!empty($_POST['vuid'])){
echo "<td colspan='2'>Picture collections of <a href='".get_profile_url($_POST['vuid'])."' id='{$_POST['vuid']}' class='fback_from1'><b>".user_name($_POST['vuid'])."</b></a></td>";}
else {
echo "<td><img src='total.gif' width='20' height='20' style='position:relative;top:4px;'>Total pictures:<span id='total_pic'>{$t}</span></td><td style='cursor:pointer;' title='click to delete this picture collection' id='del_col'><img src='delete.gif' height='20' width='20' style='position:relative;top:4px;'>Delete this collection</td>";}
echo "</tr></table>";


if(intval($t)<1)
echo "<div id='image_container'></br></br><img src='empty.png' align='middle'>No pictures in this collection yet</div>";
else 
{
$l=return_array_tweaked($picdata_db,$_POST['col_id'],"pic_id");
echo "<div id='image_container'>
<img src='leftm.png' title='Previous picture' id='prev_pic'>&nbsp;
<img id='picture' title='Click to enlarge this picture' src='get_pic.php?col_id={$_POST['col_id']}&pic_id={$l[0]}'>
&nbsp;<img src='rightm.png' title='Next pic' id='next_pic'>

</br>
</div>
<ul class='li_options' id='li_options'>
<li style='border:none;'><h2 id='show_piccount' title='Picture counter'>1/{$t}</h2></li>";


if(empty($_POST['vuid'])){
echo "<li id='del_pic' title='Click to delete this picture'>Delete this picture</li>";}

echo "<li id='set_pic' title='Click to set this picture as your profile picture'>Set as your profile pic</li><li id='set_eyecandy_pic' title='Click to set this picture as your new eyecandy picture'>Set as your eyecandy pic</li></ul>";

}

if(empty($_POST['vuid']))
{
echo "<table id='upload_pic' style='position:relative;left:580px;top:50px;'>
<tr>
<td></br>
<input type='button' value='Upload a picture' class='special_btn' style='background:blue;' id='upload_pic_btn'>
</td>
</tr>
</table>";
}
echo "<div id='pic_comment'></div>";
}
else 
{
header('location:home.php');
}
?>