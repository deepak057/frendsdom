<?php

//include system's environment 
include("includes.php");

if(!empty($_GET['tab']))
{

//checking initial limit
$l1=(empty($_GET['start']))? 0 : $_GET['start'];

//number of text blocks per page
$l2=5;

//connecting to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['post_suggestion_db']);

//executing query and displaying content
if($result=$mysqli->query("select * from {$_GET['tab']} order by id limit {$l1},{$l2}"))
{
if($result->num_rows>0){
while($row=$result->fetch_array()){
?>

<div class="ps_block pointer">
<div class="ps_block_text"><?php
echo nl2br($row['text']);
?>
</div><b><?php if(!empty($row['author']))echo "- ".$row['author']; ?></b>
</div>

<?php
}

//putting link to fetch more content
echo "<div class='center more_sps light_text small pointer' content-link='/modules/post_suggestion/quotes/tab_content.php?tab=".$_GET['tab']."&start=".($l1+$l2)."'>More</div>";

}
}
}

else{
header('location:home.php');
}
?>