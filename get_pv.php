<?php

include("environment.php");
check_auth();

if(!empty($_POST['p_id']))
{

$pv_rel=entity_value("posts_record_of_user{$_SESSION['userid']}","relations","post_id",$_POST['p_id'],$posts_db);

?>


<form name="post_conf_form">
<p>This post should be visible to </p><div style='border-bottom:1px dotted #ccc;'><div class='fl'><b>Everyone</b><p><input type='checkbox' id='cb_pv_public' name='cb_pv_public' <?php if(entity_value("posts_record_of_user{$_SESSION['userid']}","public","post_id",$_POST['p_id'],$posts_db)) echo "checked='checked'"; ?> value='all'/><label for='cb_pv_public'>&nbsp;Make public</label></p></div><div class='fr'><b>Relations</b><p>

<input type='checkbox' name='cb_pv' <?php if(strpos($pv_rel,"fr")!==false) echo "checked='checked'";?> value='fr' id='pv-conf-edit-fr'/><label for='pv-conf-edit-fr'>&nbsp;Friends</label><br/>
<input type='checkbox' name='cb_pv' <?php if(strpos($pv_rel,"fam")!==false) echo "checked='checked'";?> value='fam' id='pv-conf-edit-fam'/><label for='pv-conf-edit-fam'>&nbsp;Family</label><br/>
<input type='checkbox' name='cb_pv' <?php if(strpos($pv_rel,"col")!==false) echo "checked='checked'";?> value='col' id='pv-conf-edit-col'/><label for='pv-conf-edit-col'>&nbsp;Colleagues</label><br/>
<input type='checkbox' name='cb_pv' <?php if(strpos($pv_rel,"aqu")!==false) echo "checked='checked'";?> value='aqu' id='pv-conf-edit-aqu'/><label for='pv-conf-edit-aqu'>&nbsp;Acquaintance</label><br/>
<input type='checkbox' name='cb_pv' <?php if(strpos($pv_rel,"npa")!==false) echo "checked='checked'";?> value='npa' id='pv-conf-edit-npa'/><label for='pv-conf-edit-npa'>&nbsp;NPA</label></p></div><div class='clear'></div></div>
</form>
<?php

}
else
{
header('location:home.php');
}
?>