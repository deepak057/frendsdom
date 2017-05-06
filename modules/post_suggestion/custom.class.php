<?php


//connecting to cache  

$db = NewADOConnection('mysql');
$db->Connect($GLOBALS['host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'],$GLOBALS['cache_db']);




/*
*This class is used to cache the content pulled from third parties
*By default it refreshes the content once in an hour 
*/

class custom {
	
	private $cache_table,$queries=array(),$response;
	
	function __construct($load_cache=true){
		
		
		$this->cache_table="cache";
		

if($load_cache){
		

		//storing into array the time cache was last updated
		global $db;
		
		$results=$db->Execute("select `query`,`updated` from {$this->cache_table}");
foreach($results as $result){
	array_push($this->queries,array("query"=>$result['query'],"updated"=>$result['updated']));
	
	}
		
}		
		}
	
	
	function execute_query($query,$hours=1){
		
		
	$temp=searchSubArray($this->queries,"query",$query);
		
		/*if the cache is an hour old, pull the fresh content and refresh it*/
		
		if (strtotime($temp['updated']) <= strtotime("-{$hours} hours"))
   		 $this->response=$this->get_from_remote_source($query);
 		else 
    	 $this->response=$this->get_from_cache($query);

		
		return $this->response;
	
	
	}
	
	function get_from_remote_source($query){
		
		$content=get_remote_content($query);
		
		//cache this news
		$this->cache_news($query,$content);
		
		return $content;
		
		}
	
	
	function get_from_cache($query){
		
		global $db;
		
		$results=$db->Execute("select `content` from {$this->cache_table} where query='{$query}' ");
		
		foreach($results as $result){
			
		return $result[0];
	
			
			}

		}
	
	
	function cache_news($query,$content){
		
		global $db;
		
		$db->Execute("INSERT INTO {$this->cache_table} (`query`,`content`,`updated`) VALUES ('".mysql_real_escape_string($query)."','".mysql_real_escape_string($content)."','".date("Y-m-d H:i:s")."') ON DUPLICATE KEY update content='".mysql_real_escape_string($content)."', updated='".date("Y-m-d H:i:s")."'");
		

		}
	
	
	
	
}


?>