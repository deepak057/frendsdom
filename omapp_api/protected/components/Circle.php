<?php


class Circle extends CWidget{

public $circle=false;

public function run(){

	if($this->circle){

	$this->render("circle",array(

			"circle"=>$this->circle,
			"is_owner"=>$this->circle->created_by==Helpers::uid(),

			));

	}

	}


}


?>
