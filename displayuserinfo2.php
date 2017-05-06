<?php

include("environment.php");
check_auth();

if(!empty($_POST['id']))
{

include('class_lib.php');

//filtering the received id
$_POST['id']=htmlentities(trim($_POST['id']));

//instantiating class user
$user=new user($_POST['id']);

//getting Unix timestamp for the time when user's account was created
$w=strtotime($user->get_created());

//getting user's sex
if($user->get_sex()=="female")$h="she" ;else $h="he";

//checking email visibility
if(is_email_visible($user))
{
$info_array=array("name" =>$user->get_name()."</br><span style='color:grey;font-size:.9em;'>here since ".date("d M Y",$w)." </span> " ,"image"=>$user->prof_pic(),"bio" => "<b>Sex:</b> ".$user->get_sex()."</br><b>Date of birth</b>: ".$user->get_dob()."</br><b>Location:</b>".$user->get_city().",".$user->get_state()."</br><b>Country:</b>".$user->get_country()."</br></br>It's been about "._ago($w)." since {$h} joined ","email"=>$user->get_email());
}

else
{
$info_array=array("name" =>$user->get_name()."</br><span style='color:grey;font-size:.9em;'>here since ".date("d M Y",$w)." </span> " ,"image"=>$user->prof_pic(),"bio" => "<b>Sex:</b> ".$user->get_sex()."</br><b>Date of birth</b>: ".$user->get_dob()."</br><b>Location:</b>".$user->get_city().",".$user->get_state()."</br><b>Country:</b>".$user->get_country()."</br></br>It's been about "._ago($w)." since {$h} joined ");
}

//printing the data in JSON format
echo json_encode($info_array);

}
else
{
header('location:home.php');
}
?>