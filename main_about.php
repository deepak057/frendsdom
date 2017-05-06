<?php

$images_root="images/main_page/";


$btns=array(

"Mission",
"How you benefit",
"What it does?",
"How it is different?",
"Advantages"

);



$content=array(


array(

"text"=>"Frendsom's mission is to get you across as many unknown people as possible so that
you'll have people from all around the world personally knowing you.",

"image"=>"mission.JPG"

),


array(

"text"=>"You will meet strangers whom you might turn into relations, share your experience, know theirs and expand your world.",

"image"=>"2.JPG"

),


array(

"text"=>"In short, it offers an opportunity to help you personally know those you don't currently

know but always wanted to know (on region/country/race level). 
",

"image"=>"3.JPG"

)


,


array(

"text"=>"The other existing social networks provide great features to help you stay in touch with 
those you already know but they don't encourage you to know those beyond your acquaintance zone. ",

"image"=>"5.JPG"

)



,


array(

"text"=>"Since people of different race/language get to know each other, the level of their sophistication rises. It can help people calm their curiosity down about people of other race/country/language.",
"image"=>"4.JPG"

)





);




?>


<div class="abt-btn-container">


<button class="blue-btn blue-btn-active main-abt-close-btn" title="Close" onclick="about_close();">&#215;</button>


<?php

foreach ($btns as $k=>$btn){
?>

<button class="main-abt-btn blue-btn <?php if($k==0) echo 'blue-btn-active'; ?>" scroll-to="#main-block-<?php echo $k; ?>"><?php echo $btn; ?></button>

<?php
}


?>




</div>


<div class="abt-container">


<div class="abt-content-width">



<?php


foreach ($content as $k=>$block){
?>

<div class="main-abt-block" id="main-block-<?php echo $k; ?>">
<div class="about-text-heading">
<p><h2><?php echo $block['text']; ?> 
</h2>
</p>
</div>
<div>
<img class="poster" src="<?php echo $images_root.$block['image']; ?>"/>
</div>
</div>


<?php

}



 ?>



</div>

</div>
