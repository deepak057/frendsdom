<?php


class Circleitem extends CWidget{

public $circle=false;

public function run(){

	if($this->circle){

	$this->render("circle_item",array(

			"circle"=>$this->circle,

			//check wether the current user viewing the circle is its member
			"is_member"=>Helpers::get_controller(CIRCLES)->BelongToCircle($this->circle->id), 

			));

	}
	

}


}


?>