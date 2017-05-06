<?php


class WsController extends CController{



/***
** Method to print JSON response
**/

function PrintResponse($arr){

		header('Content-type: application/json');
		echo json_encode($arr);
		exit;

}


function GetResponseArray($status,$message,$data=array()){

return array(

	"status"=>$status?1:0,
	"message"=>$message,
	"data"=>$data


	);

}

/*
* Method to get list of all the registered users
**/

function actionListAll(){
	
	if(!empty($_POST['uid'])){
		
		$criteria = new CDbCriteria();
		$criteria->condition = "id != ".$_POST['uid'];
		if(!empty($_POST['contacts'])){
			
		$contacts=json_decode(stripcslashes($_POST['contacts']),true);	
		if(!empty($contacts)){
		
		//parse the numbers in the array to remove +, 0 etc from the beginning of the numbers
		foreach($contacts as $k=>$contact){
			$contacts[$k]=preg_replace('~^[0\D]++|\D++~', '', (string)$contact);
		}
		
		$criteria->addInCondition('no', $contacts);
		
		}
		
		}
		
		$users=users::model()->findAll($criteria);
		
		if($users!=null){

			$final=array();
			
			foreach($users as $user){
			
			$final[]=$this->userArray($user);
				
			}
			
			$this->PrintResponse($this->getResponseArray(1,"List retrieved",$final));
		}
		
		else {
			
			$this->printResponse($this->getResponseArray(0,"No records found"));
		}
	}
}

/**
** Method to register a user
*/

function actionRegister(){

	if(!empty($_POST['name']) && !empty($_POST['no']) && !empty($_POST['location'])){
	
		$user=new users();
		$user->name=trim($_POST['name']);
		$user->no=trim($_POST['no']);
		$user->location=$_POST['location'];
		$user->registration_date=Helpers::SqlDateTime();
		
		if($user->save()){
			
			$response_=$this->GetResponseArray(1,"Registration Successful",$this->userArray($user));
			
		}
		
		else {
			
			$response_=$this->GetResponseArray(0,"Registration failed");
			
			
		}
		
		
		
		$this->PrintResponse($response_);

	}

}

	/**
	* Method to get user data in array's form based on the given user object
	**/
	
	function userArray($user){
		
		return array("id"=>$user->id,
					"name"=>$user->name,
					"location"=>$user->location,
					"number"=>$user->no,
					"pic_url"=>!empty($user->pic)?AppURLs::ProfilePictureURL($user->pic):null,
					"privacy"=>$user->privacy,
					"blocked"=>$user->blocked,
					);
		
	}

	
	/**
	** Method to update a user
	**/
	
	function actionUpdate(){

		if(!empty($_POST['uid']) && !empty($_POST['location']) && !empty($_POST['name'])){
			
			$user=users::model()->findbyPk($_POST['uid']);
			$user->name=trim($_POST['name']);
			$user->location=$_POST['location'];
			
			if($user->save()){
				
				$response=$this->getResponseArray(1,"Update successful",$this->userArray($user));
			}
			
			else {
				
				$response=$this->GetResponseArray(0,"Update failed");
			}
			
			$this->PrintResponse($response);
		}
	
	}
	
	
	/**
	** Method to upload profile picture for given user 
	**/
	
	function actionupdateProfilePic(){
		
		if(!empty($_POST['uid']) && !empty($_FILES['user_pic'])){
			
			$user=users::model()->findbyPk($_POST['uid']);
			
			if($user==null) $this->printResponse($this->getResponseArray(0,"No user found"));
			
			if(!empty($_FILES['user_pic'])){

if(!Helpers::IsValidImage($_FILES['user_pic']['tmp_name'])){

$response=$this->GetResponseArray(false,"Invalid image file.");

$this->PrintResponse($response);

}

//get file name
$name=Helpers::uid($_POST['uid']).".".pathinfo($_FILES['user_pic']['name'], PATHINFO_EXTENSION);

//get file path
$target=directories::PathProfilePicture($name);

if( move_uploaded_file($_FILES['user_pic']['tmp_name'],$target) && chmod($target,0777) ){
	
	$user->pic=$name;
	
	$user->save();
	
	$response=$this->getResponseArray(1,"Upload successful",$this->userArray($user));
}

else {
	
	$response=$this->getResponseArray(0,"failed to upload image");
}

$this->printResponse($response);

}
			
			
			
			
			
		}
	}
	
	
	//Method to save Privacy settings for a user
	function actionUpdatePrivacy(){
		
		if(!empty($_POST['uid']) && !empty($_POST['privacy']) ){
			
			//get the user
			$user=users::model()->findByPk($_POST['uid']);
			
			if($user==null){
				
				$this->printResponse($this->getResponseArray(0,"User not found"));
				exit;
			}
			
			$user->privacy=$_POST['privacy'];
			
			if(!empty($_POST['blocked'])){
				
			$user->blocked=	$_POST['blocked'];
			
			}
			
			if($user->save()){
				
			$response=$this->GetResponseArray(1,"Settings updated successfully",$this->userArray($user));	
			}
			
			else {
				
			$response=$this->GetResponseArray(0,"Failed to update settings");	
			
			}
			
			$this->PrintResponse($response);
			
		}
	}
	
	
}
