<div class="form-wizard-basic fw-container">
                                <ul class="tab-nav text-left fw-nav" style="overflow: hidden;" tabindex="11">
                                   <!-- <li class="active"><a data-toggle="tab" href="#tab1" aria-expanded="true">Introduction</a></li>-->
                                    <li class=""><a data-toggle="tab" href="#tab2" aria-expanded="true">Join Circles</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab3" aria-expanded="false">Finish</a></li>
                                    
                                </ul>
                                
                                <div class="tab-content">
                                   <!-- <div id="tab1" class="tab-pane fade active in">                                        
                                        <p>
                                          
                                            Hello <?php echo Ucwords(Helpers::get_controller(USERS)->UserName($user)); ?>, Welcome to <?php echo Yii::app()->name; ?>.
                                        </p>

					
                                      
                                    </div>-->
                                    <div id="tab2" class="tab-pane fade active in">

	 <p> Hello <?php echo Ucwords(Helpers::get_controller(USERS)->UserName($user)); ?>, Welcome to <?php echo Yii::app()->name; ?>.
	
					Join a few Circles of your interest and see updates.
					</p>
                                        
<div class="contacts clearfix row">


<?php

if(!empty($global_circles)){

foreach($global_circles as $circle){

$this->widget("Circleitem",array("circle"=>$circle));

}

}



?>


</div>
                                    


</div>
                                    <div id="tab3" class="tab-pane fade">
                                    <p>Great, if you joined any Circles, they will be available on your Dashboard. Just click on any Circle to see updates.</p>


                                    <p>You may close this popup now.</p>
                                       
                                    </div>
                                    <div id="tab4" class="tab-pane fade ">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus purus sapien, cursus et egestas at, volutpat sed dolor. Aliquam sollicitudin dui ac euismod hendrerit. Phasellus quis lobortis dolor. Sed massa massa, sagittis nec fermentum eu, volutpat non lectus. Nullam vitae tristique nunc. Aenean vel placerat augue. Aliquam pharetra mauris neque, sit amet egestas risus semper non. Proin egestas egestas ex sed gravida. Suspendisse commodo nisl sit amet risus volutpat volutpat. Phasellus vitae turpis a elit tincidunt ornare. Praesent non libero quis libero scelerisque eleifend. Ut eleifend laoreet vulputate.</p>
                                    </div>
                                    <div id="tab5" class="tab-pane fade">
                                        <p>Cras mattis vulputate lacus sed aliquet. Pellentesque ultricies lectus ut augue tincidunt volutpat. Quisque lorem lectus, vulputate et feugiat ac, tincidunt eu neque. Suspendisse et dignissim ex. Praesent finibus vestibulum faucibus. Vestibulum scelerisque aliquam eros, id tincidunt lacus interdum eu. Praesent molestie leo sed varius tempus. Etiam quis turpis eget diam aliquet congue ut non risus. In sed sapien placerat, fermentum odio id, sagittis magna. Donec sollicitudin ipsum eget pretium tincidunt. Mauris venenatis metus a turpis eleifend, vitae tincidunt nunc tristique. Nulla facilisi. In hac habitasse platea dictumst. Curabitur auctor nibh eget mauris iaculis, id tempor ex egestas. Proin nisl diam, malesuada quis ipsum vitae, tincidunt efficitur neque. Nam suscipit magna ac nisl ornare lobortis.</p>
                                    </div>
                                    <div id="tab6" class="tab-pane fade">
                                        <p>Nunc gravida hendrerit turpis a iaculis. Aenean tempus bibendum augue at tempor. Vestibulum nec ligula elementum nisi viverra mattis ac in nibh. Cras eu elementum massa. Integer cursus quam maximus, ornare ex at, bibendum dui. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus quis eleifend turpis, eget luctus felis.</p>
                                    </div>
                                        
                                    <ul class="fw-footer pagination wizard">
                                     <!--   <li class="previous first"><a href="" class="a-prevent"><i class="md md-more-horiz"></i></a></li>-->
                                        <li class="previous"><a title="Previous" href="" class="a-prevent"><i class="md md-chevron-left"></i></a></li>
                                        <li class="next"><a title="Next" href="" class="a-prevent"><i class="md md-chevron-right"></i></a></li>
                                    <!--    <li class="next last"><a href="" class="a-prevent"><i class="md md-more-horiz"></i></a></li>-->
                                    </ul>
                                </div>
                            </div>