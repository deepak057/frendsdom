<?php


class Profilepicture extends CWidget{

public $user=false;

public function run(){

//get the user
$user=Helpers::get_controller(USERS)->GetUserById($this->user);

//get circles of this user
$circles=Helpers::get_controller(CIRCLES)->GetCircles($user->id);

$this->render("profile_picture",array(
		
		"user"=>$user,
	
		"own_profile"=>$user->id==Helpers::uid(),		

		"circles_count"=>!empty($circles)?count($circles):0,
		
		));

}



}




?>