<?php

class Circleswidget extends Cwidget{

public $uid=false;

public function run(){

$this->render("circles_widget",array(

"circles"=>$this->GetCircles($this->uid),

));


}


/**
** Method to get circles or mutual circles depending upon the id of current user
**/

function GetCircles($uid=false){

//get the uid
$uid=Helpers::uid($uid);

//get circles controller
$circle_c=Helpers::get_controller(CIRCLES);

if(Helpers::is_logged_in() && $uid!=Helpers::uid()){

$circles=$circle_c->MutualCircles($uid);

}

else {

$circles=$circle_c->GetCircles($uid);

}

return $circles;

}



}


?>