<?php


class Circleicon extends CWidget{

public $circle;

public function run(){
	
	if(!empty($this->circle)){

	$this->render("circle_icon",array("circle"=>$this->circle));

	}


}



}


?>