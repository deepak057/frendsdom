<?php

include("environment.php");
check_auth();

if (($_FILES["post_picture"]["type"] == "image/gif")|| ($_FILES["post_picture"]["type"] == "image/jpeg") || ($_FILES["post_picture"]["type"] == "image/png"))
{

$pic_name=$_FILES["post_picture"]["name"];
$pic_data=file_get_contents($_FILES["post_picture"]["tmp_name"]);
$pic_size=$_FILES["post_picture"]["size"];
$pic_type=$_FILES["post_picture"]["type"];
$pic_id="eyecandy_pic_{$_SESSION['userid']}_".mktime();
$created=date('Y-m-d H:i:s');


// Get original size of image
$image = imagecreatefromstring($pic_data);
$current_width = imagesx($image);
$current_height = imagesy($image);

//image width
$max_width=1000;

//thumbnail width
$max_thumb_width=150;

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


//database connection
$mysqli=new mysqli($host,$db_user,$db_passwd,$post_pic_data);


//generating unique id for this picture
$pic_id="postpic_{$_SESSION['userid']}_".mktime();


//creating new table for holding data for this picture
if($mysqli->query("create table {$pic_id} (pic_name varchar(100),pic_data MediumBlob,pic_data_thumb Blob,pic_type varchar(15),pic_size varchar(15),created datetime)"))
{

//inserting picture into above created table
if($mysqli->query("insert into {$pic_id} (pic_name,pic_data,pic_data_thumb,pic_type,pic_size,created) values ('{$pic_name}','".$mysqli->real_escape_string($pic_data)."','".$mysqli->real_escape_string($pic_data_thumb)."','{$pic_type}','{$pic_size}','{$created}')")){
$r=$pic_id;
}
else{
$r='failed';
}
}
else{
$r='failed';
}



}

?>
<script language="javascript" type="text/javascript">
window.top.window.stop_post_pic_Upload("<?php echo $r; ?>");
</script> 