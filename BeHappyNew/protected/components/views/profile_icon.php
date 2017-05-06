<div title="<?php echo ucwords($user->name);?>" class="circle-icon m-r-5" <?php 

	if(!empty($user->profile_pic)){?>style="background:url(<?php echo Helpers::get_controller(USERS)->ProfilePicUrl($user); ?>)"<?php }
	else
	{
		?>style="background:url(<?php echo Helpers::get_image("nopic.png"); ?>)"<?php
	}
	 ?>></div>
