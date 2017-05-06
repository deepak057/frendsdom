 <?php

 if($user){

$user_c=Helpers::get_controller(USERS);

 ?>

 <div item-type="user" class="col-md-3 col-sm-4 col-xs-4 ppl-list-person widget-item">


                                        <div class="c-item">
                                            <a class="ci-avatar" href="<?php echo AppURLs::ProfileURL($user->id); ?>">
                                        <img alt="<?php echo $user_c->UserName($user); ?>" src="<?php echo $user_c->ProfilePicURL($user); ?>" class="img-responsive">
                                            </a>
                                            
                                            <div class="c-info p-b-10">
                                                <strong><a class="c-black" href="<?php echo AppURLs::ProfileURL($user->id); ?>"><?php echo $user_c->UserName($user); ?></a></strong>
                                                <!--<small>cathy.shelton31@example.com</small>-->
                                            </div>
                                            
                                            <!--<div class="c-footer">
                                                <button class="waves-effect"><i class="md md-person-add"></i> Add</button>
                                            </div>-->
                                        </div>
                                    </div>

                                    <?php

                                }

                                ?>