<?php

//checking if a logged-in user is invoking this file
check_log_in(urlencode($_SERVER['REQUEST_URI']));

//instantiating class user for logged-in user 
$lu=new user($_SESSION['userid']);

function display_page($service,$contacts_info){
global $lu;
?>
<!doctype html>
<head>
<title>Invite your <?php echo ucwords($service); ?> contacts-Frendsdom</title><link rel="shortcut icon" href="<?php echo SITE_URL; ?>/awesom.bmp">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css8.css"/>
<script src="<?php echo SITE_URL; ?>/jquery-1.4.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL; ?>/script.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL; ?>/nicescroll.js"></script>
</head>
<body style="font-weight:bold;">
<div id="body">
<div align="left" style="border-bottom:1px solid #000;padding:5px;margin-bottom:0px;" class="shaded_cream_back">
<a href="<?php echo get_profile_url($_SESSION['userid'],true); ?>" title="Your profile"><img src="<?php echo $lu->prof_pic();?>" width="50" height="50"/ align="middle"/>&nbsp;<?php echo $lu->get_name(); ?></a>
</div>



<?php
echo "<div align='left' style='padding:5px;'><div>";

switch($service){
case"yahoo":
?>
<h2><img src='<?php echo get_image('yahoo_mail.gif');?>' align='middle' style="position:relative;top:-5px;">&nbsp;Invite your Yahoo contacts</h2> <?php
break;
case"gmail":
?><h2><img src='<?php echo get_image('gmail.gif');?>' align='middle' style="position:relative;top:-10px;width:80px;">&nbsp;Invite your Gmail contacts</h2> <?php
break;
}

$count=0;

echo "<div style='border-bottom:1px solid #999;padding-bottom:5px;margin-bottom:10px;'><input type='button' value='Check all' name='check_all' id='cu_all'/></div></div>


<h3>Your Contacts (".sizeof($contacts_info).")</h3><table cellspacing='5'><tr>";

foreach($contacts_info as $contact){

if($count>0 && $count%4==0){echo "</tr><tr>";}
?>
<td>
<input type="checkbox" name="contact_email" value="<?php echo $contact['email']; ?>" checked/><?php if(!empty($contact['name'])) echo ucwords($contact['name']);else echo $contact['email'];?>
</td>
<?php
$count++;
}		
?>

<tr><td colspan='4' align='left'><span class='light_text'>Message</span><br/>
<textarea cols="50" rows="10" class="status_textarea flexible_textarea" style="border:1px solid #999;">Hi

I would like to invite you to join me here at Frendsdom


Follow the link below to get there and know more about it. 


Here's your link: <?php echo SITE_URL; ?>
 </textarea>

</td></tr>

<tr><td colspan='4' align='left'><br/>
<input type="button" value="Proceed" class="special_btn"/>
</td></tr></table></div>

<script>
$(document).ready(function(){
    $('#cu_all').toggle(function(){
         $('input:checkbox').attr('checked','checked');
        $(this).val('uncheck all') 
    },function(){$('input:checkbox').removeAttr('checked');
        $(this).val('check all');       
    });
$("textarea").niceScroll({cursorcolor:"#999"});
$(".special_btn").click(function(){
var values = new Array();
$.each($("input[name='contact_email']:checked"), function() {
  values.push($(this).val());
});
if(values.length<1){alert("Please select at least on contact to proceed");return;}
if(!trim($("textarea").val())){alert("Message can not be blank. Please fill it up.");return;}
if($("#display_post_div")){
$("#display_post_div").remove();
}
var d=document.createElement("div");
d.id="display_post_div";
d.setAttribute("style","position:fixed !important");
d.innerHTML="<div class='loading2'><img src='<?php echo SITE_URL ?>/picon1.gif'/>&nbsp;Sending your message....</div>";
document.getElementsByTagName('body')[0].appendChild(d);
el('body').style.opacity=".2";
$.post("../send_invitation.php",{values:encodeURIComponent(values.join(",")),text:encodeURIComponent($("textarea").val())},function(d){
if(parseInt(d)==1)
$("#display_post_div").html("<div class='loading2'><p><img src='<?php echo SITE_URL; ?>/checkmark.gif' align='top' height='30' width='30'>&nbsp;Your message has been sent to selected recipients. Click Ok to close this window</p><p><input class='pointer' type='button' value='Ok' onclick='window.close();'/></p></div>");
else{
$("#display_post_div").html("<div class='loading2'><p><img src='<?php echo SITE_URL; ?>/crossmark.gif' align='top' height='30' width='30'>&nbsp;Error: failed to send your message. Click ok to close this window</p><p><input class='pointer' type='button' value='Ok' onclick='window.close();'/></p></div>");
}
});
});
});
</script>
</div>
</body>
</html>
<?php
}
?>
