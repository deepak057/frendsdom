<?php


class Singlenotification extends CWidget{

public $notification=false;

function run(){

if($this->notification){

$this->render("single_notification",array("notification"=>$this->notification));

}

}


}

?>