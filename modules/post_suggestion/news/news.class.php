<?php

/*
*This script relies on "Functionlist.php" which must already be included
*
*Purpose: this class is used to fetch news through Gaurdian's API.
*/


class news extends custom{


public //$apikey_old="v26smuf5fkcg6esx384dztpe",

	$apikey="zukvj6rchmgscxdmt77fpsht",
	$base="http://content.guardianapis.com/",$query,
	$filter_cats=array("Help","Community","Cardiff","Leeds","Edinburgh","Info","Katine","Extra","Crosswords","Stage","Search");



/*
*method used to get API response 
*/

function get_response($query){

$this->query=$this->base.$query."&format=json&order-by=newest&api-key=".$this->apikey;

return json_decode($this->execute_query($this->query));

}


function get_cats(){

return $this->get_response("sections?");

}

function get_item($cat,$page=1,$size=5){

return $this->get_response("{$cat}?page={$page}&show-fields=all&show-media=all&page-size={$size}");

}


}



?>