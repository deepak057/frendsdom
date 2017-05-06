<?php



if(!empty($post->post_options)){

foreach ($post->post_options as $k=>$opt){

?>


<div class="post-option-bar-wrap m-b-5">


<div class="checkbox media">
                                    <div class="pull-right">
                                        
						
						<ul class="actions <?php if(empty($opt->is_selected)) echo 'd-hidden';  ?> ">
                                            <li class="dropdown">
                                                <a class="bgm-eee br-50" data-toggle="dropdown" href="">
                                                    <i class="md md-more-vert"></i>
                                                </a>
                                                
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a post-id="<?php echo $post->id; ?>" app-preloader="prepend" onclick="CheckPostOption.CancelVote($(this));" href="javascript:void(0);">Un-vote</a></li>
                                                    
                                                </ul>
                                            </li>
                                        </ul>

					
			
                                    </div>
                                    <div class="media-body">
                                        <label>
                                            <input class="none" <?php if(!empty($opt->is_selected) && $opt->is_selected) echo "checked"; ?> post-id="<?php echo $post->id; ?>" value="<?php echo $opt->option_id; ?>" type="radio" name="post_<?php echo $post->id; ?>">
                                            <i class="input-helper"></i>
                                            <span class="post-option-label"><?php echo $opt->option_name; ?></span>
                                        </label>


                                            <?php  if($opt->votes_percentage) {?>

                                                <div class="progress m-t-5">
                                                        <div style="width: <?php echo $opt->votes_percentage; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="14" role="progressbar" class="progress-bar bgm-<?php echo $colors[$k]; ?>">
                                                        </div> 
                                                    </div><small class="pull-right vote-percentage-elm <?php if(round($opt->votes_percentage)>=100) echo " po-100-p "; ?> c-<?php echo $colors[$k]; ?>"><?php if($opt->votes_percentage) echo round($opt->votes_percentage)."%"; ?></small>


                                                       <?php

                                                       }

                                                       ?> 


                                    </div>

                                </div>


</div>

<?php 

}

}


?>