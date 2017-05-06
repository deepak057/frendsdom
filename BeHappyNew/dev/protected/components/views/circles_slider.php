<ul class="circles-slider-wrap">
  
  <?php

if($circles){

$total_slides=sizeof($circles)/$circles_in_slide;
$circles_left=sizeof($circles)%$circles_in_slide;
if($circles_left>
0){
$total_slides++;
}

for($i=1;$i
<=$total_slides;$i++){

?>
  
  <li class="circle-wrap-li">
    
    <?php

for($j=($i-1)*$circles_in_slide;$j
<$i*$circles_in_slide;$j++) {

if(!empty($circles[$j])){

$this->
widget("Circle",array("circle"=>
$circles[$j]));

}

}

?>
  
  </li>
  
  <?php

}

}

else {
?>

<div class="center point-to-circle-btn italic-text"><h2>You don't have any circles<br/><span class="pointer-origin">Click here to create one</span> <br/> <b>or<b> <br/><a href="<?php echo AppURLs::SearchURL(); ?>?k=&type=<?php echo CIRCLES; ?>"><u>Choose from existing Circles</u></a></h2></div>


<?php

}





?>
  
</ul>