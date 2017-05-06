<?php

include("environment.php");
check_auth();
include('class_lib.php');

$u=new user($_SESSION['userid']);

echo "<table cellspacing='5' id='sbox_table'>

<tr>

<td><h3><img src='pref.png' align='middle' align='middle'>&nbsp;Your preferences</h3></td>
<td colspan='2' align='right' valign='top'><span class='red_onhover' onclick='hide_otherAction();' title='Close'>&#215;</span></td>

</tr>";


echo "<tr><td class='background2 shaded_border_thick'>

<h4><img src='email.png' align='middle' class='pref_label_icon' alt='email' align='middle'>&nbsp;Receive news via e-mail</h4>";
?>
<form name='pref_form' id='pref_form'>
<input type='radio' name='email_pref' id='email_pref' value='disable' <?php if(!$u->get_e_mail_notification()) echo 'checked';?>>Disable
<input type='radio' name='email_pref' id='email_pref' value='enable' <?php if($u->get_e_mail_notification()) echo 'checked';?>>Enable
</form>
</td>

<td class='background2 shaded_border_thick'><h4><img class='pref_label_icon' src='popup.png' alt='popup' align='top'>&nbsp;Allow official popup messages</h4>
<form name='popup_form' id='popup_form'>
<input type='radio' name='popup_pref' id='popup_pref' value='disable' <?php if(!$u->get_pop_up()) echo 'checked';?>>Disable
<input type='radio' name='popup_pref' id='popup_pref' value='enable' <?php if($u->get_pop_up()) echo 'checked';?>>Enable
</form>

<td class='background2 shaded_border_thick'><h4><img src='images/email_visibility_icon.png' align='top'>&nbsp;Email should be visible to</h4>
<form name='email_visibility_form' id='email_visibility_form'>
<input type='radio' name='email_visibility' id='email_visibility' value='public'  <?php if($u->get_email_visibility()=="public") echo 'checked';?>>Everyone
<input type='radio' name='email_visibility' id='email_visibility' value='relations'  <?php if($u->get_email_visibility()=="relations") echo 'checked';?>>Only relations
<input type='radio' name='email_visibility' id='email_visibility' value='private' <?php if($u->get_email_visibility()=="private") echo 'checked';?>>No one
</form>
</td>


</td>

</tr>
<tr>

<td class='background2 shaded_border_thick'><h4><img src='images/message_icon.png' height='30' width='30' align='top'>&nbsp;Receive messages via email</h4>
<form name='msg_pref_form' id='msg_pref_form'>
<input type='radio' name='msg_pref' id='msg_pref' value='disable' <?php if(!$u->get_msg_notification()) echo 'checked';?>>Disable
<input type='radio' name='msg_pref' id='msg_pref' value='enable' <?php if($u->get_msg_notification()) echo 'checked';?>>Enable
</form>
</td>


</tr>

<?php

echo "
<tr><td></br><input type='button' id='save_pref' value='Save changes' class='special_btn'></td></tr>
</table>";


?>