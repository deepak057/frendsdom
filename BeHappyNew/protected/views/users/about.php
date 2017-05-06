<div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="md md-equalizer m-r-5"></i> Summary</h2>
                                    
                                    <?php if($own_profile) {?>
                                    <ul class="actions">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" href="">
                                                <i class="md md-more-vert"></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li  >
                                                    <a data-toggle="collapse" href="" data-pmb-action="edit">Edit</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <?php
                                }

                                ?>

                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">
                                       <?php echo Helpers::text($user->summary); ?>
                                    </div>
                                    
                                    <div class="pmbb-edit">
                                        <div class="fg-line">
                                            <textarea user-field="summary" maxlength="500" placeholder="Summary...(max 500 characters)" rows="5" class="pp-summary-field form-control"><?php if(!empty($user->summary)) echo $user->summary; ?></textarea>
                                        </div>
                                        <div class="m-t-10">
                                            <button field-selecter=".pp-summary-field" class="pp-save-info btn btn-primary btn-sm waves-effect waves-button waves-float">Save</button>
                                            <button class="btn btn-link btn-sm waves-effect waves-button waves-float" data-pmb-action="reset">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="md md-person m-r-5"></i> Basic Information</h2>
                                    
                                <?php if($own_profile) {?>

                                    <ul class="actions">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" href="">
                                                <i class="md md-more-vert"></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="" data-pmb-action="edit">Edit</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <?php 

                                }

                                ?>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">
                                        <dl class="dl-horizontal">
                                            <dt>Name</dt>
                                            <dd><?php echo Helpers::PrintValue($this->UserName($user)); ?></dd>
                                        </dl>
					<dl class="dl-horizontal">
                                            <dt>Profile Bio</dt>
                                            <dd><?php echo Helpers::PrintValue($user->profile_bio); ?></dd>
                                        </dl>
					
                                        <dl class="dl-horizontal">
                                            <dt>Gender</dt>
                                            <dd><?php  echo Helpers::PrintValue($user->gender); ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Birthday</dt>
                                            <dd><?php echo Helpers::PrintValue($user->birthday); ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Martial Status</dt>
                                            <dd><?php echo Helpers::PrintValue($user->martial_status); ?></dd>
                                        </dl>
                                    </div>
                                    
                                    <div class="pmbb-edit">
                                        <dl class="dl-horizontal">
                                            <dt class="p-t-10">Name</dt>
                                            <dd>
                                                <div class="fg-line">
                                                    <input value="<?php if(!empty($this->UserName($user))) echo $this->UserName($user); ?>" user-field="name" type="text" maxlength="30" placeholder="eg. Mallinda Hollaway (max 30 characters)" class="pp-basic-info-field form-control">
                                                </div>
                                                
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt class="p-t-10">Profile Bio</dt>
                                            <dd>
                                                <div class="fg-line">
                                                    <textarea maxlength="<?php echo $GLOBALS['app_config']['default_count']['profile_bio_max_len']; ?>" user-field="profile_bio" placeholder="eg. UI developer (max <?php echo $GLOBALS['app_config']['default_count']['profile_bio_max_len']; ?> characters)" class="pp-basic-info-field form-control"><?php if(!empty($user->profile_bio)) echo $user->profile_bio; ?></textarea>
                                                </div>
                                                
                                            </dd>
                                        </dl>
                                        
                                        <dl class="dl-horizontal">
                                            <dt class="p-t-10">Birthday</dt>
                                            <dd>
                                                <div class="dtp-container dropdown fg-line">
                                                    <input value="<?php if(!empty($user->birthday)) echo $user->birthday; ?>" user-field="birthday" type="text" placeholder="mm/dd/yyyy" data-toggle="dropdown" class="pp-basic-info-field form-control date-picker">
                                                </div>
                                            </dd>
                                        </dl>
					<dl class="dl-horizontal">
                                            <dt class="p-t-10">Gender</dt>
                                            <dd>
                                                <div class="fg-line">
                                                    <select user-field="gender" class="pp-basic-info-field form-control">
							                            <option <?php if(empty($user->gender)) echo "selected" ?> value="">Please select</option>
                                                        <option <?php if($user->gender=="male") echo "selected" ?> value="male">Male</option>
                                                        <option <?php if($user->gender=="female") echo "selected" ?> value="female">Female</option>
                                                    </select>
                                                </div>
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt class="p-t-10">Martial Status</dt>
                                            <dd>
                                                <div class="fg-line">
                                                    <select user-field="martial_status" class="pp-basic-info-field form-control">
							                             <option <?php if(empty($user->martial_status)) echo "selected" ?> value="">Please select</option>
                                                        <option <?php if($user->martial_status=="single") echo "selected" ?> value="single">Single</option>
                                                        <option <?php if($user->martial_status=="married") echo "selected" ?> value="married">Married</option>
                                                    </select>
                                                </div>
                                            </dd>
                                        </dl>
                                        
                                        <div class="m-t-30">
                                            <button field-selecter=".pp-basic-info-field" class="btn btn-primary btn-sm waves-effect waves-button waves-float pp-save-info">Save</button>
                                            <button class="btn btn-link btn-sm waves-effect waves-button waves-float" data-pmb-action="reset">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                        
                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="md md-phone m-r-5"></i> Contact Information</h2>
                                      <?php if($own_profile) {?>
                                    <ul class="actions">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" href="">
                                                <i class="md md-more-vert"></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="" data-pmb-action="edit">Edit</a>
                                                </li>
                                            </ul>
					<?php } ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">

                                     <dl class="dl-horizontal">
                                            <dt>Address</dt>
                                            <dd><?php echo Helpers::PrintValue($user->address); ?></dd>
                                        </dl>
                                       
                                        <dl class="dl-horizontal">
                                            <dt>Mobile Phone</dt>
                                            <dd><?php echo Helpers::PrintValue($user->mobile); ?></dd>
                                        </dl><?php if($own_profile){ ?>
                                        <dl class="dl-horizontal">
                                            <dt>Email Address</dt>
                                            <dd><?php echo Helpers::PrintValue($user->email); ?></dd>
                                        </dl><?php } ?>
                                        <dl class="dl-horizontal">
                                            <dt>Twitter</dt>
                                            <dd><?php echo Helpers::PrintValue($user->twitter); ?></dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Skype</dt>
                                            <dd><?php echo Helpers::PrintValue($user->skype); ?></dd>
                                        </dl>
                                    </div>
                                    
                                    <div class="pmbb-edit">

					<dl class="dl-horizontal">
                                            <dt class="p-t-10">Address</dt>
                                            <dd>
                                                <div class="fg-line">
                                                    <input value="<?php if(!empty($user->address)) echo $user->address; ?>" maxlength="100" type="text" placeholder="eg. 10098 ABC Towers,Dubai Silicon Oasis, Dubai, United Arab Emirates (max 100 characters)" user-field="address" class="pp-contact-info form-control">
                                                </div>
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt class="p-t-10">Mobile Phone</dt>
                                            <dd>
                                                <div class="fg-line">
                                                    <input value="<?php if(!empty($user->mobile)) echo $user->mobile; ?>" type="text" maxlength="16" placeholder="eg. 00971 12345678 9 (max 16 digits)" user-field="mobile" class="pp-contact-info form-control only-number">
                                                </div>
                                            </dd>
                                        </dl>  
                                        <dl class="dl-horizontal">
                                            <dt class="p-t-10">Email Address</dt>
                                            <dd>
                                                <div class="fg-line">
                                                    <input value="<?php if(!empty($user->email)) echo $user->email; ?> (not editable)" type="email" placeholder="eg. malinda.h@gmail.com" disabled="true" class="form-control">
                                                </div>
                                            </dd>
                                        </dl> 
                                        <dl class="dl-horizontal">
                                            <dt class="p-t-10">Twitter</dt>
                                            <dd>
                                                <div class="fg-line">
                                                    <input value="<?php if(!empty($user->twitter)) echo $user->twitter; ?>" type="text" placeholder="eg. @malinda (max 20 characters)" user-field="twitter" maxlength="20" class="pp-contact-info form-control">
                                                </div>
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt class="p-t-10">Skype</dt>
                                            <dd>
                                                <div class="fg-line">
                                                    <input value="<?php if(!empty($user->skype)) echo $user->skype; ?>" type="text" placeholder="eg. malinda.hollaway (max 20 characters)" maxlength="20" user-field="skype" class="pp-contact-info form-control">
                                                </div>
                                            </dd>
                                        </dl>
                                        
                                        <div class="m-t-30">
                                            <button field-selecter=".pp-contact-info" class="btn btn-primary btn-sm waves-effect waves-button waves-float pp-save-info">Save</button>
                                            <button class="btn btn-link btn-sm waves-effect waves-button waves-float" data-pmb-action="reset">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>