<?php $theme_url=AppURLs::ThemeUrl(); ?>
<div class="tv-comments post-comments-wrap" <?php if(empty($post->comments)){?> style="display:none;" <?php } ?> >
    <ul class="tvc-lists post-comments-container">



 <li class="p-20"><div class="post-comment-wrap">
        <div class="fg-line">
          <textarea placeholder="Write a comment..." class="form-control auto-size post-comment-text" ></textarea>
        </div>
        
        <button p-id="<?php echo $post->id; ?>" class="m-t-15 btn btn-primary btn-sm waves-effect waves-button waves-float waves-effect waves-button waves-float post-comment-button">
          Post
        </button></div>
      </li>



	<?php


	if(!empty($post->comments)){

	foreach($post->comments as $comment){

	$this->Widget("SingleComment",array("comment"=>$comment));

	}
	
	}


	?>
     
    </ul>
    <?php if($enable_view_all) {?>
<a title="Click to load all the comments" post-id="<?php echo $post->id; ?>" href="javascript:void(0)" app-preloader="append" class="tvc-more c-gray m-l-10 m-b-10 hover_highlight load-all-comments">
                                        <i class="md md-mode-comment">
                                        </i>
                                        View all Comments
                                      </a>

                                      <?php } ?>

  </div>
