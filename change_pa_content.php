<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler");

if(if_exists("userdata","id",$_POST['id']) && if_exists("user{$_SESSION['userid']}","listid",$_POST['id']) && if_exists("authorityrecpients4user".$_SESSION['userid'],'recpient_id',$_POST['id'],$authority_recpients_db) && if_exists("authorityrecpients4user".$_POST['id'],'recpient_id',$_SESSION['userid'],$authority_recpients_db))
{

if(user_sex($_POST['id'])=="female")
{$hh="her";$h='her';}else {$hh="his";$h='him';}
if(entity_value("authorityrecpients4user{$_SESSION['userid']}","requested","recpient_id",$_POST['id'],$authority_recpients_db)!='')
$s="You granted authority to {$h} on:";
else $s="You were granted authority by {$h} on:";

echo "<div style='text-align:left;'>

<table style='position:absolute;top:-3px;right:5px;' cellspacing='2'>
<tr>
<td>
</td>
<td align='right'>
<span class='red_onhover' title='Close' onclick='hide_otherAction();'>&#215;</span>
</td>
</tr>
<tr>
<td >
<input type='button' value='Minimize' id='pa_preview' class='special_btn' style='background:grey;'>
</td>
<td>
<input type='button' class='special_btn' value='Save changes' id='pa_save'>
</td>
</tr>
</table>


<table id='pa_table' cellspacing='10'>

<tr>
<td colspan='5'>
<h3><img src='edit.gif' align='middle'>&nbsp;Change appearance of {$hh} profile </h3><span class='light_text' style='position:relative;top:-10px;'>{$s}".entity_value("authorityrecpients4user{$_SESSION['userid']}","DATE_FORMAT(when1,'%d %M %Y')","recpient_id",$_POST['id'],$authority_recpients_db)." ( about ".ago(entity_value("authorityrecpients4user{$_SESSION['userid']}","UNIX_TIMESTAMP(when1)","recpient_id",$_POST['id'],$authority_recpients_db))." )</span>
</td>
</tr>

<tr>
<td class='pa_td special_btn'>

<table class='pa_btn' id='page_back'>
<tr>
<td>
Background
</td>
</tr>
<tr>
<td align='center'>
<img src='up.png' height='20' width='20' title='Get color list' id='btn_page_back' >
</td>
</tr>
<tr>
<td align='center' id='clist_btn_page_back' class='colorlist'></td>

</tr>
</table>

</td>

<td class='pa_td special_btn'>

<table class='pa_btn' id='get_backstripclist'>
<tr>
<td>
Main strip color
</td>
</tr>
<tr>
<td align='center'>
<img src='up.png' height='20' width='20' title='Get color list' id='btn_get_backstripclist'>
</td>
</tr>

<tr>
<td align='center' id='clist_btn_get_backstripclist' class='colorlist'></td>

</tr>

</table>
</td>


<td class='pa_td special_btn'>

<table id='btnset' class='pa_btn'>
<tr>
<td>
Button set color
</td>
</tr>
<tr>
<td align='center'>
<img src='up.png' height='20' width='20' title='Get color list' id='btn_btnset'>
</td>
</tr>
<tr>
<td id='clist_btn_btnset' class='colorlist' align='center'></td>
</tr>
</table>

</td>

<td class='pa_td special_btn'>

<table class='pa_btn' id='rel_color'>
<tr>
<td>
Relation table color
</td>
</tr>
<tr>
<td align='center'>
<img src='up.png' height='20' width='20' title='Get color list' id='btn_rel_color'>
</td>
</tr>
<tr>
<td align='center' id='clist_btn_rel_color' class='colorlist'></td>

</tr>
</table>

</td>

<td class='pa_td special_btn'>

<table class='pa_btn' id='getcolor4profileComments'>
<tr>
<td>
Comment menu color
</td>
</tr>
<tr>
<td align='center'>
<img src='up.png' height='20' width='20' title='Get color list' id='btn_getcolor4profileComments'>
</td>
</tr>
<tr>
<td align='center' id='clist_btn_getcolor4profileComments' class='colorlist'></td>
</tr>
</table>

</td>



</tr>
</table>

</div>
";


}


else
{
echo "Error: failed to perform requested action";
}



}

else 
{
header('location:home.php');
}


?>