<?php

include("environment.php");
check_auth();

$selected_clip=get_selected_clip($_SESSION['id']);

echo json_encode(array(

"clip"=>$selected_clip,

"type"=>get_extension($selected_clip)

));

?>