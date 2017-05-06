<?php


class Circlesbar extends CWidget{

	public $user=false;

	public function run(){

		//get circles
		$circles=Helpers::get_controller(CIRCLES)->GetCircles($this->user);

		if(!empty($circles)){

			$this->render("circles_bar",array("circles"=>array_reverse($circles)));
		}


	}
}


?>