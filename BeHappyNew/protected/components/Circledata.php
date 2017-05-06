<?php


class Circledata extends CWidget{

public $circle=false, $user=false;

public function run(){

	if($this->circle){

		//get user object
		$user=helpers::get_controller(USERS)->GetUserById($this->user);

		$this->circle=$this->GetCircle($this->circle); //get and fix circle object

		$this->render("circle_data",array(

		"circle"=>$this->circle,

		"user"=>$user,

		//get  posts belonging to this circle		
		"posts"=>helpers::get_controller(POSTS)->GetCirclePosts($this->circle->id), 

		//Boolean for wether this user is part of this circle
		"is_part"=>helpers::get_controller(CIRCLES)->BelongToCircle($this->circle->id,!empty($user)?$user->id:false),
	

		));

	}

	}


function GetCircle($circle){

if(!is_object($circle))	{

	return helpers::get_controller(CIRCLES)->GetCircleById($circle);

	}

return $circle;

}


}


?>
