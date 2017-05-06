<?php

/*

This class is used to render Recent Status view on profile page
This class relies on FunctionList.php which must already be included

*/

class recent_status{

var $row;

function __construct($row){

$this->row=$row;

}


function put_view(){

?>

<div class="pp-rs-block"><?php echo text($this->row->post_content) ;?></div>


<?php
}

}


?>