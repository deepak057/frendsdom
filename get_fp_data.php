<?php

include("environment.php");
check_auth();

if(!empty($_POST['sex']) && !empty($_POST['age']) && !empty($_POST['country']))
{

//message to display when no match found
$not_found_msg="<p><h3>Sorry, No match found for your search criteria</h3></p>";

//connecting to database
$con=mysql_connect($host,$db_user,$db_passwd);mysql_select_db($selected_db,$con);

$count=0;

//executing query
$result=mysql_query(get_asl_query());

if(mysql_num_rows($result)>0){

echo "<table id='fp_table'><tr>";
while($row=mysql_fetch_array($result)){
if($row['id']!=$_SESSION['userid'] && !if_alreadyexists($_SESSION['userid'],$row['id'])){
$age=floor((strtotime(date('Y-m-d')) - strtotime("{$row['year']}-{$row['month']}-{$row['day']}")) / 31556926);
if($row['sex']=="female")$hh="her";else {$hh="him";}
if($count>0 && $count%2==0){
echo "</tr><tr>";
}

//getting recommended points
$recommended_points=get_recommended_points($row['id']);


if(if_exists("user{$row['id']}","requestid",$_SESSION['userid']))
{
$points_offered=entity_value("user{$row['id']}","points","requestid",$_SESSION['userid']);
if(!$points_offered){$points_offered=0;}
$point_sugg="You offered <span class='fp_hh'>{$hh}</span>:<span class='fp_points_offered'>{$points_offered}</span> point(s)";
$fp_btn_type="<input type='button' value='Cancel Invitation' class='btn redback fp_cancel_invite'/>";
}
else
{
$point_sugg="You should offer <span class='fp_hh'>{$hh}</span>: {$recommended_points} point(s)";
$fp_btn_type="<input type='button' class='btn fp_invite_btn' value='Invite'/>";
}


echo "<td class='hp_fp_block' id='fp_{$row['id']}'>
<table>
<tr>
<td>
<a href='".get_profile_url($row['id'])."'><img width='100' height='100' src='".get_thumb($row['id'],250,250)."' class='fp_prof_pic'/></a>
</td>
<td valign='top'>
<div><a href='".get_profile_url($row['id'])."' class='dui' data-hovercard-id='{$row['id']}'>{$row['first']} {$row['last']}</a></div>
<div class='small light_text'>{$age} years old from {$row['country']}</div>
<div class='small fp_point_sugg' id='rp_{$recommended_points}' style='margin-top:5px;'>{$point_sugg}</div>
<div>{$fp_btn_type}</div>
</td>
</tr>
</table>
</td>";


$count++;
}
}

echo "</tr></table>";

}
else{ echo $not_found_msg;}

}
else
{
header('location:home.php');
}
?>