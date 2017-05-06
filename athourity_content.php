<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler");

echo "<table>

<tr><td>
</td>
<td align='right'>
<span class='red_onhover' title='Close' onclick='hide_otherAction();'>&#215;</span>
</td>
</tr>";

if(user_sex($_POST['id'])=="female")
{$hh="her";$h="her";}
else {$hh="his";$h="him";}


if(if_exists("user{$_SESSION['userid']}","listid",$_POST['id']))
{

$arg1='"'.$_POST['id'].'"';


if(in_array($_SESSION['userid'],return_array_tweaked($authority_recpients_db,"authorityrecpients4user{$_POST['id']}","request_from")))
{
echo "

<tr>
<td colspan='2'>
<b>You don't have the authority yet to change {$hh} profile appearance</b>
</td>
</tr>
<tr>
<td>
<p id='atr_description'>Request {$h} to grant you the authority to be able to change the color of various components on {$hh} profile just as you do on your own profile</p>
<span id='atr_sent' class='light_text' title='on ".entity_value("authorityrecpients4user{$_POST['id']}","DATE_FORMAT(requested,'%d %M %Y')","request_from",$_SESSION['userid'],$authority_recpients_db)."'>Request sent: about 
".ago(entity_value("authorityrecpients4user{$_POST['id']}","UNIX_TIMESTAMP(requested)","request_from",$_SESSION['userid'],$authority_recpients_db))."
</span></br></br>
<input type='button' value='Cancel Request' style='background:red;' request' id='atr_rqst_btn' class='special_btn' onclick='cancel_atr_request(this.id);'>

</td>
<td align='right'>

<img src='".prof_pic($_POST['id'])."' height='230' width='230'>
</td>

</tr>


</tr>

</table>



";


}

else
{


echo "

<tr>
<td colspan='2'>
<b>You don't have the authority yet to change {$hh} profile appearance</b>
</td>
</tr>
<tr>
<td>
<p id='atr_description'>Request {$h} to grant you the authority to be able to change the color of various components on {$hh} profile just as you do on your own profile</p>
<span id='atr_sent' class='light_text'></span></br></br>
<input type='button' value='Send request' id='atr_rqst_btn' class='special_btn' onclick='atr_request(this.id);'>

</td>
<td align='right'>

<img src='".prof_pic($_POST['id'])."' height='230' width='230'>
</td>

</tr>



</table>



";
}

}

else 
{

echo "<tr>
<td colspan='2'>
<b>You must be in any of {$hh} relation list to ask {$h} for this authority</b>
</td>
</tr>
<tr>
<td>
<span id='atr_sent' class='light_text'></span></br></br>
<input type='button' value='Okay' class='special_btn' style='background:grey;' onclick='hide_otherAction();'>
</td>
<td align='right'>

<img src='".prof_pic($_POST['id'])."' height='150' width='200'>
</td>

</tr>
</table>";

}
}

else 
{
header('location:home.php');
}

?>