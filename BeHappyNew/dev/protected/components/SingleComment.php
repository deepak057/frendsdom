<?php


class SingleComment extends CWidget{

public $comment=false;

public function run(){
 
	if($this->comment){
	
	//get user controller
	$user_controller=Helpers::get_controller(USERS);
  
	$this->render("single_comment",array(
					
					"comment"=>$this->comment,
					"is_owner"=>$this->comment->uid==helpers::uid(), //check if this comment is made by current user
					"creator"=>$user_controller->GetUserById($this->comment->uid),
					"user_controller"=>$user_controller,	
				
					));
	
	}
	
	}



}


?>
