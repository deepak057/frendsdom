<div class="pull-up"><h2>Subscribe to categories</h2>
<p>Your feed will be customized based on your subscribed categories. Please choose categories that match your interests below.</p>
</div><div>
<ul>
<?php

//get categories subscribed already by current user
$subscribed_cats=user_cats();


foreach (post_cats() as $k=>$cat){

$id_="cat-".$k;

?>
<li class="pointer wn-cat-select-box">

<p>
<label for="<?php  echo $id_; ?>"><?php echo $cat['value']; ?></label>

</p>
<p>
<input class="wn-cat-checks" <?php if(in_array($cat['id'],$subscribed_cats)) echo 'checked'; ?> id="<?php echo $id_; ?>" type="checkbox" value="<?php echo $cat['id']; ?>"/>
</p>
</li>
<?php


}


?>
</ul>
<div class="clear"></div>
</div>
<p>
<button class="btn-special-blue btn-special-blue-primary wn-save-cats-btn">Save</button>
</p>

<?php


if(!empty($_REQUEST['put_next'])){

?>

<p class="right box1"><a href="javascript:void(0)" class="blue load-hobbies">Next >> </a></p>

<?php
}

?>