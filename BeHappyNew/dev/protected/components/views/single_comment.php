<?php $theme_url=AppURLs::ThemeUrl();?>
<li comment-id="<?php echo $comment->id; ?>" class="media single-comment-wrap">

        <a title="<?php echo $user_controller->UserName($creator); ?>" class="tvh-user pull-left" href="<?php echo AppURLs::ProfileURL($creator->id); ?>">
          <img alt="<?php echo $user_controller->UserName($creator); ?> " src="<?php echo $user_controller->ProfilePicUrl($creator); ?>" class="img-responsive">
        </a>

<?php if($is_owner){

?>

                                      <ul class="actions pull-right">
                                        <li class="dropdown">
                                          <a class="bgm-eee br-50" aria-expanded="false" data-toggle="dropdown" href="">
                                            <i class="md md-more-vert">
                                            </i>
                                          </a>
                                          
                                          <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                              <a onclick="EditComment.EditComment($(this))" comment-id="<?php echo $comment->id ?>" href="javascript:void(0)">
                                                Edit
                                              </a>
                                            </li>
                                            <li>
                                              <a onclick="Comments.DeleteComment($(this))" comment-id="<?php echo $comment->id ?>" app-preloader="prepend" class="delete-post-comment" href="javascript:void(0)">
                                                Delete
                                              </a>
                                            </li>
                                          </ul>
                                        </li>
                                      </ul>

<?php } ?>


        <div class="media-body">
          <strong class="d-block">
            <a title="Go to Profile" class="c-default" href="<?php echo AppURLs::ProfileURL($creator->id); ?>"> <?php echo $user_controller->UserName($creator); ?>
          </a></strong>
          <small class="c-gray">
            <?php echo helpers::AppDate($comment->date); ?>
          </small>



          
          <div class="m-t-10 comment-div" >
            <?php echo Helpers::Text($comment->comment_text); ?>
          </div>
         
          <div class="m-t-10 none edit-comment-wrap">


          <form comment-id="<?php echo $comment->id; ?>" class="edit-comment-form">
            <div class="input-group">
              <textarea class="edit-comment-text form-control w-100" ><?php echo Helpers::Text($comment->comment_text,false); ?></textarea>
            </div> 
            <div class="input-group m-t-10">
              
              <button type="submit" class="edit-comment-submit btn btn-primary btn-xs m-r-5">Save</button>
              <input type="button" class="edit-comment-cancel btn btn-default btn-xs" value="Cancel">

            </div>
          </form>

         
          
          </div>
      </li>