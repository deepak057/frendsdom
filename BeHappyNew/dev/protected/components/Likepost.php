<?php


class Likepost extends CWidget{

public $post=false,$uid=false;

public function run(){

if(!empty($this->post)){

$this->render("like_post",array(

	"post"=>$this->post,
	"already_liked"=>in_array(helpers::uid($this->uid),$this->post->likes),

	));

}


}


}


?>