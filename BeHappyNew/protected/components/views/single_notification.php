<div class="lv-item single-notification <?php if($notification->seen=="0"){echo "gray_background";} ?>" id="<?php echo "notification-".$notification->id; ?>" notification-id="<?php echo $notification->id; ?>">

				<div class="media">

				<div class="pull-left">
				<a class='a_notifications' href="<?php echo AppURLs::ProfileURL($notification->from); ?>">
					<?php $this->Widget("Profileicon",array("user"=>$notification->user)); ?>
				</a>
				</div>
				
				      <div class="media-body">              
							<p  class="media_body_p"><a class='a_notifications' href="<?php echo AppURLs::ProfileURL($notification->from); ?>"><b><?php echo ucwords(Helpers::get_controller(USERS)->UserName($notification->user)); ?> </b></a>
							<?php
							if($notification->type=="comment")
							{
								echo "commented on your post <a class='a_notifications' notification-id='".$notification->id."' target='_blank' href='".AppURLs::PostURL($notification->post)."'><b  title=".Helpers::GetPostText($notification->post,false)."> \"".Helpers::GetPostText($notification->post,true)."\" </b></a>";
							}
							if($notification->type=="vote")
							{
								echo "voted on your post <a class='a_notifications action_notification' notification-id='".$notification->id."' target='_blank' href='".AppURLs::PostURL($notification->post)."'><b  title=".Helpers::GetPostText($notification->post,false)."> \"".Helpers::GetPostText($notification->post,true)."\" </b></a>";
							}
							if($notification->type=="like")
							{
								echo "likes your post <a class='a_notifications action_notification' notification-id='".$notification->id."' target='_blank' href='".AppURLs::PostURL($notification->post)."'><b  title=".Helpers::GetPostText($notification->post,false)."> \"".Helpers::GetPostText($notification->post,true)."\" </b></a>";
							}
							if($notification->type=="posted")
							{
								echo "added a post to <a notification-id='".$notification->id."'  class='a_notifications' target='_blank' href=".AppURLs::CircleURL(Helpers::get_controller(CIRCLES)->GetCircleId($notification->post))."><b>".ucfirst(Helpers::TruncateTextWithoutReadMore(Helpers::get_controller(CIRCLES)->GetCircleName($notification->post),30,""))."</b></a> circle <a class='a_notifications action_notification' notification-id='".$notification->id."' target='_blank' href='".AppURLs::PostURL($notification->post)."'><b  title=".Helpers::GetPostText($notification->post,false)."> \"".Helpers::GetPostText($notification->post,true)."\" </b></a>";
							}

							 ?></p>
							 <p class="media_body_p">
							 <?php
							 ?>
							 </p>
							 <p class="media_body_p time_p">
							 	<div class="timer_div" time="<?php echo strtotime($notification->time);?>">
							 	<?php
							 		echo helpers::timeAgoFromDate($notification->time);
							 	?>
							 	</div>
							 	<?php if($notification->seen=="0")
							 	{
							 	?>
							 	<a notification-id="<?php echo $notification->id; ?>" href="javascript:void(0)" app-action="mark_as_read" title="Mark as Read" class="action-btn br-50 c-green small c-notification-action">
				                    <i class="md md-check">
				                    </i>
				                </a>
							 	<?php
							 	}
							 	?>
							 			
							 </p>
			          </div>
					
				
			
				</div>

				</div>
	</a>