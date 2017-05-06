<?php


class Chatbar extends CWidget{

public function run(){

	$this->render("chatbar",array(

		"user"=>helpers::GetUser()

		));
}



}


?>