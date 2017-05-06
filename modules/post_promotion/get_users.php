<?php

/*
This class utilizes methods from other modules to get different kinds of users
This class relies on FunctionList.php which must already be included
  
*/

class get_users{

//default number of users to be fetched
private $n=100;

function get_n($n){

return $n?$n:$this->n;

}

	
//method to get users found online recently

function recently_online($n=false){

//include required module
include_once(get_module_path("recently_online")."/recently_online.php");

return recently_online::last_active_users($this->get_n($n));

}


//method to get top users

function top_users($n=false){

//include required module
include_once(get_module_path("top_users")."/top_users.php");

return top_users::top_users_by_points($this->get_n($n));

}


//method to get users who joined site recently

function recent_users($n=false){

//include required module
include_once(get_module_path("pic_grid")."/pic_grid.php");

return pic_grid::get_latest_users($this->get_n($n));

}


}


?>