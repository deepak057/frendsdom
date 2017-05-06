<?php
function is_browser_firefox(){if(isset($_SERVER['HTTP_USER_AGENT'])){if(strlen(strstr($_SERVER['HTTP_USER_AGENT'],"Firefox")) > 0 )return true;else return false;}else return false;}



function check_browser()
{

if(!is_browser_firefox())
echo "<div style='top:50px;right:300px;background:grey;padding:30px;width:50%;border:1px solid black;'>

<h3><img src='alert.gif' height='50' width='50' align='middle'>Incompatible browser</h3>
The browser ( ".get_browser()->browser." ".get_browser()->version." ) you are using doesn't seem to be compatible with this website.
We're working on cross broewser compatibility and soon you'll be able to use it on any browser of your wish.
For now, we're sorry for inconvenience but you must switch to <a href='http://www.mozilla.org/en-US/firefox/new/' title='Download Mozila firefox'>Mozila firefox</a> to be able to view this website.

</br></br>
<input type='button' onclick='closeWindow();' Value='Okay' title='Close this browser tab' style='background:green;cursor:pointer;border:1px solid black;padding:3px;position:relative;left:230px;'> 
</div>";
}

check_browser();
?>

<script language="javascript" type="text/javascript">
function closeWindow() {
window.open('','_parent','');
window.close();
}
</script> 
