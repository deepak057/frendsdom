<div class="lv-item single-invite" id="<?php echo "invite-".$invite->id; ?>" invite-id="<?php echo $invite->id; ?>">

				<div class="media">

				<div class="pull-left">

				<?php $this->Widget("Circleicon",array("circle"=>$invite->circle)); ?>
				
				</div>

				
				
				<div class="media-body">
                                                <div class="lv-title"><a href="<?php echo AppURLs::ProfileURL($invite->from_id); ?>"><?php echo helpers::get_controller(USERS)->UserName($invite->from_id); ?></a></div>
                                                <small class="lv-small">Invited you to join <a href="<?php echo AppURLs::CircleURL($invite->circle->id); ?>"><?php echo $invite->circle->title; ?></a>.</small>
                                            

<div >
			

<a invite-id="<?php echo $invite->id; ?>" href="javascript:void(0)" app-action="accept" title="Accept this invite" class="action-btn br-50 c-green small c-invite-action">
                    <i class="md md-check">
                    </i>
                  </a>			
                   &nbsp;

<a invite-id="<?php echo $invite->id; ?>" href="javascript:void(0)" app-action="reject"  title="Reject this invite" class="action-btn br-50 c-red small c-invite-action">
                    <i class="md md-close">
                    </i>
                  </a>
			
</div>
			
			</div>
				
				
			
				</div>

				</div>
