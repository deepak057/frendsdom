<?php

include("environment.php");
check_auth();

if(!empty($_POST['col_id']))
{
if((($_FILES["new_pic"]["type"] == "image/gif")|| ($_FILES["new_pic"]["type"] == "image/jpeg") || ($_FILES["new_pic"]["type"] == "image/png")) && ($_FILES["new_pic"]["size"]<=800000))
{
if(isset($_FILES['new_pic'])) 
{
if($_FILES['new_pic']['error'] == 0) 
{

$dbLink=new mysqli($host,$db_user,$db_passwd,$picdata_db);if(mysqli_connect_errno()) {die("MySQL connection failed: ". mysqli_connect_error());}

//assigning an unique id to this picture
$pic_id="pic".$_SESSION['userid']."_".mktime();

if($dbLink->query("insert into {$_POST['col_id']} (pic_name,pic_id,pic_type,pic_size,uploaded,pic_data) values('".addslashes(substr(trim($_FILES['new_pic']['name']),0,199))."','{$pic_id}','".$dbLink->real_escape_string($_FILES['new_pic']['type'])."','".intval($_FILES['new_pic']['size'])."','".date('Y-m-d H:i:s')."','".$dbLink->real_escape_string(file_get_contents($_FILES  ['new_pic']['tmp_name']))."')") && $dbLink->query("create table {$pic_id} (comment_index Int Unsigned Not Null Auto_Increment,primary key(comment_index),fromid varchar(20) not null,comment text(5000),when1 datetime)"))
$r=$pic_id;
else
$r='failed';
}
}
}
else $r='failed';
}

else {

header('location:home.php');

}
?>
<script language="javascript" type="text/javascript">
window.top.window.stopUpload("<?php echo $r;?>");
</script>