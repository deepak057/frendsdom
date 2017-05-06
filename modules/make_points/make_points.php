<?php


class make_points{

var $id,

//allowed failed attempts
$failed_attempts=3,

//time 
$time_limit=30,

//points to add on right drop
$points_to_add=1,

//points to deduce on wrong drops
$points_to_deduce=1,

//maximum points that can be made
$max_points=5;


function __construct($id){

$this->id=$id;
$this->table=$GLOBALS['tbl_key_id_mapping'];

}


function get_strangers($limit=5){


//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);

//sql query
$sql="select `id`,`first`,`last` from userdata where `picture`='yes' && `account_status`='open' && `id` NOT IN(".implode(",",get_total_rel($this->id,true)).") order by RAND() limit {$limit}";

//array to hold final results
$arr=array();


if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{

$arr[]=array("key"=>get_unique_key($row['id']),"id"=>$row['id'],"name"=>$row['first']." ".$row['last']);

}
}
}

$this->save_keys($arr);

return $arr;

}


function save_keys($arr){

$str='';

foreach ($arr as $k=>$item ){

$str.="('{$item['key']}',{$item['id']},'".get_date_time()."')".(($k+1)<sizeof($arr)?",":"");

}

//form query
$q="insert into {$this->table} (`key`,`user_id`,`date`) values ".$str;

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['other_data_db']);

//execute query
$mysqli->query($q);

}


function put_users($limit=5){

$users=$this->get_strangers($limit);
?>

<div class="hp-mp-des">

<h3>How to earn points</h3>

<ol>
<li>You will be shown pictures of five random users. </li>
<li>Drag the picture and drop it next to the name you think belongs to it.</li>
<li>For every correct match you'll get one point.</li>
<li>For every <?php echo $this->failed_attempts; ?> wrong drops you'll get one point deducted.</li>
<li>You've got <?php echo $this->time_limit; ?> seconds to complete this task.</li>

</ol>

<div class="right mp-start-btn">
<img class="pointer" src="images/start.gif"/>
</div>


</div>



<div class="hp-mp-content none">

<div class="right hp-mp-counter-cont" >
 You've got 
<span id="mp-scounter"></span> seconds

</div>


<ul id="hp-mp-top">

<?php

foreach($users as $user){
?>

<li id="<?php echo $user['key']; ?>" class="hp-mp-pic"><img class="mp-user-key-pic" key="<?php echo $user['key']; ?>" src="<?php echo get_thumb_2($user['id'],"200","200"); ?>"/></li>


<?php


}

?>

</ul>


<div class="clear"></div>

<div id="hp-mp-bottom" class="hp-mp-btm none">


<ul>

<?php

shuffle($users);

foreach($users as $k=>$user){
?>

<li class="center">

<div id="<?php echo $user['key']; ?>-target" class="hp-mp-target"></div>

<div>
<?php echo $user['name']; ?>
</div>

</li>


<?php


}
?>

</ul>


</div>


</div>

<?php

$this->put_mp_conf();

}


function put_mp_conf(){
?>
<script type="text/javascript">var mp_conf={};mp_conf['time_limit']=<?php echo $this->time_limit; ?>;mp_conf['failed_attempts']=<?php echo $this->failed_attempts; ?>;mp_conf['mp_wrong_drops']=mp_conf['points_made']=0;mp_conf['points_to_add']=<?php echo $this->points_to_add; ?>;mp_conf['points_to_deduce']=<?php echo $this->points_to_deduce; ?>;mp_conf['max_points']=<?php echo $this->max_points; ?>;mp_conf['timer']=null;</script>
<?php

}



}



?>