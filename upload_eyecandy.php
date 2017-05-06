<?php

include("environment.php");
check_auth();

if (($_FILES["ecp_file"]["type"] == "image/gif")|| ($_FILES["ecp_file"]["type"] == "image/jpeg") || ($_FILES["ecp_file"]["type"] == "image/png"))
{

$pic_name=$_FILES["ecp_file"]["name"];
$pic_data=file_get_contents($_FILES["ecp_file"]["tmp_name"]);
$pic_size=$_FILES["ecp_file"]["size"];
$pic_type=$_FILES["ecp_file"]["type"];
$pic_id="eyecandy_pic_{$_SESSION['userid']}_".mktime();
$created=date('Y-m-d H:i:s');

// Get original size of image
$image = imagecreatefromstring($pic_data);
$current_width = imagesx($image);
$current_height = imagesy($image);

// Set thumbnail width
$new_width = min(array($current_width, $max_width));

// Calculate thumbnail height from given width to maintain ratio
$new_height = $current_height / $current_width*$new_width;
$thumb_height=$current_height / $current_width*$max_thumb_width;

// Create new image using thumbnail sizes
$pic_data = imagecreatetruecolor($new_width,$new_height);

// Create new image using thumbnail sizes
$thumb_data = imagecreatetruecolor($max_thumb_width,$thumb_height);


// Copy original image to thumbnail
imagecopyresampled($pic_data,$image,0,0,0,0,$new_width,$new_height,imagesx($image),imagesy($image));

// Copy original image to thumbnail
imagecopyresampled($thumb_data,$image,0,0,0,0,$max_thumb_width,$thumb_height,imagesx($image),imagesy($image));


// Show thumbnail on screen
//$show = imagejpeg($thumb);

ob_start();
imagejpeg($pic_data);
$pic_data=ob_get_clean();

ob_start();
imagejpeg($thumb_data);
$pic_data_thumb=ob_get_clean();


// Clean memory
imagedestroy($image);
//imagedestroy($thumb);
imagedestroy($thumb_data);


//inserting picture into user's eyecandy table
$mysqli=new mysqli($host,$db_user,$db_passwd,$eyecandy_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
if($mysqli->query("insert into eyecandy_pics_of_user{$_SESSION['userid']} (pic_name,pic_data,pic_data_thumb,pic_type,pic_size,pic_id,created,belongs_to_id,is_set) values ('{$pic_name}','".$mysqli->real_escape_string($pic_data)."','".$mysqli->real_escape_string($pic_data_thumb)."','{$pic_type}','{$pic_size}','{$pic_id}','{$created}','{$_SESSION['userid']}',1)") && $mysqli->query("update eyecandy_pics_of_user{$_SESSION['userid']} set is_set=0 where pic_id!='{$pic_id}'")){
$r=$pic_id;
}
else{
$r='failed';
}

}

?>
<script language="javascript" type="text/javascript">
window.top.window.stop_ecp_Upload("<?php echo $r; ?>");
</script> 