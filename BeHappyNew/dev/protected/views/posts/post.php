<?php

if($post){

?>
<div class="left">
<ol class="breadcrumb p-l-10">
            <li><a href="<?php echo Helpers::base_url(); ?>">Home</a></li>
            <li><a title="Circle: <?php echo Helpers::text($circle->title); ?>" href="<?php echo AppURLs::CircleURL($circle->id); ?>"><?php echo Helpers::text($circle->title);  ?></a></li>
            <li class="active">post</li>
        </ol>
        </div>

<div class="card p-b-10">

<div class="card-body card-padding">

<?php

$this->Widget("Post",array("post"=>$post,"options"=>array(

		"comments_enabled"=>true,
		"class"=>Helpers::CoulmnClass(1)." m-b-10",

		)));

?>
</div>
<div class="clearfix">
</div>

<?php

}

else {

?>


<div class="alert alert-danger">Sorry, post not found.</div>



<?php


}

?>