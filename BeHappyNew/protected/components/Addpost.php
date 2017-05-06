<?php


class Addpost extends CWidget{

public $circle=false;

public function run(){

	if($this->circle){

	$this->render("add_post",array(

		"circle"=>$this->circle,
		"default_options"=>json_encode(helpers::get_controller(POSTS)->DefaultPostOptions(),true) //Default options for posts


		));

	}	

}


}


?>