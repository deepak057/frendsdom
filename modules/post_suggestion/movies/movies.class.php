<?php


class movies extends custom{


var $base,$api_key="a40a4c1a6a230fd7f3f3fd1b620d9b67",$query,$pic_base;

function __construct(){

$this->base=$GLOBALS['movie_api_base'];
$this->pic_base=$GLOBALS['movie_api_pic_base'];


}


function get_cats(){

return array("upcoming","now_playing","popular","top_rated");

}

function get_content($cat,$page){

return json_decode($this->execute_query($this->query=$this->base."/{$cat}?api_key={$this->api_key}&page={$page}"));

}

function get_pic($pic_path){

return $this->pic_base.$pic_path;

}


}



?>