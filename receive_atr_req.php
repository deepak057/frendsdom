<?php

include("environment.php");
check_auth();

if(!empty($_POST['n']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

if($_POST['n']==1)
{
$i=0;

//retrieving new invitations
$mysqli=new mysqli($host,$db_user,$db_passwd,$authority_recpients_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($result=$mysqli->query("select request_from from authorityrecpients4user{$_SESSION['userid']} where requested!='' && request_from!=''"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if(account_status($row['request_from']))
{
$req[$i]=$row['request_from'];
$i++;
}
}
}
}

//deleting temporary userrequest table if already exists
$mysqli->query("drop table tempauthorityrecpients4user{$_SESSION['userid']}");

//creating temporary user request table 

foreach( $req as $row ) {$ql[] ='("'.$row.'")'; }


if($mysqli->query("create table tempauthorityrecpients4user{$_SESSION['userid']} (id Int Unsigned Not Null Auto_Increment,primary key(id),request_from varchar (20) not null)"))
{
if($mysqli->query("insert into tempauthorityrecpients4user{$_SESSION['userid']} (request_from) values ".implode(",",$ql))===false)
die( "Failed to create your database");
}
else die ("Failed to create your database");
}

$req=entity_value("tempauthorityrecpients4user".$_SESSION['userid'],'request_from','id',$_POST['n'],$authority_recpients_db);

if(user_sex($req)=="female")
{
$h='she';$hh='her';
}
else
{
$h='he';$hh='him';
}

?>
<span class='red_onhover' title='Close' style='position:absolute;top:2px;right:8px;' onclick='hide_atr();'>&#215;</span>
<table id='atr_table'>
<tr>
<td colspan='2'><h3><img src='noti.gif' align='middle'>&nbsp;Authority request</h3>
<span style='color:white;position:absolute;top:70px;left:78px;'>Sent on: <?php echo entity_value("authorityrecpients4user{$_SESSION['userid']}","DATE_FORMAT(requested,'%d %M %Y')","request_from",$req,$authority_recpients_db);?> ( about <?php echo ago(entity_value("authorityrecpients4user{$_SESSION['userid']}","UNIX_TIMESTAMP(requested)","request_from",$req,$authority_recpients_db));?>)</span>
</td>
</tr>

<tr>
<td colspan='2'>
<a href='<?php echo get_profile_url($req); ?>'><b><?php echo user_name($req);?></b></a> is asking you to grant <?php echo $hh; ?> the authority to change your profile appearance.
</td>
</tr>
<tr id='atr_tr2'>
<td id='atr_btnset'>
<input type='button' class='special_btn' value='Allow' onclick='handle_atrReq("<?php echo $req; ?>","allow");'>
<input type='button' class='special_btn' style='background:red;' value='Reject' onclick='handle_atrReq("<?php echo $req; ?>","reject");'>
</td>
<td align='right'>
<img src='<?php echo prof_pic($req);?>' height='180' width='300'>
</td>
</tr>

</table>

<?php
}
else
{
header('location:home.php');
}
?>