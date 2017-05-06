<div class="upload-cp-container center">
<h3>Upload Cover Picture</h3>
<div class="ucp-files-content">
<div id="cover-pic-dnd-area" class="cover-pic-dnd-area half-width dnd-area align-center" style="margin-top:30px">
<p class="dnd-placeholder">Drag And Drop it here</p>
</div>
<h2>OR</h2>
<div class="pp-cp-file-upload-div">
<p>Choose a file</p>
<input type="file" id="cp-file-field" class="field"/>
</div>
<p class="header-back-1">
Recommended Dimension: <?php echo $GLOBALS['cover_pic_conf']['frame_width']." X ".$GLOBALS['cover_pic_conf']['frame_height'];?>
<br/>
Acceptd Image Type: JPG,PNG,GIF
<br/>
Maximum Image Size: 2 MB
</p>
</div>
<progress class="none" id="cv-uploading-progress" min="0" max="100" value="0">0</progress>
</div>