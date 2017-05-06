<?php

class Sendmessage extends CWidget{


public $user=false;

public function run(){

if($this->user){

$this->render("send_message",array(

"user"=>$this->user,
"own_profile"=>$this->user->id==Helpers::uid()

));

}

}



}



?>