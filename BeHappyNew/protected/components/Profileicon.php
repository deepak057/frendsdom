<?php

class Profileicon extends CWidget{

public $user;

public function run(){
	
	if(!empty($this->user)){

	$this->render("profile_icon",array("user"=>$this->user));

	}


}



}


?>