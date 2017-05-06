<?php
if(!empty($_POST['flag']))
{
?>

<div class="cu_form">
<h3><img src="images/contact_us.png" align="middle" width="35" style="position:relative;top:-5px;"/>&nbsp;Contact Us</h3>
<p>Contact us for your queries, suggestions, feedback, advertisement or anything related to or involving Frendsdom.</p>
<div id="cu_form_content">
<p>Please fill all the following fields.</p>
<form onsubmit="return cu_send_msg();">
<table cellspacing="10">
<tr>
<td align="right"><label class="light_text pointer" for="cu_vn">Name</label></td>
<td><input type="text" id="cu_vn" required="yes" class="blue_onhover"/></td>
</tr>
<tr>
<td align="right"><label class="light_text pointer" for="cu_vemail">Email</label></td>
<td><input type="email" id="cu_vemail" required="yes" class="blue_onhover"/></td>
</tr>
<tr>
<td align="right"><label class="light_text pointer" for="cu_sub">Subject</label></td>
<td><input type="text" id="cu_sub" required="yes" class="blue_onhover"/></td>
</tr>
<tr>
<td align="right"><label class="light_text pointer" for="cu_msg">Message</label></td>
<td><textarea id="cu_msg" class="blue_onhover flexible_textarea" style="height:70px;" required="yes"></textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Send" class="special_btn" id="cu_submit"/></td>
</tr>
</table>
</form>
<div class="center small">In case this form fails to work, you can send mail directly to <a href="mailto:admin@frendsdom.com"><b>admin@frendsdom.com</b></a></div>
</div> 
</div>
<?php
}
?>