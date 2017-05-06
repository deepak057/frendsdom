<?php





class PostvoteController extends Ccontroller{


	public

	 //Property to keep track of total number of votes received on a post
	$total_votes=0, 

	//array containing the ids of users who have voted on a Post
	$user_ids=array();




/**
** Method to record a vote by the given user on a given post  
**/

function Vote($post_id,$option_id,$uid=false){

//clean previous voting record on the same post
$this->CleanVote($post_id,$uid);

//get model object
$model=$this->GetModel($post_id,$option_id);

if($model){

//get user id
$uid= helpers::uid($uid);

$votes=$model->votes;

if(empty($votes)){

$votes=array($uid);

}

else {

$votes=json_decode($votes,true);

if(is_array($votes)){

$votes[]=$uid;

}

}

$model->votes=json_encode($votes);

$model->save();

return $model;

}

else {

return false;

}


}


/**
** Get "post_poll" model object
**/

function GetModel($post_id,$option_id){

$row=post_poll::model()->find("post_id={$post_id} and option_id={$option_id}");

return $row==NULL?false:$row;

}


/**
** Method to save options for a given post
**/

function SaveOptions($post_id, $options_array){

$options= $this->FixPostOptionsArray($options_array);

if(empty($options)) return false;

else {

$sql="insert into ".post_poll::tableName()." (`post_id`,`option_id`,`option_name`) values ";

foreach ($options as $opt){

	$sql.= "({$post_id},{$opt['id']},'".addslashes($opt['name'])."'), ";
}

Helpers::ExecuteQuery(Helpers::LStrReplace(",","", $sql));

return true;

}


}


/**
** Method to add new properties to a given "post" object for votes related data
**/

function AddOptionsToPost($post){


//get the Comments controller
$comments_c=Helpers::get_controller(COMMENTS);

$post->post_options=$this->GetPostOptions($post->id);

$post->total_votes=$this->total_votes;

$post->likes=empty($post->likes)?array():json_decode($post->likes,true);

$post->comments=$comments_c->GetComments($post->id);

$post->post_votes=$this->user_ids;

$post->total_comments=$comments_c->TotalCount($post->id);

return $post;

}



/**
** Method to reset the default properties 
**/

function ResetProperties(){

	$this->total_votes=0;
	$this->user_ids=array();

}



/**
**  Method to add "post options" array to each element in given array of "post" objects
**/

function AddPostOptions($post){

if(is_array($post)){

foreach($post as $k=>$p){

	$this->ResetProperties();

	$post[$k]=$this->AddOptionsToPost($p);
}

return $post;

}

return $this->AddOptionsToPost($post);

}



/**
** Method to manipulate "options" array before they are saved in database
** It fixes indeces etc.
**/

function FixPostOptionsArray($options_array){

$return=array();

if(!empty($options_array)){

foreach($options_array as $k=>$arr){

	$return[]=array("id"=>$k+1,"name"=>$arr['name']);
}

}

return $return;

}


/**
** Method to get the array containing all the options for a given post
**/

function AllPostOptions($post_id){

$rows=post_poll::model()->findAll("post_id={$post_id}");

if(!empty($rows)){

foreach ($rows as $k=> $row){

$rows[$k]->votes=empty($row->votes)?array():json_decode($row->votes,true);

}

return $rows;

}


return false;

}



/**
** Method to return array containing "post options" for a 
** given post
**/ 

function GetPostOptions($post_id,$uid=false){

//get all the "options" for the given post id
$rows=$this->AllPostOptions($post_id);

if(!empty($rows)){

//get the object of selected Option
$selected_option=$this->SelectedOptionOnPostByObject($rows,helpers::uid($uid));

foreach($rows as $k=>$r){

$rows[$k]->is_selected=!empty($selected_option->option_id) && $selected_option->option_id==$r->option_id;

$rows[$k]->votes_percentage=!$this->total_votes || empty($r->votes)?0: (count($r->votes)*100)/$this->total_votes;

}

}

return empty($rows)?false:$rows;

}



function SelectedOptionOnPostByObject($post_options,$uid){

$return=false;

foreach ($post_options as $k=>$opt){

if(!empty($opt->votes)){

$votes=array_filter($opt->votes);

if(!empty($votes)){ //update the value of total_votes property

foreach($votes as $vote)$this->user_ids[]=$vote;

$this->total_votes+=count($votes);

}


if(!empty($votes) && in_array($uid,$votes)){

$return= $opt;

}

}

}

return $return;

}


/**
** Method to return the option which given user has selected on a given post
**/

function SelectedOptionOnPost($post_id,$uid=false){

//uid
$uid=helpers::uid($uid);

$post_options=$this->PostOptionsArray($post_id);

if($post_options){

return $this->SelectedOptionOnPostByObject($post_options);

}

return false;

}


/**
** Get Post Options array
**/

function PostOptionsArray($post_id){

//get posts
$posts=$this->GetPostOptions($post_id);

return empty($posts)?false:$posts;

}



/**
** Clear voting record for a given post id from the database for a given user 
**/

function CleanVote($post_id,$uid=false){

//fix uid
$uid=helpers::uid($uid);

$posts=$this->PostOptionsArray($post_id);

if($posts){

foreach ($posts as $post){

$votes=$post->votes;

if(!empty($votes)){

$key=array_search($uid,$votes);

if($key!==false){

unset($votes[$key]);

$post->votes=json_encode(array_values($votes));

$post->save();

}


}

}

}

return true;

}



/**
** Method to search Post Options based on the given keyword
**/

function SearchPostOptions($keyword,$offset=0,$limit=10){

//fix the quotes in keyword for SQL queries
$keyword=addslashes($keyword);

$options=post_poll::model()->findAll("option_name like '%{$keyword}%' order by `id` desc limit {$offset}, {$limit} ");

return $options==NULL?false:$options;


}









}







?>