<?php

include("environment.php");
check_auth();

include('class_lib.php');

//instantiating class user
$lu=new user($_SESSION['userid'],true);

//displaying data
?>

<form name="post_conf_form">

<p>Choose a category:</p>
<p><select name="post_cat" class="cats-dropdown full-width">

<?php

foreach (post_cats() as $cat){

?>

<option value="<?php echo $cat['id']; ?>" <?php if($cat['id']==13) echo "selected" ?>><?php echo $cat['value']; ?></option>

<?php

}

?>


</select></p>



<p>This post should be visible to: </p>
<div style='border-bottom:1px dotted #ccc;'><div class='fl'><b>Everyone</b><p><input type='checkbox' id='cb_pv_public' name='cb_pv_public' <?php if($lu->get_pv_public()) echo "checked='checked'"; ?> value='all'/><label for='cb_pv_public'>&nbsp;Make public</label></p></div><div class='fr'><b>Relations</b><p>

<input type='checkbox' name='cb_pv' <?php if(strpos($lu->get_pv_relations(),"fr")!==false) echo "checked='checked'";?> value='fr' id='pv-conf-fr'/><label for='pv-conf-fr'>&nbsp;Friends</label><br/>
<input type='checkbox' name='cb_pv' <?php if(strpos($lu->get_pv_relations(),"fam")!==false) echo "checked='checked'";?> value='fam' id='pv-conf-fam'/><label for='pv-conf-fam'>&nbsp;Family</label><br/>
<input type='checkbox' name='cb_pv' <?php if(strpos($lu->get_pv_relations(),"col")!==false) echo "checked='checked'";?> value='col' id='pv-conf-col'/><label for='pv-conf-col'>&nbsp;Colleagues</label><br/>
<input type='checkbox' name='cb_pv' <?php if(strpos($lu->get_pv_relations(),"aqu")!==false) echo "checked='checked'";?> value='aqu' id='pv-conf-aqu'/><label for='pv-conf-aqu'>&nbsp;Aquantaince</label><br/>
<input type='checkbox' name='cb_pv' <?php if(strpos($lu->get_pv_relations(),"npa")!==false) echo "checked='checked'";?> value='npa' id='pv-conf-npa'/><label for='pv-conf-npa'>&nbsp;NPA</label></p></div><div class='clear'></div></div><p>This post should not be visible to (type names): </p><p><textarea id='pv_excluded'></textarea></p>




<p>
<input type='checkbox' <?php if($lu->get_save_pv_conf())echo "checked='checked'"; ?> name='save_pv_conf' value='true' id='pv-conf-sff'><label for='pv-conf-sff'>&nbsp;Save this configuration for future posts</label>
</p>

</form>