<?php

include("environment.php");
check_auth();

if(!empty($_POST['nudgeset']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

$mysqli=new mysqli($host,$db_user,$db_passwd,$nudgesets_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($result=$mysqli->query("select  letbeknown,recepeints from {$_POST['nudgeset']} "))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if($row['letbeknown']=="yes")
{
$others1=explode(",",$row['recepeints']);
}

else die("Failed");

}
}
}

$j=0;
for($i=0;$i<sizeof($others1);$i++)
{
if($others1[$i]!=$_SESSION['userid'] && account_status($others1[$i]))
{
$others[$j]=$others1[$i];
$j++;
}
}
echo "<tr><input type='button' id='close_included' style='position:absolute;top:20px;right:20px;background:grey;border:1px solid black;' value='Close' onclick='hide_others();'>";
for($i=0;$i<sizeof($others);$i++)
{
if($i%4==0)
{
echo "</tr><tr>";
}
?>
<td align="left"> <div class="fl"><a href="<?php echo get_profile_url($others[$i]); ?>"><img src="<?php echo prof_pic($others[$i]);?>" height="40" width="40" align="middle"/></a></div><div class="fr"><a href="<?php echo get_profile_url($others[$i]); ?>" class="dui" data-hovercard-id="<?php echo $others[$i]; ?>"><?php echo TuneTheName(user_name($others[$i]),12); ?></a></div><div class="clear"></div></td>
<?php
}
}
else
{
header('location:home.php');
}
?>