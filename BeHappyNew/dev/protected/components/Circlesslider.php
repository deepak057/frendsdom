<?php


class Circlesslider extends CWidget{

public $uid=false, 


		//number of circles in one slide
        $circles_in_slide=7,


		/**width of element containing the slider
		** If it's given the number of slides 
		** will be calculated
		**/

		$container_width=false;



public function run(){

	//get circles data
	$circles=helpers::get_controller(CIRCLES)->GetCircles($this->uid);

	$this->render("circles_slider",array(

		"circles"=>$circles,
		"circles_in_slide"=>$this->container_width?round($this->container_width/$GLOBALS['app_config']['default_count']['dashboard_circle_width']):$this->circles_in_slide,


		));
	
	}


}


?>

