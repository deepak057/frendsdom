<?php if(!$own_profile){ ?>
                                    <div  title="Send a message" class="dropdown pmop-message send-msg-container">
                                        <a  class="btn bgm-white btn-float z-depth-1 waves-effect waves-button waves-float waves-effect waves-button waves-float" href="" data-toggle="dropdown">
                                            <i class="md md-message"></i>
                                        </a>
                                        
                                        <div class="dropdown-menu ">
                                            <textarea class="text-msg-field" placeholder="Write something..."></textarea>
                                            
                                            <button to-id="<?php echo $user->id; ?>" onclick="SendMessage.SendInit($(this));" title="Send now" class="btn bgm-green btn-icon waves-effect waves-button waves-float waves-effect waves-button waves-float send-message-trigger"><i class="md md-send"></i></button>
                                        </div>
                                    </div>
                                    <?php } ?>