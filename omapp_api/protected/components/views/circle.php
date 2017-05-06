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



if($circle){

?>
<div circle-url="<?php echo AppURLs::CircleURL($circle->id); ?>" cid="<?php echo $circle->id; ?>"  style="<?php if(!empty($circle->circle_image)){?> background:url(<?php echo AppURLs::CircleImageURL($circle->circle_image); ?>); <?php } ?>"  class="app-circle bgm-<?php echo "cyan"; //Helpers::PickRandom($GLOBALS['app_config']['colors']); ?>">

<?php if(!empty($circle->circle_image)){?>

<div class="circle-overlay"></div>

<?php
}

?>


<div class="app-circle-content">




<span class="app-circle-title <?php if(!empty($circle->circle_image)){ ?>hide-on-circle-active<?php } ?>"><?php echo $circle->title; ?></span>

<ul class="actions actions-alt circle-actions none pull-right">
                <li class="dropdown">
                  <a data-toggle="dropdown" href="" >
                    <i class="md md-more-vert">
                    </i>
                  </a>
                  
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                      <a app-preloader="prepend" onclick="InvitePeopleToCircle.LoadInit($(this));" class="manage-circle-trigger" cid="<?php echo $circle->id; ?>" href="javascript:void(0)">
                        Add people
                      </a>
                    </li>
                    
                    
                    <li>
                      <a cid="<?php echo $circle->id; ?>" app-preloader="prepend" onclick="CircleSettings.RemoveImageTrigger($(this));" href="javascript:void(0);">
                        Settings
                      </a>
                    </li>

                   
                  </ul>
                </li>
              </ul>
              
              
</div>

<span class="main-circle-posts-count bgm-red d-hidden">0</span>


</div>
<?php

}

?>