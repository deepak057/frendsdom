<?php

if($posts){

foreach ($posts as $post){

$this->widget("Post",array("post"=>$post,

	"options"=>array(

		"comments_enabled"=>true,
		"class"=>Helpers::CoulmnClass($cols),

		),
	

	));

}

}


?>