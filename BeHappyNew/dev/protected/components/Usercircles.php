<?php


class Usercircles extends CWidget{

public 	

		//cActive record object of current user
		$user, 

		//number of circles in one slide
		$circles_in_slide=7;

		


public function run(){

	$this->render("user_circles",array(

		"uid"=>$this->user->id,
		"user"=>$this->user,
		"circles_in_slide"=>$this->circles_in_slide,

		));
	
	}


}


?>

