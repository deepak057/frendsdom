 <?php

 if($post){

 ?>

 <div item-type="post" class="col-md-3 col-sm-4 col-xs-4 widget-item">


                                        <div class="c-item">
                                            <!--<a class="ci-avatar" href="<?php echo AppURLs::PostURL($post->id); ?>">
                                        
                                            </a>-->
                                            
                                            <div class="c-info">
                                                <strong><a class="c-black" href="<?php echo AppURLs::PostURL($post->id); ?>"><?php echo Helpers::text($post->supporting_text); ?></a></strong>
                                                <div><?php echo Helpers::text($post->content); ?></div>
                                                <!--<small>cathy.shelton31@example.com</small>-->
                                            </div>
                                            
                                            <div class="c-footer">
                                                <button class="waves-effect"><i class="md md-person-add"></i> Add</button>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                }

                                ?>