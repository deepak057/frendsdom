<div class="prof-pic-widget pmo-pic">
                                <div class="p-relative">

                                <div <?php if($own_profile) echo 'action-mobile-exception="true"'; ?> class="user-profile-pic-div lightgallery-init pointer">
                                        
                                       <img data-src="<?php echo Helpers::get_controller(USERS)->ProfilePicURL($user); ?>" alt="picture" src="<?php echo Helpers::get_controller(USERS)->ProfilePicURL($user); ?>" id="profile-page-user-pic" class="img-responsive">
                            
</div>

                                    <?php  $this->widget("Sendmessage",array("user"=>$user)); ?>
                                    
                                       
<?php if($own_profile){ ?>
                                   <div class="pmop-edit" >
                                        <div class="update-prof-pic-trigger pointer"><i class="md md-camera-alt"></i> <span class="hidden-xs">Update Profile Picture</span></div>
 <?php 

if(!empty($user->profile_pic)){

?>

<div class="pointer remove-prof-pic">                              
 <i class="md md-close"></i> <span class="hidden-xs">Remove Profile Picture</span></div>

<?php

}
?>


                                    </div>

<?php } ?>
                                    

                                </div>
                                
                                
                                <div class="pmo-stat">
                                    <h2 class="m-0 c-white"><?php echo $circles_count; ?></h2>
                                    Total Circles
                                </div>
                            </div>