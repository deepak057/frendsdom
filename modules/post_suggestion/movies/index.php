<?php

include("includes.php");

//get categories
$cats=$movies->get_cats();

?>

<div class="ps_sub_tabs">
<ul>

<?php
foreach($cats as $cat){
?>
<li><a href="<?php echo $m_path; ?>/content.php?cat=<?php echo $cat;?>"><?php echo ucwords(str_replace("_"," ",$cat)); ?></a></li>
<?php
}

?>

</ul>
</div>

