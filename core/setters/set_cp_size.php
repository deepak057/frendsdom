<?php

//include WideImage library
include(lib_path("wideimage/WideImage.php"));

//get current user
$lu=get_lu();

//path to cover pic
$cp_path=cover_pic_path($lu->id)."/".$lu->cover_pic;

WideImage::load($cp_path)->crop(

$_REQUEST['x1'], 
$_REQUEST['y1'], 
$GLOBALS['cover_pic_conf']['frame_width'],
$GLOBALS['cover_pic_conf']['frame_height']

)
->saveToFile($cp_path);

//if everything goes fine, confirm success
echo json_encode(array("success"=>true,"pic_path"=>cover_pic($lu)));

?>