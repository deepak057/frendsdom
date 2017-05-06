<?php

include("environment.php");
check_auth();

if(!empty($_POST['n']))
{

//compressing HTML content 
//ob_start("ob_gzhandler"); 

$nudgesets=array();$i=0;
if($_POST['n']==1)
{

//retrieving unviewed nudgesets
$mysqli=new mysqli($host,$db_user,$db_passwd,$nudgeset_records);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($result=$mysqli->query("select * from nudgeboxofuser{$_SESSION['userid']} order by id desc"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if($row['viewed']=="no" && account_status($row['fromid']))
{
$nudgesets[$i]=$row['nudgeset'];
$i++;
}
}
}
}

//deleting temporary nudge box table if already exists
$mysqli->query("drop table tempnudgeboxofuser{$_SESSION['userid']}");

//creating temporary nudgeset table 
foreach( $nudgesets as $row ) {$ql[] ='("'.$row.'")'; }

if(!$mysqli->query("create table tempnudgeboxofuser{$_SESSION['userid']} (id Int Unsigned Not Null Auto_Increment,primary key(id),nudgeset varchar(50) not null)") || !$mysqli->query("insert into tempnudgeboxofuser{$_SESSION['userid']} (nudgeset) values ".implode(",",$ql)))
{
die("Error :failed to create your database");
}

}

//getting required nudgeset id 
$mysqli=new mysqli($host,$db_user,$db_passwd,$nudgeset_records);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}

if($result=$mysqli->query("select nudgeset from tempnudgeboxofuser{$_SESSION['userid']} where id={$_POST['n']}"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if(!empty($row['nudgeset']))
{
$nudgeset=$row['nudgeset'];
}
}
}
}

//retreiving nudgeset

$mysqli=new mysqli($host,$db_user,$db_passwd,$nudgesets_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($result=$mysqli->query("select DATE_FORMAT(when1,'%d %M %Y'),DATE_FORMAT(when1,'%r') ,fromid,nudgetext,recepeints,letbeknown,nudgeclip,nudgeclip_type,nudgeclip_size,nudgepic,nudgepic_type,nudgepic_size,included_lists from {$nudgeset}"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if($row['letbeknown']=="yes")
{
$others=sizeof(explode(",",$row['recepeints']))-1;
}
?>
<div id='textpart'>
<input type='button' value='Close' id='btn' style='position:absolute;left:460px;' onclick='hide_nudgespace()'><p style='font-size:1.2em;'><img src='<?php echo prof_pic($row['fromid']);?>' height='50' width='50' align='middle'><span><a class="dui" data-hovercard-id="<?php echo $row['fromid'];?>" href='<?php echo get_profile_url($row['fromid']);?>' ><b>&nbsp;&nbsp;<?php echo user_name($row['fromid']);?></b></a> is nudging you !
<?php
if($row['letbeknown']=="yes")
{
?>
</br><a href='javascript:others_included("<?php echo $nudgeset;?>")'><span id='others' style='font-size:.7em;position:absolute;top:70px;left:93px;color:grey;text-decoration:underline;' onmouseover="this.style.color='black';" onmouseout='this.style.color="grey";' >apart from <?php echo $others;?> others</span></a>
<?php
}
echo "<span style='font-size:.8em;color:grey;position:absolute;top:100px;left:30px;'>Sent: {$row[0]} at {$row[1]}</span><p></br></br></br> ".nl2br(auto_link_text(stripslashes($row['nudgetext'])))."</p></div><div id='imagepart'><img src='get_nudgepic.php?nudgeset={$nudgeset}' height='430' width='339'></div>"; 
?>

<div style='position:absolute;top:50px;right:15px;'><input type='button' id="reply_to_nudge_btn"  value='Reply to this nudge' onclick="show('reply_to_nudge');"></br>
 
<div id='reply_to_nudge' class="hidden grey_backg border_1_b left">
<u><b>Reply by :</b></u>
<p>
<input type='radio' onclick="reply_to_nudge_by('message','<?php echo $row['fromid']; ?>');">Text message</br>
<input type='radio' onclick="reply_to_nudge_by('nudge','<?php echo $row['fromid']; ?>');">Nudging back
</p>
</div>
<?php
if(!empty($row['nudgeclip'])) 
{
echo "<input type='button' value='Play nudge clip' style='background:green;border:1px solid black;'>";
}

echo "</div>";

if(!empty($row['nudgepic'])) 
{$opacity=".2";$opacity1="1";
echo "<a href='#'><img id='lr_image' style='position:absolute;top:200px;left:00px;' src='right.png' height='20' width='20' onclick='show_nudgeimage();' onmouseover='this.style.opacity=".$opacity.";' onmouseout='this.style.opacity=".$opacity1.";' title='Click to see the picture associated with this nudge'></a>";
}
}
}
}

}

else
{
header('location:home.php');
}
?>