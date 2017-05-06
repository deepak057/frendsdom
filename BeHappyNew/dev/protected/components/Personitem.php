<?php


class Personitem extends CWidget{

public $user=false;

public function run(){

	$this->render("person_item",array(
			
			"user"=> Helpers::get_controller(USERS)->GetUserById($this->user)

			));

	

}


}


?>