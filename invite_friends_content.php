<?php

include("environment.php");
check_auth();

if(!empty($_POST['flag'])){
?>

<div class='ic_wrapper'>
<h3><img src='images/invite_contacts.gif' align='middle'/>Invite your contacts to join you here</h3>


<div id="ic_accordion" class="ic_accordion">

<h3><img src="images/gmail.png" width="100" height='40' class='pointer'/></h3>
    <div class="acc_block">
<p>
<a href="oauth/gmail/ReadyGetContact.php"
onClick='window.open(this.href,"Ratting","width="+screen.width+",height="+screen.height+",0,status=0,scrollbars");return false;'><img src='images/gmail.gif' align='middle'/>Invite Gmail Contacts</a>
</p>

</div>
<h3><img src="images/yahoo.png" width="100" height='40' class='pointer'/></h3>
    <div class="acc_block">
        <p><a href="oauth/yahoo/getreqtok.php"
onClick='window.open(this.href,"Ratting","width="+screen.width+",height="+screen.height+",0,status=0,scrollbars");return false;'><img src='images/yahoo_mail.gif' align='middle'/>&nbsp;Invite Yahoo Contacts</a>
</p>
    </div>


    <h3><img src="images/facebook.gif" width="100" height='40' class='pointer'/></h3>
    <div class="acc_block">
<a href='facebook_invite/invite_fb.php' onClick='window.open(this.href,"Ratting","width="+screen.width+",height="+screen.height+",0,status=0,scrollbars");return false;'><p>
<img src="images/fb_icon.png" align="middle" alt="icon">&nbsp;Invite your Facebook friends
</a></p>
</div>
    </div>
</div>


<?php


}

else{
header('location:home.php');
}
?>