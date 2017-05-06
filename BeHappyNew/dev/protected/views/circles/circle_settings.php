<div class="sc-page-wrap"> 

<div class="panel-group" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">


<?php 


if($is_owner){

?>
<!-- Panel- Update circle-->

<div class="panel panel-collapse">
<div class="panel-heading" role="tab">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordionCyan" href="#accordionCyan-one" aria-expanded="true">Update Circle </a></h4></div>
<div id="accordionCyan-one" class="collapse" role="tabpanel">

<form class="form cs-update-circle-form">
<div class="panel-body cs-update-circle">


<div class="input-group m-b-20 w-100">
<span class="input-group-addon c-gray"> Title*</span>
<div class="fg-line ">
<input maxlength="<?php echo $GLOBALS['app_config']['default_count']['circle_title_length']; ?>" placeholder="Max <?php echo $GLOBALS['app_config']['default_count']['circle_title_length']; ?> characters" class="form-control no-border cs-update-title-field form-fields-bottom-border w-100" value="<?php echo $circle->title ?>" type="text"/>
</div>
</div>


<div class="input-group m-b-20 w-100">

<span class="input-group-addon c-gray"> Image</span>

<div class="circle-image-div ">


<div class="upload-circle-img-wrap <?php if(!empty($circle->circle_image)) echo "none";  ?> ">


<input type="file" class="cs-file-field w-98 form-fields-bottom-border m-l-5" />
<input value="<?php if(!empty($circle->circle_image)) echo $circle->circle_image;  ?>" type="hidden" class="cs-circle-file-name">

</div>



<?php 

if(!empty($circle->circle_image)){

?>

<div class="w-98 circle-image-outer-wrap form-fields-bottom-border h74">

<div class="circle-image-wrap pull-left m-t-10">
<div title="Remove Image" class="remove-circle-img pointer center pull-right bgm-gray c-white"><i class="md-close"></i>
</div>
<img class="fr" src="<?php echo AppURLs::CircleImageURL($circle->circle_image); ?>"/>
</div>
<div class="clear"></div>
</div>


<?php
}
?>
</div>
</div>



<div class="input-group m-b-20 w-100">
<span class="input-group-addon c-gray"> Privacy</span>



<select data-placeholder="Circle Privacy" class="selecstpicker w-100 c-visibility" >
                                        <option <?php if(!$circle->privacy) echo "selected"; ?> value="public">Public</option>
                                        <option <?php if($circle->privacy==1) echo "selected"; ?> value="private">Private</option>
                                        
                                    </select>



</div>




<div class="input-group m-b-20 w-100">
<span class="input-group-addon c-gray"> </span>


<button cid="<?php  echo $circle->id; ?>" class="btn btn-info btn-sm m-l-5 m-t-5 cs-update-circle-submit" type="submit"><i class="md-check m-r-5"></i> Update</button>

</div>
</form>
</div>
</div>

</div>

<?php
}

?>





<!-- Panel- Default circle-->

<div class="panel panel-collapse">
<div class="panel-heading " role="tab">
<h4 class="panel-title"><a  data-toggle="collapse" data-parent="#accordionCyan" href="#accordionCyan-three" aria-expanded="false">Make it default </a></h4></div><div id="accordionCyan-three" class="collapse" role="tabpanel">
<div class="panel-body">
<div class="cs-default-circle-wrap">
<div><p>
<small> Make this your Default Circle so that it will always be auto-selected on your Dashboard.</small>
</p>


<div data-ts-color="blue" class="toggle-switch">
                                        <label class="ts-label" for="ts3"><strong>Default Circle</strong></label>
                                        <input id="ts3" <?php if($default_cirlce) echo "checked"; ?> hidden="hidden" type="checkbox" class="cs-default-circle-checkbox">
                                        <label class="ts-helper" for="ts3"></label>
                                    </div>



<div class="m-t-10">
	
	<button cid="<?php echo $circle->id; ?>" class="btn btn-info btn-xs m-t-10 make-circle-default-btn"><i class="md md-check m-r-5"></i>Done</button>

</div>



</div>
<div >
	

</div>
</div>
</div>
</div>
</div>





<!-- Panel- Unjoin circle-->

<div class="panel panel-collapse">
<div class="panel-heading " role="tab">
<h4 class="panel-title"><a  data-toggle="collapse" data-parent="#accordionCyan" href="#accordionCyan-two" aria-expanded="false">Un-join Circle </a></h4></div><div id="accordionCyan-two" class="collapse" role="tabpanel">
<div class="panel-body">
<div class="unjoin-circle-wrap">
<div><p>Unjoin this circle so that it won't be available in your dashboard anymore.</p></div>
<div ><button cid="<?php echo $circle->id; ?>" class="btn btn-danger un-join-circle-trigger">Un-join Now</button></div>
</div>
</div>
</div>
</div>




</div>
</div>
</div>