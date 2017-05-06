<div class="col-sm-12">
          
          <!-- Calendar -->
          
          <!-- Todo Lists -->
          <div id="todo-lists">
            <div class="tl-header">
              <h2>
                Ask a question
              </h2>
              <small>
               Add a post
              </small>
              
             <!-- <ul class="actions actions-alt">
                <li class="dropdown">
                  <a href="" data-toggle="dropdown">
                    <i class="md md-more-vert">
                    </i>
                  </a>
                  
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                      <a href="">
                        Refresh
                      </a>
                    </li>
                    <li>
                      <a href="">
                        Manage Widgets
                      </a>
                    </li>
                    <li>
                      <a href="">
                        Widgets Settings
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>-->
            </div>
            
            <div class="clearfix">
            </div>
            
            <div class="tl-body">
              <div id="add-tl-item">
                <i class="add-new-item md md-add">
                </i>
                
                <div class="add-tl-body m-l-30 m-b-10">
                  
                  <div class="row status-supporting-text-wrap m-b-10">
                    
                    <div class="fl">
                      
                      <img class="user-pic br-50" src="<?php echo Helpers::get_controller(USERS)->ProfilePicUrl(); ?>"/>
  
  
  </div>
  
  <div class="fl sst-content-div" >
    
    <textarea class="sst-content w-100 grey" type="text" placeholder="Your Question? " ></textarea>
    
  </div>
  
  <div class="clearfix">
  

  </div>
  
                </div>
                
                <div class="status-content m-t-10 m-b-10 white-back">





                  <textarea placeholder="Description" class="status-main-content grey" name="status-main-content"></textarea>
                  

<div>
  
  <a href="javascript:void(0)" title="Add an image" class="m-l-5 m-b-10 status-add-image-trigger"><i class="md md-photo-library"></i></a>

<input type="file" id="post-img-file" class="none" />

<input type="hidden" id="post-img-file-name"/>





</div>



                </div>


                
<div class="sst-add-options white-back m-t-5 m-b-5 p-5">

<div class="grey m-b-5">Post Options. <small>Add options here.</small></div>
  
<input max-allowed="<?php echo $GLOBALS['app_config']['default_count']['max_allowed_options']; ?>" class="c-black" default-options='<?php echo $default_options; ?>' type="text" id="sst-options-field"/>

<button cid="<?php echo $circle->id; ?>" class="btn btn-primary m-t-20 m-b-10 btn-save-status" >
  <i class="md md-check"> 
  </i>Create

</button>



</div>






                <!--
                <div class="add-tl-actions">



                  <button class="action-btn br-50" data-tl-action="dismiss">
                    <i class="md md-close">
                    </i>
                  </button>
                  

                </div>-->


              </div>
            </div>
            
            
          </div>
        </div>
      </div>