 <?php

//include("includes/FunctionList.php");


if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['sub']) && !empty($_POST['msg']))
{

if(mail("deepak057@yahoo.com","Contact Request-{$_POST['sub']}","Following are the content of this request:\n\nName:{$_POST['name']}\nEmail:{$_POST['email']}\nSubject:{$_POST['sub']}\nMessage:".stripslashes($_POST['msg']))){
?>
<img src="checkmark.gif" width="20" align="middle"/>&nbsp;Message sent
<?php
}
else {
?>
<span class='error'>Error: failed to send message. Please try again.</span>

<?php
}
}
else {
?>
<span class="error">Error: Failed to send message. Please make sure all the fields are filled out.</span>
<?php
}



?>