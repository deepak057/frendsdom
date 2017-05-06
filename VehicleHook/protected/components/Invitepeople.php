<?php


class Invitepeople extends CWidget{

public $circle=false, $uid=false;

public function run(){

	if($this->circle){

	$this->circle=helpers::get_controller(CIRCLES)->GetCircle($this->circle);

	$this->render("invite_people",array(

		"circle"=>$this->circle,
		"user"=>helpers::GetUser($this->uid)

		));

	}

}



}


?>