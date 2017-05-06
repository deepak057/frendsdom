<?php

$n=12/$cols;


for( $i=0;$i<$cols;$i++){

?>

<div class="col-sm-<?php echo $n; ?> post-feed-coulmn">

<?php

if(!empty($content[$i])){

foreach ($content[$i] as $post){

$this->widget("Post",array("post"=>$post,"comments_enabled"=>true));

}

}


?>

</div>

<?php

}


?>