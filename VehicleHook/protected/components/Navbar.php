<?php


class Navbar extends CWidget{


public function run(){

	//get User object of logged in user
	$user=helpers::GetUser();

	if($user){

		$this->widget("Themenavbar",array("user"=>$user));
	
	}

	
	else {
	
	$this->widget("Landingnavbar",array("user"=>$user));
	
	
	}
}


}


?>
