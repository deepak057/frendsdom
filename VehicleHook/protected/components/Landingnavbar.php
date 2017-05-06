<?php

class Landingnavbar extends CWidget{

/**
** array containing action ids for the pages 
** on which the Login popup will not be renderd 
**/

public $disbale_login_popup=array("login"),$user,

		/**
		** Property to control wether the Help Links 
		** have to be enabled in the navigation
		**/
		$links_enabled=false;

public function run(){

$this->render("navbar",array(
		
		"user"=>$this->user,
		"login_popup_disabled"=>in_array(Yii::app()->controller->action->id,$this->disbale_login_popup), //Boolean value to enable/disable Login popup 
		"links_enabled"=>$this->links_enabled,

		));


}

}

?>