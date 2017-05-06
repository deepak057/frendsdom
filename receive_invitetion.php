<?php

include("environment.php");
check_auth();

if(!empty($_POST['n']))
{

include('class_lib.php');

//compressing HTML content 
//ob_start("ob_gzhandler"); 

if($_POST['n']==1)
{
$i=0;

//retreiving new invitetions
$mysqli=new mysqli($host,$db_user,$db_passwd,$selected_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($result=$mysqli->query("select requestid from user{$_SESSION['userid']}"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if(!empty($row['requestid']) && account_status($row['requestid']))
{
$req[$i]=$row['requestid'];
$i++;
}
}
}
}


//deleting temporary userrequest table if already exists
$mysqli->query("drop table tempuser{$_SESSION['userid']}");

//creating temporary user request table 

foreach( $req as $row ) {$ql[] ='("'.$row.'")'; }


if($mysqli->query("create table tempuser{$_SESSION['userid']} (id Int Unsigned Not Null Auto_Increment,primary key(id),request_id varchar (50) not null)"))
{ 
if($mysqli->query("insert into tempuser{$_SESSION['userid']} (request_id) values ".implode(",",$ql))===false)
die( "Failed to create your database");
}
else die ("Failed to create your database");
}


$req=entity_value("tempuser".$_SESSION['userid'],'request_id','id',$_POST['n']);
$user=new user($req);

//retreiving the points offered
$points_offerd=get_points_offered($req);

if($points_offerd){
$points_offerd="<p class='offering_' id='offering_'><img src='images/offer.gif'/>Offering you <span id='invite_points_offered'>{$points_offerd}</span> point(s)</p>";
}
else{
$points_offerd='';
}



?>
<table>
<tr>
<td><input type="button" id="btn" style="position:absolute;left:-5px;top:7px;" value="Close" onclick="hide_req();">
<p id="invite_user_name"><a href="<?php echo get_profile_url($req);?>"><b><?php echo $user->get_name();?></b></a> wants to add you in <b><?php $list=entity_value("user".$_SESSION['userid'],"type","requestid",$req );

if($list=="friend")
{
$list="friend";
$list_title="<span title='Friend List'>Friend</span>";
}

if($list=="family")
{
$list="family";
$list_title="<span title='Family List'>Family</span>";
}


if($list=="col")
{
$list="collegue";
$list_title="<span title='Colleague List'>Colleague</span>";
}

if($list=="aqu")
{
$list="aquintance";
$list_title="<span title='Colleague List'>Acquaintance</span>";
}


if($list=="no")
{
$list="NPA";
$list_title="<span title='No Prior Acquaintance List'>NPA</span>";
}

echo $list_title;?></b>&nbsp;list</p>
<p><b>From:</b><?php echo " ".$user->get_city().",".$user->get_state();?></b></p>
<p><b>Country:</b><?php echo $user->get_country(); ?></p><?php echo $points_offerd;?>
<p id="accep_reject_buttonset"></br><input type="button" class='special_btn' value="Allow" onclick='accep_reject("<?php echo $req;?>","add","<?php echo user_name($req);?>","<?php echo $list ;?>")'>
<input type="button" class='special_btn' style='background:#E00000;' value="Don't allow" onclick='accep_reject("<?php echo $req;?>","reject","<?php echo user_name($req);?>","<?php echo $list ;?>")'>
</p>
</td>
<td>&nbsp;&nbsp;<?php if(user_pic($req))echo "<img src='".$user->prof_pic()."' height='230' width='200'>";else echo "<img src='".$user->prof_pic()."' height='230' width='200' alt='No picture uploaded yet by ".user_name($req)."'>";?></td>
</tr>
</table>
<?php
}
else
{
header('location:home.php');
}
?>