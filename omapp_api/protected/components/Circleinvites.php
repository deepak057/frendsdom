<?php


class Circleinvites extends CWidget{

public $uid=false, $invites=false;

public function run(){
	
	//get all the circle invites received by current user
	$invites=!$this->invites?helpers::get_controller(INVITATION)->GetInvites($this->uid):$this->invites;

	$this->render("invites",array("invites"=>$invites));

}



}


?>