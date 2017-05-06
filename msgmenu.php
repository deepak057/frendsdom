<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

?>
<div id="msgmenu" class="msgmenu">
<p style="text-align:left">To: <?php echo user_name($_POST['id']);?></p>
<p style="text-align:left">From: <?php echo $_SESSION['userfulname'];?></p>
<p>
<form name="msgform" onsubmit="return false">
<div style="text-align:left">Title <input type="text" name="title" value=" No title " size="45"></div>
</br><div style="text-align:left">Type your text here</div><textarea class="flexible_textarea" name="msg" rows="8" cols="40"></textarea>
</br></br><input type="submit" id="btn" value="Send now" onclick="sendmsg()"><input type="button" id="btn" value="Cancel" onclick="offmsg1();">
</form></p>
</div>
<?php
}

else
{
header('location:home.php');
}
?>