<div class="cs-blocks-container center">
<h3>Create Shares</h3>
<p>What would you like to share with visitors</p>
<div class="cs-content-block center">
<div cl-callback="cs_set_block_color" original-back="#eee" class="cs-block sb-clist-target-block small left align-center">
<form method='post' class='share_form' name='share_form' action='create_share.php' enctype='multipart/form-data' target='upload_target'>
<div class="no_wh">
<span class="sb-cl-trigger cs-cl-trigger pointer">&#916;</span>
<input value="x" class="btn red_bg none cs-remove-block" type="button"/>
</div>
<p><span>Title</span>
<textarea placeholder='Maximum 30 characters' name='share_title' maxlength='30' class='flexible_textarea'></textarea></p>
<input type="hidden" class="sb-back-color-field" name="sb-back-color"/>
<p><span>Content</span>
<textarea name='share_content' maxlength='100' placeholder='Maximum 100 characters'  class='flexible_textarea'></textarea></p>
<p>Picture(optional) <input class="cs-uplaod-pic-field" size='30' type='file' name='share_pic' /></p>
</form>
<div class="no_wh cs-add-creation-block">
<div class="cs-add-creation-inner">
<input title="Add more" value="+" class="btn cs-add-block" type="button"/><br/>
</div>
</div>
</div>
</div>
<div class="clear"></div>
<p><input type='button' class='special_btn create-shares-btn' value='Create'></p>
</div>