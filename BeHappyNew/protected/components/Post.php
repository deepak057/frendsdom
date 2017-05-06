<?php


class Post extends CWidget{

public $post=false,
		
		//default options
		$options=array(

			"comments_enabled"=>false,
			"class"=>""

			);


public function run(){

	//get User Controller
	$user_c=Helpers::get_controller(USERS);
	
	$this->render("post",array(

		"post"=>$this->post,
		"comments_enabled"=>!empty($this->options['comments_enabled'])?$this->options['comments_enabled']:false,
		"class"=>!empty($this->options['class'])?$this->options['class']:"",
		"is_owner"=>Helpers::is_logged_in() && Helpers::uid()==$this->post->created_by, //check if the current user is the owner of this post so they can manage it 
		"creator"=>$user_c->GetUserById($this->post->created_by),	
		"user_controller"=>$user_c,
		
		));

	}


}


?>
