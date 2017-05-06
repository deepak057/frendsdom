<a href="<?php echo AppURLs::CircleURL($circle->id); ?>"><div title="<?php echo ucwords($circle->title);?>" class="circle-icon m-r-5 bgm-teal" <?php 

	if(!empty($circle->circle_image)){?>style="background:url(<?php echo AppURLs::CircleImageURL($circle->circle_image); ?>)"<?php } ?>></div></a>
