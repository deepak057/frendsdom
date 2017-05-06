<?php

class TourController extends CController{


function GetWizardView($uid=false){
	
	return $this->renderPartial("wizard",array(

		"user"=>Helpers::get_controller(USERS)->GetUserById($uid),
		"global_circles"=>Helpers::get_controller(CIRCLES)->GetGlobalCircles($uid),

		),true);
}


}



?>