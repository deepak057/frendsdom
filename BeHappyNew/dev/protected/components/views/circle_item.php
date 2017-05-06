 <?php

 if($circle){

 ?>

 <div cid="<?php echo $circle->id; ?>" item-type="circle" class="col-md-3 col-sm-6 col-xs-6 widget-item circle-show-line">


                                        <div class="c-item">

                                        <div class="center m-t-20">
                                            <?php 

                                            $this->widget("Circleicon",array("circle"=>$circle));

                                            ?>
                                            </div>
                                            <div class="c-info p-b-10">
                                                <strong><a class="c-black" href="<?php echo AppURLs::CircleURL($circle->id); ?>"><?php echo $circle->title; ?></a></strong>
                                                <!--<small>cathy.shelton31@example.com</small>-->
                                            </div>
                                            
                                          <div class="c-footer">
                                               
                                               <?php

                                               if($is_member){

                                                ?>

                                                <button class=' cursor-default c-green'><i class='md md-check'></i> Joined</button>

                                             <!--   <div class="center circle-item-joined bold c-green"><i class="md md-check"></i> Joined</div>-->

                                                <?php

                                               } 

                                               else {


                                                ?>

                                                <button class="waves-effect join-circle-btn"><i class="md md-person-add"></i> Join</button>
                                            
                                                    <?php

                                                }

                                                ?>

                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                }

                                ?>