<?php

$theme_arr=array(

"cyan",
"red",
"orange",
"green",
"purple",
"bluegray",
"pink",
"teal",
"lime",
"gray",
"brown",
"blue",
"yellow",

);


$theme_url=AppURLs::ThemeUrl();


if($post){

?>

<div item-type="post" id="<?php echo "post-".$post->id; ?>" p-id="<?php echo $post->id; ?>" class="circle-post-wrap <?php if(!empty($class)) echo $class; ?> t-view" <?php if($comments_enabled){?> ndata-tv-type="text" <?php }?>
  >
  <div class="tv-header media bgm-<?php echo "cyan";//Helpers::PickRandom($theme_arr); ?>" >
    <a title="<?php echo $user_controller->UserName($creator)." | asker"; ?>" class="tvh-user pull-left" href="<?php echo AppURLs::ProfileURL($creator->id); ?>">
      <img alt="" src="<?php echo $user_controller->ProfilePicUrl($creator); ?>" class="img-responsive">
    </a>
    <div class="media-body p-t-5">
      <strong class="d-block">
       
        <span class="status-supporting-text">
          <a href="<?php echo AppURLs::PostURL($post->id); ?>"><?php echo ucfirst($post->
supporting_text); ?></a>
                                              </span>
                                          </strong>
                                          
                                          <small>
                                            By: <a title="Go to Profile" class="c-white" href="<?php echo AppURLs::ProfileURL($creator->id); ?>"><?php echo $user_controller->UserName($creator)."</a> | ". helpers::AppDate($post->
date_created); ?>
                                          </small>
                                      </div>
                                      
                                      
                                      <?php if ($is_owner && $comments_enabled){

                                      	?>

                                      <ul class="actions post-main-actions m-t-20">
                                        <li class="dropdown">
                                          <a data-toggle="dropdown" href="">
                                            <i class="md md-more-vert">
                                            </i>
                                          </a>
                                          
                                          <ul class="dropdown-menu dropdown-menu-right">
                                            <!--<li>
                                              <a href="#">
                                                Edit
                                              </a>
                                            </li>-->
                                            <li>
                                              <a onclick="DeleteFeedPost.DeletePost($(this))" post-id="<?php echo $post->id ;?>" app-preloader="prepend" class="delete-feed-post" href="javascript:void(0)">
                                                Delete
                                              </a>
                                            </li>
                                          </ul>
                                        </li>
                                      </ul>

                                      <?php
                                  }

                                  ?>





  </div>
  <div class="tv-body">


    <p class="status-content">
      <?php echo Helpers::TruncateText(Helpers::text($post->
content,true,false)); ?>
                                      </p>
<?php

if(!empty($post->post_image)){

	$this->widget("Lightbox",array("image_url"=>AppURLs::PostImageURL($post->post_image)));
}


?>


                                      


<div class="post-options-wrap">
  
<?php $this->widget("Postoptions",array("post"=>$post)); ?>

</div>




                                      <div class="clearfix">
                                      </div>
                                      
                                      
                                      <?php 

if($comments_enabled){


?>
                                      
                                      <ul class="tvb-stats m-t-20">
                                        
                                        <?php $this->Widget("Likepost",array("post"=>$post)); ?>
					<li title="See or leave comments" class="tvbs-comments toogle-post-comments pointer">
                                          <span class="comments-count"><?php if(!empty($post->total_comments)) echo $post->total_comments; ?></span> Comments
                                        </li>
					<?php if($post->total_votes){?>
                                        <li title="Click to see the people who have voted on this Post." post-id="<?php echo $post->id ?>" class="pointer tvbs-views people-voted-trigger">
                                          <?php echo $post->total_votes; ?> Vote<?php if($post->total_votes>1) echo "s"; ?>
                                        </li>
					<?php } ?>
                                    <li post-id="<?php echo $post->id; ?>" class="pointer tvbs-likes share-post-btn" title="Share this post on social networks">
                                      <i class="md md-share"></i>
                                      
                                    </li>

                                      </ul>
                                      
					<!--<a href="javascript:void(0)" class="tvc-more">
                                        <i class="md md-mode-like">
                                        </i>
                                        View all 54 Likes
                                      </a>
	
                                      <a href="javascript:void(0)" class="tvc-more toogle-post-comments">
                                        <i class="md md-mode-comment">
                                        </i>
                                        View all 54 Comments
                                      </a>-->
                                      
                                      <?php 

}

?>
                                      
                                      
  </div>
  
  <?php 

if($comments_enabled){

$this->widget("Postcomments",array("post"=>$post));


?>
  
  
  <!--<div class="tv-comments post-comments-wrap" style="display:none">
    <ul class="tvc-lists">
      <li class="media">
        <a class="tvh-user pull-left" href="">
          <img alt="" src="<?php echo $theme_url;?>/img/1_002.jpg" class="img-responsive">
        </a>
        <div class="media-body">
          <strong class="d-block">
            David Peiterson
          </strong>
          <small class="c-gray">
            April 23, 2014 at 05:10
          </small>
          
          <div class="m-t-10">
            Maecenas fermentum tellus ex, ac aliquet nisl malesuada id.
          </div>
          
        </div>
      </li>
      
      <li class="media">
        <a class="tvh-user pull-left" href="">
          <img alt="" src="<?php echo $theme_url;?>/img/2_002.jpg" class="img-responsive">
        </a>
        <div class="media-body">
          <strong class="d-block">
            Wernall Parnell
          </strong>
          <small class="c-gray">
            April 22, 2014 at 13:00
          </small>
          
          <div class="m-t-10">
            Nulla
            vehicula erat nec odio dignissim, sit amet porttitor lorem auctor. 
            Maecenas fermentum tellus ex, ac aliquet nisl malesuada id.
          </div>
          
        </div>
      </li>
      
      <li class="media">
        <a class="tvh-user pull-left" href="">
          <img alt="" src="<?php echo $theme_url;?>/img/3_002.jpg" class="img-responsive">
        </a>
        <div class="media-body">
          <strong class="d-block">
            Shane Lee Yong
          </strong>
          <small class="c-gray">
            April 19, 2014 at 10:10
          </small>
          
          <div class="m-t-10">
            Sit amet porttitor lorem auctor. Maecenas fermentum tellus ex, ac aliquet nisl malesuada idwoon lorem ipsum.
          </div>
        </div>
      </li>
      
      <li class="p-20">
        <div class="fg-line">
          <textarea placeholder="Write a comment..." class="form-control auto-size" style="overflow: hidden; word-wrap: break-word; height: 33px;">
          </textarea>
        </div>
        
        <button class="m-t-15 btn btn-primary btn-sm waves-effect waves-button waves-float waves-effect waves-button waves-float">
          Post
        </button>
      </li>
    </ul>
    
  </div>-->
  <?php
}

?>
  
</div>

<?php

}

?>