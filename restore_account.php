<?php

include("environment.php");

if(!validemail($_GET['id']) && entity_value("userdata","account_status","user_id",$_GET['id'])=="temp")
{
?>
<!doctype html>
<html>
<head><title>Restore Account-Frendsdom</title>
<link rel="icon" href="<?php echo get_image("favicon.ico"); ?>">
<script src="jquery-1.4.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery.monnaTip.js"></script>
<script src="apprise/apprise.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css8.css"/>
<link type="text/css" rel="stylesheet" media="all" href="apprise/apprise.min.css" />
<script>
$("#ra_btn").live("click",function(){
if(trim(el("pass").value).length>0)
{
el('body').style.opacity=".2";
el('uploading').innerHTML="<img src='picon1.gif' />Restoring account.....";
show('uploading');
if(el('keep_loggedIn').checked)
w.postMessage("ar_verify email=<?php echo $_GET['id']; ?>&pass="+encodeURIComponent(el('pass').value)+"&keep_LI=true");
else
w.postMessage("ar_verify email=<?php echo $_GET['id']; ?>&pass="+encodeURIComponent(el('pass').value));

w.onmessage=function(e)
{
hide('uploading');
if(parseInt(e.data)==1)
{
apprise("<div align='left'><h2><img src='checkmark.gif' width='30' style='position:relative;top:5px;'/>Account successfully restored</h2><p>Your account has been restored. Click OK to proceed</p></div>",{"okText":"Go to home page"},function(r){
location.href="home.php";
});
}
else
{
response_msg("Error: failed to restore your account","red");
}
};
}
}); 
</script>
</head>
<body>

<?php 

//insert Google analytic code
include($ga_file); 

?>

<div class="strip clickeffect"><?php echo top_bar_logo(); ?>
<ul>
<li><a href="friends3.php"><img src="1.gif" title="Exit to main page"></a></li>
<li><form method="post" action="search.php">
<input type="text" name="query" class="shaded_fields" placeholder="Search user">
<input type="submit" class="ss-submit" value="Search">
</form>
</li>
</ul>
</div>
<div class="clearboth"></div>
<div id="body">
<div class="ra_container">
<h2>Welcome back <?php echo entity_value("userdata","first","user_id",$_GET['id']) ;?></h2>
<p>Please enter your password to restore your account</p>
<p><input type="password" id="pass" name="pass" class="shaded_fields" placeholder="Password"/></p>
<p><input type="checkbox" value="true" id="keep_loggedIn">Keep me logged in</p>
<p><input type="button" value="Restore" class="special_btn" id="ra_btn"/></p>
</div>
<?php echo get_footer_1(true);?>
</div>
<div id="uploading"></div><div id="success"></div>
</body>
</html>
<?php
}
else
{
header('location:main.php');
}
?>