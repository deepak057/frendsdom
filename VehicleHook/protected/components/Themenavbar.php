<?php

class Themenavbar extends CWidget{

public $user=false;

public function run(){

$this->render("theme_navbar",array(
		
		"user"=>$this->user,
		"invites"=>helpers::get_controller(INVITATION)->GetInvites($this->user->id),
		
		));

}

}

?>