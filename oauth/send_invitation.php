<?php

include('../includes/includes.php');
check_auth();

//sending invitations messages to recipients
if(send_invitation_mails(explode(",",$_POST['values']),$_POST['text'],$_SESSION["userid"]))
echo "1";
else echo "0";

?>