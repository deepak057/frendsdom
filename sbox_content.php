<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

//checking if hover view is enabled
$hover_view=empty($_POST['hover_view']) ? false : true;
?>

<table cellspacing='5' id='sbox_table'>
<tr id='sbox_title_tr'>
<td <?php if($hover_view) echo "colspan='2'";?>><h4><img src='share.png' align='middle'>&nbsp;


<?php
if($_POST['id']==$_SESSION['userid'] && !$hover_view)
echo "Manage your share box";
else {
echo TuneTheName(user_name($_POST['id']),13)."'s share box";
}
?>


</h4></td>
<td colspan='2' align='right' valign='top'>


<?php if(!$hover_view){
?>
<span  class='red_onhover' onclick='hide_otherAction();' title='Close'>&#215;</span>
<?php
}
else{
?>
<span  class='pointer' user-id='<?php echo $_POST['id']; ?>' onclick="manipulate_hc_content(this);"><u>Back</u></span>
<?php
}
?>
</td>
</tr>


<?php
$mysqli=new mysqli($host,$db_user,$db_passwd,$share_box_db);if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}

$i=0;
$j=0;

if($result=$mysqli->query("select * from sboxofuser{$_POST['id']}"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{

if($i%3==0)
{
echo "</tr><tr id='{$j}'>";$j++;
}


echo "<td id='{$row['share_id']}' class='background2'>";

if($_POST['id']==$_SESSION['userid'] && !$hover_view)
{

echo "<span class='remove_share' id='{$j}_{$row['share_id']}'><span  class='red_onhover' style='float:right;' title='Remove this share'>&#215;</span></span>";

}

echo "<table>

<tr>";

if(!empty($row['share_pic_type']))
{

echo "<td valign='top'>".get_share_image($row,$_POST['id'])."</td>";

}


echo  "<td><b>".auto_link_text(stripslashes($row['share_title']))."</b></td></tr></table>


<div class='sbox-block-content'>".nl2br(auto_link_text(stripslashes($row['share_data'])))."</div></td>";

$i++;

}
}

else {
echo "<tr id='no_share_tr'>
<td colspan='2'>There is no share yet</td>
</tr>";
}

}



if($_POST['id']==$_SESSION['userid'] && !$hover_view)
{
echo "<tr id='create_share_tr'>
<td colspan='2'>
</br>
<input type='button' value='Create a share' id='create_share' class='special_btn' style='background:blue;'>

</td>
</tr>";
}

else if($_POST['id']!=$_SESSION['userid']){

//get user's sex
$user_sex=user_sex($_POST['id']);

if($user_sex=="female")
$h='her';
else $h='him';

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['news_db']);
if($result=$mysqli->query("select * from news4user{$_POST['id']} where news='check_in' && from_id='{$_SESSION['userid']}' && viewed=0"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                           
{
?>
<tr>
<td colspan='3'>
</br>
<input type='button' class='special_btn' style='background:red;' onclick="check_out(this,'<?php echo $_POST['id']; ?>','<?php echo $user_sex; ?>');" value='Cancel notification' title='let this user know that you viewed their share box' id='check_in_btn'>
</td>
</tr>

<?php
break;

}
}

else{
?>

<tr>
<td colspan='3'>
</br>
<input type='button' class='special_btn' onclick="check_in(this,'<?php echo $_POST['id']; ?>','<?php echo $user_sex; ?>');" value='Notify <?php echo $h; ?> about this visit' title='let this user know that you viewed their share box' id='check_in_btn'>
</td>
</tr>

<?php
}
}
}


echo "</table>";


}


else {

header('location:home.php');

}

?>