<?php

include("environment.php");

if(!empty($_GET['id']) && !empty($_GET['data']))
{

if(entity_value("userdata","email_verified","id",$_GET['id'])==$_GET['data'])
{
if(update_entity("userdata","id",$_GET['id'],"email_verified","1")){
?>
<script>
alert("Congratulations!! You have successfully verified your email address. You are now being redirected to your home page.");
window.location = '<?php echo SITE_URL; ?>/home.php';
</script>
<?php
}
}


else {

echo "Error: Invalid information provided.</br>E-mail not verified";

}
}


else if(!empty($_GET['id']) && empty($_GET['data']))
{


if(entity_value("userdata","email_verified","user_id",$_GET['id'])==1)
{
header('location:main.php');exit;
}


?>
<!doctype html>
<html>
<head><link rel='icon' href='<?php echo get_image("favicon.ico"); ?>'><title>Verify your email -Frendsdom</title>
<link rel="stylesheet" type="text/css" href="css8.css"/><script src="jquery-1.4.js" type="text/javascript"></script><script src="script.js" type="text/javascript"></script><script src="js/jquery.outside.events.js"></script>
<script>
function resend_link(){
el('body').style.opacity='.2';
el('uploading').innerHTML="<img src='picon1.gif'>Sending verification link.....";
show('uploading');
w.postMessage("send_email_veri email=<?php echo $_GET['id'];?>");
w.onmessage=function(e){
hide('uploading');
if(parseInt(e.data)==1)
response_msg("Link successfully sent");
else response_msg("Error: failed to send link","red");
};
}
</script>
</head>
<body>
<div id='body'>

<?php get_header_1(); ?>

<center>
<?php

echo "<div style='margin-top:30px;' class='background2 env-block'><h3><img src='alert.gif' align='middle'>Sorry, your email is not verified yet !</h3> Your email address <b>{$_GET['id']}</b> must be verified before your can be able to access your account on Frendsdom. Please verify it first.</br></br><span id='resend_link' onclick='resend_link();' style='color:blue;cursor:pointer;'><u>Resend verification link to your email</u></span></div>";
?>
</center>
<?php get_footer_1(true); ?>
</div>
<div id='uploading'></div><div id='success'></div>
</body></html>
<?php
}

else
{

header('location:main.php');

}


?>