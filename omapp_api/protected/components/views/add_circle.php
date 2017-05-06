<div class="create-circle-popup p-5 p-l-10">
              
              
              <p>Choose title. Keep it short and interesting.</p>              
              <form class="create-circle-form m-t-10">
                



                <div class="input-group  m-t-20 ">

                  <span class="input-group-addon c-gray"> Title*</span>

                  <div class="fg-line">
                    
                    <input  maxlength="<?php echo $GLOBALS['app_config']['default_count']['circle_title_length']; ?>" type="text" placeholder="Title (max <?php echo $GLOBALS['app_config']['default_count']['circle_title_length']; ?> characters)" class="form-control circle-create-title">
                  </div>
                  

                </div>
           
<div class="input-group m-t-20">  

                  <span class="input-group-addon c-gray">Image</span>


<!--<a href="javascript:void(0)" onclick="UploadCircleImage.Init()" title="Add an image" class="m-l-5 m-b-10 big circle-add-image-trigger c-blue t-20"><i class="md md-photo-library"></i></a>-->
<input  onchange="UploadCircleImage.UploadFileInit(this)" id="circle-image-file" class=" w-100 form-fields-bottom-border" type="file" />
<input type="hidden" id="circle-image-name"/>


</div>


<div class="input-group m-t-20">

                  <span class="input-group-addon c-gray">Privacy</span>



<!--

 <div class="checkbox m-t-5 form-fields-bottom-border">
 <label>
 <input type="checkbox" value="" id="signup-page-agreement-check" > 
 <i class="input-helper"></i>Private Circle </label>
</div>
-->

<select data-placeholder="Circle Privacy" class="selecstpicker w-100 c-visibility" >
                                        <option checked value="public">Public</option>
                                        <option value="private">Private</option>
                                        
                                    </select>


</div>

                
                <div class="row m-10 m-t-20 ">
                  
                  <button type="submit" class="btn btn-danger circle-create-btn">
                    <i class="md md-check"> 
  </i> Create
                  </button>
                </div>
              </form>
            </div>
            