<?php

/*
*This file contains methods required to render picture grid on website's welcome page using jQuery's plugin Flex
*Depends upon- functionlist.php, class_lib.php
*Author- Deepak Mishra
*/

class pic_grid{

function get_grid_attr($n){

$bg='bg="gp'.$n.'"';

switch($n)
{
case 0:
return  $bg.' style="left:0px;top:0px;width:250px;height:125px;" width="400" height="275"';
break;
case 1:
return $bg.' style="left:260px;height:100px;top:0px;width:125px;" width="250" height="240"';
break;
case 2:
return $bg.' style="left:395px;height:125px;top:0px;width:200px;" width="200" height="250"';
break;
case 3:
return $bg.' style="left:0px;height:150px;top:135px;width:75px;" width="225" height="240"';
break;
case 4:
return $bg.' style="left:260px;height:75px;top:110px;width:125px;" width="200" height="200"';
break;
case 5:
return $bg.' style="left:85px;height:150px;top:135px;width:165px;" width="250" height="240"';
break;
case 6:
return $bg.' style="left:395px;height:150px;top:135px;width:75px;" width="125" height="275"';
break;
case 7:
return $bg.' style="left:480px;height:150px;top:135px;width:115px;" width="175" height="200"';
break;
case 8:
return $bg.' style="left: 260px;height:90px;top:195px;width: 125px;" width="200" height="250"';
break;
case 9:
return $bg.' style="left: 0px;height:110px;top:295px;width: 125px;" width="200" height="250"';
break;
case 10:
return $bg.' style="left: 135px;height:110px;top:295px;width: 255px;" width="255" height="250"';
break;
case 11:
return $bg.' style="left: 400px;height:110px;top:295px;width: 195px;" width="195" height="250"';
break;
break;
case 12:
return $bg.' style="left: 0px;height:100px;top:415px;width: 350px;" width="500" height="250"';
break;
case 13:
return $bg.' style="left: 360px;height:100px;top:415px;width:235px;" width="300" height="250"';
break;

case 14:
return $bg.' style="left:607px;height:200px;top:0px;width:215px;" width="300" height="280"';
break;

case 15:
return $bg.' style="left: 607px;height:100px;top:210px;width:215px;" width="300" height="250"';
break;

case 16:
return $bg.' style="left: 607px;height:194px;top:320px;width:215px;" width="340" height="250"';
break;

case 17:
return $bg.' style="left: 835px;height:250px;top:0px;width:130px;" width="250" height="250"';
break;

case 18:
return $bg.' style="left: 835px;height:252px;top:260px;width:130px;" width="250" height="250"';
break;

}
}


function get_latest_users($limit=19){

$arr=array();
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);

if($result=$mysqli->query("select * from userdata where ".SQL_valid_users()." AND pp_featured_on_landing_page=1 order by created desc limit {$limit}"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
array_push($arr,array("id"=>$row['id'],"name"=>$row['first']." ".$row['last'],"country"=>$row['country']));
}
}
}
return $arr;
}


//function to put latest user's picture grid
function put_new_users_grid($total=19){

$users=$this->get_latest_users($total);

echo '<style type="text/css">';

//defining css rules for grid
foreach($users as $k=>$user){
?>
[bg=gp<?php echo $k; ?>] {background-image:url(<?php echo prof_pic($user['id']);?>);<?php if($k==0)echo "background-size:250px"; ?>}
<?php
}
echo "</style>
<div class='flex'>";
foreach($users as $k=>$user){
?>
<a itemscope itemtype ="http://schema.org/person" itemprop="contactPoint" title="<?php echo $user['name']." from ".$user['country'];?>" href="<?php echo get_profile_url($user['id']); ?>" <?php echo $this->get_grid_attr($k); ?>> </a>

<?php
}

echo "</div>";
?>
<script type="text/javascript">
$(function() {
	    $(".flex").flex();
	});
</script>
<?php
}
}

?>