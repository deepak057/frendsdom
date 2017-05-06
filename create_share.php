<?php

include("environment.php");
check_auth();

if(!empty($_POST['share_title']) && !empty($_POST['share_content'])) 
{

$mysqli=new mysqli($host,$db_user,$db_passwd,$share_box_db);if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}

//generate an unique id for this Share
$share_id="share".uid()."_".mktime();

if($mysqli->query("insert into sboxofuser{$_SESSION['userid']} (share_title,share_data,share_id,created,background) values ('".addslashes(trim($_POST['share_title']))."','".addslashes(trim($_POST['share_content']))."','{$share_id}','".date('Y-m-d H:i:s')."','{$_POST['background']}')"))
{

/*

Verifying image if uploaded

*/

if(!empty($_FILES['share_pic']) && $_FILES['share_pic']['error'] == 0){

if(!empty($_FILES['share_pic']) && check_if_image($_FILES['share_pic']['tmp_name']) && ($_FILES["share_pic"]["size"]<=800000) )
{

//include WideImage library
include(lib_path("wideimage/WideImage.php"));

//load file 
$share_pic = WideImage::load('share_pic');

//get its extension
$pic_ext=get_extension($_FILES['share_pic']['name']);

//derive picture's name
$pic_name=$share_id.".".$pic_ext;


//resize image only if it's dimensions are smaller than regular ones
$resized = $share_pic->resize(
		
		$GLOBALS['sbox_pics']['width_regular'], 
		$GLOBALS['sbox_pics']['height_regular'], 
		'outside',
		'up'
		
		);

//save file
$resized->saveToFile(get_share_pic_dir(uid())."/".$pic_name);

/*
resize this picture to a smaller dimension
*/

$share_pic = WideImage::load(get_share_pic_dir(uid())."/".$pic_name);

$share_pic_smaller=$share_pic ->resize(
				
				$GLOBALS['sbox_pics']['width_smaller'], 
				$GLOBALS['sbox_pics']['height_smaller'],
				'outside' 

				);

$share_pic_smaller->saveToFile(

	//derive path to smaller version 
	get_share_pic_dir(uid())."/".get_share_pic_name_smaller($share_id).".".$pic_ext


	);


//update database to store this file's extension
$mysqli->query("update sboxofuser{$_SESSION['userid']} set share_pic_type='{$pic_ext}' where share_id ='{$share_id}' ");

}

}


/*
Use module "share box" to get HTML that can render created share
*/

include("class_lib.php");
include(get_module_path("pp_sharebox/share_box.php"));
$sb=new share_box(new user(uid()));

//confirm success
echo json_encode(array(
	
	"success"=>true,
	"share_id"=>$share_id,
	"share_html"=>$sb->put_share($share_id)
	
	));

}

else {

echo "failed";

}

}

else {

header('location:home.php');

}


?>