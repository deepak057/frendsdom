<?php


class Userfeed extends CWidget{

public $user;

public function run(){

$this->render("timeline",array(

"user"=>$this->user

));
	
}


}


?>
