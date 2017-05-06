<?php

include("environment.php");
check_auth();

if(!empty($_GET['p_id']))
{

//filtering the id received
$_GET['p_id']=trim($_GET['p_id']);

//compressing HTML content 
//ob_start("ob_gzhandler"); 

?>
<html>
<head>
<style type="text/css">
.onHover_underline:hover{cursor:pointer;text-decoration:underline;}
</style>
<script type="text/javascript" src="script.js"></script>

<script>

var w=new Worker("w_visit.js");
	

function drawPercentBar(width, percent, color, background) { var pixels = width * (percent / 100); if (!background) { background = "none"; }document.write("<div style=\"position: relative; line-height: 1em; background-color: " + background + "; border: 1px solid black;margin-bottom:5px;box-shadow:5px 5px 2px black; width: " + width + "px\">"); document.write("<div style=\"height: 1.5em; width: " + pixels + "px; background-color: "+ color + ";\"></div>"); document.write("<div style=\"position: absolute; text-align: center; padding-top: .25em; width: " + width + "px; top: 0; left: 0\">" + percent + "%</div>"); document.write("</div>"); }
 document.write("<h3>Feedback statistics</h3>");
if(parseInt(responsetext("p_id=<?php echo $_GET['p_id'];?>","total_entries4postfback.php"))>0){
var f=responsetext("return_type=percent&p_id=<?php echo $_GET['p_id'];?>","feedback_statistic4posts.php").split(" "),fback_statistic=responsetext("return_type=number&p_id=<?php echo $_GET['p_id'];?>","feedback_statistic4posts.php").split(" "),fbackstring=["liked this post","thought this post was awesome","thought this post was best"],fback_array=["like","awesom","awesome","best"],backg_color=responsetext("id=<?php echo $_SESSION['userid'];?>&component=visit_backg","get_color.php"),strip_color=responsetext("id=<?php echo $_SESSION['userid'];?>&component=back_strip_color","get_color.php");
if(strip_color==backg_color)strip_color='green';for(var i=0;i<f.length-1;i++){document.write("<span class='onHover_underline' onclick='fback_from(\"<?php echo $_GET['p_id'];?>\",\""+fback_array[i]+"\");'>"+fback_statistic[i]+" people</span> " +fbackstring[i]);drawPercentBar(200, f[i], strip_color,backg_color);}}else {document.write("No feedback from anybody");}var arg='"fback_statistic"';document.write("</br><input type='button'  value='Close' style='position:absolute;top:0px;right:5px;background:grey;border:1px solid black;cursor:pointer; ' onclick='hideframe();'>");function hideframe(){parent.d_none('fback_statistic_post');parent.el('body').style. opacity='1';}


function fback_from(id,fback){
if(in_array(fback,fback_array)){
//parent.el('fback_from').style.right="500px";parent.show('fback_from');
parent.apprise("<div align='left' id='fbackfrom4post'>"+loading+"</div>");
//parent.el('fback_from').innerHTML=loading;
w.postMessage("fbackFrom4post p_id="+id+"&fback="+fback);
w.onmessage=function(e){
parent.el('fbackfrom4post').innerHTML=e.data;}}else alert("Invalid feedback value");
}



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