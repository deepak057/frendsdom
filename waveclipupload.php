<?php

include("environment.php");
check_auth();

$result1=0;

if(isset($_FILES['uploaded_file'])) 
{

/*

Following are the restrictions-

1) File must be an audio WAV,MP3,MP4,MPEG type

2) File Must be under 2 MB in size

*/

if($_FILES['uploaded_file']['error'] == 0) 
{

if(( $_FILES["uploaded_file"]["type"] == "audio/wav" || $_FILES["uploaded_file"]["type"] == "audio/mpeg" || $_FILES["uploaded_file"]["type"] == "audio/mp4" || $_FILES["uploaded_file"]["type"] == "audio/mp3") && ($_FILES["uploaded_file"]["size"]<=2*$bytes_in_mb))
{

$dbLink =new mysqli($host,$db_user,$db_passwd,$soundclips_db);
if(mysqli_connect_errno()) {die("MySQL connection failed: ". mysqli_connect_error());}

//deriving unique name for this clip          
$clipid="clip{$_SESSION['userid']}_".mktime().".".pathinfo($_FILES["uploaded_file"]["name"],PATHINFO_EXTENSION);

//path to this clip
$clip_path=get_clip_path($_SESSION['userid'])."/".$clipid;

//save file
move_uploaded_file($_FILES["uploaded_file"]["tmp_name"],$clip_path);

if($dbLink->query("INSERT INTO soundclipsofuser{$_SESSION['userid']} (`name`, `mime`, `size`, `created` ,`set1`,`clipid`) VALUES ('".$dbLink->real_escape_string($_FILES['uploaded_file']['name'])."', '".$dbLink->real_escape_string($_FILES['uploaded_file']['type'])."', '".intval($_FILES['uploaded_file']['size'])."', '".date('Y-m-d H:i:s')."','yes','{$clipid}')")) 
{
if($dbLink->query("update soundclipsofuser{$_SESSION['userid']} set set1='no' where set1='yes'") && $dbLink->query("update soundclipsofuser{$_SESSION['userid']} set set1='yes' where clipid='{$clipid}'")) 
$result1=1;
} 
}
}
}

?>
<script language="javascript" type="text/javascript">
window.top.window.stopUpload(<?php echo $result1; ?>);
</script> 