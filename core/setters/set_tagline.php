<?php

//set tagline
update_entity("userdata","id",$_SESSION['userid'],"tagline",addslashes(trim($_POST['value'])));

echo text($_POST['value']);

?>