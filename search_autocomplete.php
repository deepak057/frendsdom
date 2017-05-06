<?php

//preventing direct access to this script
if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
{
header('location:home.php');
exit('');
}

error_reporting(E_ERROR);
include("environment.php");

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
$searchTerm = $_GET['searchTerm'];
if(!$sidx) $sidx ="id";
if ($searchTerm=="") {
	$searchTerm="%";
} else {
	$searchTerm = "%" . $searchTerm . "%";
}

//manipulating search term string
$query=entryfordatabase("%".$_GET['searchTerm']."%");

// connect to the database
$db = mysql_connect($host, $db_user,$db_passwd) or die("Connection Error");
mysql_select_db($selected_db) or die("Error conecting to db.");
$result = mysql_query("SELECT COUNT(*) AS count FROM userdata WHERE account_status='open' AND to_be_found_on_search=1 AND ( $query LIKE concat('%', first, '%') AND $query LIKE concat('%', last, '%') || first like '$searchTerm' || last like '$searchTerm' || country like '$searchTerm' || state like '$searchTerm' || city like '$searchTerm' || user_id like '$searchTerm') ");
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
if($total_pages!=0) $SQL = "SELECT * FROM userdata where account_status='open' AND to_be_found_on_search=1 AND ( $query LIKE concat('%', first, '%') AND $query LIKE concat('%', last, '%') || first like '$searchTerm' || last like '$searchTerm' || country like '$searchTerm' || state like '$searchTerm' || city like '$searchTerm' || user_id like '$searchTerm') ORDER BY $sidx $sord LIMIT $start , $limit";
else $SQL = "SELECT * FROM userdata where account_status='open' AND to_be_found_on_search=1 AND ( $query LIKE concat('%', first, '%') AND $query LIKE concat('%', last, '%') || first like '$searchTerm'  || last like '$searchTerm' || country like '$searchTerm' || state like '$searchTerm' || city like '$searchTerm' || user_id like '$searchTerm' ) ORDER BY $sidx $sord";
$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error());
$response->page = $page;
$response->total = $total_pages;
$response->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
/*
    $response->rows[$i]['id']=$row[id];
    $response->rows[$i]['cell']=array($row[id],$row[invdate],$row[name],$row[amount],$row[tax],$row[total],$row[note]);
*/  
    $t="'".prof_pic($row['id'])."' height='160' width='160'";
    $response->rows[$i]['name']='<div class="inline" title="&lt;img src='.$t.' /&gt;"><img src="'.$row['sex'].'.gif" height="20" width="20" align="middle"/>'.$row['first'].'</div>';
    $response->rows[$i]['country']=$row['country'];
    $response->rows[$i]['state']=$row['state'];
	$response->rows[$i]['city']=$row['city'];
        $response->rows[$i]['link']=get_profile_url($row['id']);
    //$response->rows[$i]=array($row[id],$row[invdate],$row[name],$row[amount],$row[tax],$row[total],$row[note]);
    $i++;
}        
echo json_encode($response);
?>
