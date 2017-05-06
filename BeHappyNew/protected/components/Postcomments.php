<?php


class Postcomments extends CWidget{

public $post=false;

function run(){

if($this->post){

$this->render("comments",array(

		"post"=>$this->post,
		"enable_view_all"=>$this->post->total_comments>$GLOBALS['app_config']['default_count']['comments_count']

		));

}

}



}


?>