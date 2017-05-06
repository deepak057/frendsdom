<?php

//include WideImage library
include(lib_path("wideimage/WideImage.php"));


//check if any error occured during upload

if ($_FILES['cp']['error'] !== UPLOAD_ERR_OK) {
   die("Upload failed with error code " . $_FILES['files']['error']);
}

//making sure uploaded file is an image

if(!check_if_image($_FILES['cp']['tmp_name'])){
die("Please upload a valid image file");
}

//check if uploaded size is under 2 mb in size

if($_FILES["cp"]["size"] / 1024>$GLOBALS['cover_pic_conf']['max_size']){
die("Uploaded image can not be bigger than ".($GLOBALS['cover_pic_conf']['max_size']/1024)." mb in size");
}

//get the name of this file
$file_name="cover_{$_SESSION['userid']}.".get_extension($_FILES['cp']['name']);

//path to where this file is going to be saved
$cover_dir=cover_pic_path($_SESSION['userid']);

//delete all the images that already exist in cover picture's directory
delete_all_images($cover_dir);

//cover picture path
$pic_path=$cover_dir."/".$file_name;

//save uploaded file
//move_uploaded_file($_FILES["cp"]["tmp_name"],$pic_path);

//load file 
$img = WideImage::load('cp');

//resize image only if it's dimensions are smaller than recommended ones
$resized = $img->resize(
		
		$GLOBALS['cover_pic_conf']['frame_width'], 
		$GLOBALS['cover_pic_conf']['frame_height'], 
		'outside',
		'up'
		
		);

//save file
$resized->saveToFile($pic_path) ;

//save the file name in database
update_entity("userdata","id",$_SESSION['userid'],"cover_pic",$file_name);

//confirm success
echo json_encode(array("success"=>true,"pic_path"=>cover_pic($_SESSION['userid'])));

?>