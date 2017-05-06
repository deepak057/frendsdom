<?php

class Themenavbar extends CWidget{

public $user=false;

public function run(){

$this->render("theme_navbar",array(
		
		"user"=>$this->user,
		"invites"=>helpers::get_controller(INVITATION)->GetInvites($this->user->id),
		"notifications"=>helpers::get_controller(NOTIFICATION)->GetNotifications($this->user->id),
		"new_notifications"=>helpers::get_controller(NOTIFICATION)->GetUnreadNotifications($this->user->id),
		));

}

}

?>