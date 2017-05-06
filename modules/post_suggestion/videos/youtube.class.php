<?php

class youtube extends custom{
	
	
	public $base="http://gdata.youtube.com/feeds/api/",$content=array(),$time;
	

function __construct(){
		
				parent::__construct();
		
		}
	

	
	//method to take response from Youtube and convert it into a simple array

	function simplify_response($response){
		
	foreach($response->feed->entry as $result){
		
		array_push($this->content,array("href"=>$result->link[0]->href,"sthumb"=>$result->mediagroup->mediathumbnail[0]->url,"mthumb"=>$result->mediagroup->mediathumbnail[1]->url,"lthumb"=>$result->mediagroup->mediathumbnail[2]->url,"title"=>$result->title->t,"published"=>$result->published->t,"views"=>$result->ytstatistics->viewCount,"description"=>$result->mediagroup->mediadescription->t,"time"=>$this->time,"v_id"=>$result->mediagroup->ytvideoid->t,"category"=>$result->category[1]->term));
		}
		
	return $this->content;
	
}
	
	
	//method to get response from Youtube
	
	function get_response($url){

	return json_decode(str_replace('$','',$this->execute_query($url)));
		
		}
	
	
	//this method pulls popular videos from Youtube
	
	function get_videos($cat="Sports",$page=1,$time="today",$v_type="most_popular",$results=20){
		
		$this->time=$time;
		
		//pull content
	return $this->simplify_response($this->get_response($this->base."standardfeeds/{$v_type}_{$cat}?v=2&alt=json&time=".$time."&max-results=".$results."&start-index=".$page));
		
		} 
	
	
	//method to get videos related to given video 
	
	function get_related($v_id){
		
		//pull content
	return $this->simplify_response($this->get_response($this->base."videos/{$v_id}/related?alt=json"));
		
		}
		

function get_cats(){

return array("comedy","sports","Entertainment","News","music","trailers","movies");


}

	
	}



?>