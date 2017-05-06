<?php

$success=true;

//set user name for current user

if(!is_user_name_available($_POST['username']) || !update_entity("userdata","id",uid(),"user_name",$_POST['username']))
{
$success=false;
}


//print response

echo json_encode(

array( 

"success"=>$success,
"message"=>"<div><p class='info-box'><img height='20' width='20' src='".get_image("checkmark.gif")."'/>Congratulations! Your user name is <span class='bold'>".$_POST['username']."</span></p>
<p class='grey small'>Your Profile URL- <a class='grey' href='".profile_url_with_username($_POST['username'])."'><u>".profile_url_with_username($_POST['username'])."</u></a></p>"
)
);


?>