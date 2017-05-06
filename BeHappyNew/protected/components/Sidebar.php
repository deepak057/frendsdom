<?php


class Sidebar extends CWidget{

public function run(){

	if(Helpers::IsComponentVisible("sidebar")){
	
	$this->render("sidebar",array(

		//current user's object
		"user"=>helpers::GetUser()

		));

	}
}



}


?>