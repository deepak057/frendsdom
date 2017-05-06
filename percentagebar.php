<?php

include("environment.php");
check_auth();

if(!empty($_GET['id']))
{

//filtering the id received
$_GET['id']=htmlentities(trim($_GET['id']));

//compressing HTML content 
//ob_start("ob_gzhandler"); 

?>
<html>
<head>
<style type="text/css">
.onHover_underline:hover{cursor:pointer;text-decoration:underline;}
</style>
<script src="script.js" type="text/javascript"></script>
<script language="javascript">
function drawPercentBar(width, percent, color, background) { var pixels = width * (percent / 100); if (!background) { background = "none"; }document.write("<div style=\"position: relative; line-height: 1em; background-color: " + background + "; border: 1px solid black;border-radius:4px;margin-bottom:5px;box-shadow:5px 5px 2px black; width: " + width + "px\">"); document.write("<div style=\"height: 1.5em; width: " + pixels + "px; background-color: "+ color + ";\"></div>"); document.write("<div style=\"position: absolute; text-align: center; padding-top: .25em; width: " + width + "px; top: 0; left: 0\">" + percent + "%</div>"); document.write("</div>"); } document.write("<h3>Feedback statistics</h3>");if(parseInt(responsetext("id=<?php echo $_GET['id'];?>&table=profilefeedback4user<?php echo $_GET['id'];?>&entity=fromid&database=<?php echo $feedback_to_profile_db?>","total_entries.php"))>0)
{var f=responsetext("id=<?php echo $_GET['id'];?>&return_type=percent","feedback_statistic.php").split(" "),fback_statistic=responsetext("id=<?php echo $_GET['id'];?>&return_type=number","feedback_statistic.php").split(" "), fbackstring=["liked this profile","disliked this profile","loved this profile","hated this profile","thought color combination was stupid","thought color combination was awesome","thought they were like minded","thought color combination should be altered","thought this was the best"],fback_array=["like","dislike","love","hate","stupid","awesom","likeminded","alterd","best"],backg_color=responsetext("id=<?php echo $_GET['id'];?>&component=visit_backg","get_color.php"),strip_color=responsetext("id=<?php echo $_GET['id'];?>&component=back_strip_color","get_color.php");
if(strip_color==backg_color)strip_color='green';for(var i=0;i<f.length-1;i++){document.write("<span class='onHover_underline' onclick='fback_from(\"<?php echo $_GET['id'];?>\",\""+fback_array[i]+"\");'>"+fback_statistic[i]+" people</span> " +fbackstring[i]);drawPercentBar(200, f[i], strip_color,backg_color);}}else {document.write("No feedback from anybody");}var arg='"fback_statistic"';document.write("</br><input type='button'  value='Close' style='position:absolute;top:0px;right:5px;background:grey;border:1px solid black;cursor:pointer; ' onclick='hideframe();'>");function hideframe(){parent.hide('fback_from');parent.hide('fback_statistic');parent.el('body').style. opacity='1';}function fback_from(id,fback){if(in_array(fback,fback_array)){parent.el('fback_from').style.right="500px";parent.show('fback_from');parent.el('fback_from').innerHTML=loading;w.postMessage("fback_from id="+id+"&fback="+fback);w.onmessage=function(e){parent.el('fback_from').innerHTML=e.data;}}else alert("Invalid feedback value");}
</script>
</head>
</html>
<?php
}
else
{
header('location:home.php');
}
?>