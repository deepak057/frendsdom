<?php


class top_users{

var $id;

function __construct($id=false){

$this->id=$id;

}

function top_users_by_points($limit=10){
$arr=array();
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($result=$mysqli->query("select * from userdata where ".SQL_valid_users()." AND pp_featured_on_top_users=1 ORDER BY CAST(`points` AS SIGNED) DESC limit {$limit}"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array()){
array_push($arr,array(

	"id"=>$row['id'],
	"name"=>$row['first']." ".$row['last'],
	"country"=>$row['country']

	));
}
}
}
return $arr;
}

function doc_content(){

$top_users=$this->top_users_by_points();

?><center>
 <div id = "carousel1" style="width:1000px; height:450px;overflow:scroll;">            
<?php
foreach($top_users as $k=>$tu){
?>
<a href="<?php echo get_profile_url($tu['id']); ?>"><img height="200" width="200" class = "cloudcarousel" src="<?php echo prof_pic($tu['id']) ; ?>" alt="At <?php echo ($k+1); ?>" title="<?php echo $tu['name']; ?>" /></a>
<?php
}
?>
</div></center>
<div class="fp-clr-container">
<img class="pointer" id="left-but" src="images/l1.gif"  />
<img class="pointer" id="right-but" src="images/r1.gif" />
</div>
<div class="fp-cd-container">
<div id="fcc-title-text"></div>
<div id="fcc-alt-text"></div>
</div>
<?php
}
	
function put_dock(){

?>

<script src="js/cloud-carousel.min.js" type="text/javascript"></script>
<script src="js/mousewheel.js" type="text/javascript"></script>
<div class="hp-tu-wrapper" id="hp-tu-wrapper">
<div class="hp-tu-content" id="hp-tu-content">
<?php $this->doc_content(); ?>
</div>
<p class="slide auto-width none"><a href="javascript:void(0);" id="tu-slider" class="btn-slide">Top users</a></p>
</div>
<script>
$("#carousel1").CloudCarousel(		
		{			
			xPos: 500,
			yPos: 80,
			buttonLeft: $("#left-but"),
			buttonRight: $("#right-but"),
			altBox: $("#fcc-alt-text"),
			titleBox: $("#fcc-title-text"),
			bringToFront:true,
			reflHeight:30,
			mouseWheel:true
			
		}
	);

function adjust_tuc(){if($(".hp-tu-wrapper").attr("class").indexOf("full-width")==-1)
$(".hp-tu-wrapper").addClass("full-width");
else 
setTimeout(function(){$(".hp-tu-wrapper").removeClass("full-width");},1000);
}
$("#tu-slider").click(function(){
$("#hp-tu-content").slideToggle("slow",function(){});
$(this).toggleClass("active");
adjust_tuc();			
});

$(".dock-item-img").mouseenter(function(){
$(this).removeClass("dim-h1").addClass("dim-h2");
}).mouseleave(function(){$(this).removeClass("dim-h2").addClass("dim-h1");});

</script>
<?php

}
}
?>