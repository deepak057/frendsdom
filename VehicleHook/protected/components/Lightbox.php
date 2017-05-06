<?php


class Lightbox extends CWidget{

public $image_url=false;

public function run(){

	if($this->image_url){

	$this->render("lightbox",array(

		"image_url"=>$this->image_url

		));

	}	

}



}


?>