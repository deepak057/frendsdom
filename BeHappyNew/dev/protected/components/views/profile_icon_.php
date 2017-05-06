<div title="<?php echo ucwords($user->name);?>" class="circle-icon m-r-5 bgm-teal" <?php 

	if(!empty($user->profile_pic)){?>style="background:url(<?php echo Directories::PathProfilePicture($user->profile_pic); ?>)"<?php } ?>></div>
