<?php

include("includes.php");

//get the categories
$cats=$news->get_cats();

//display the categories in form of tabs
?>

<div class="ps_sub_tabs">
<ul>

<?php
foreach($cats->response->results as $cat){

//filter multi-words categories
if(strpos($cat->webTitle,"World news")!==false ||(str_word_count($cat->webTitle)==1 && !in_array($cat->webTitle,$news->filter_cats))){
?>

<li><a href="modules/post_suggestion/news/content.php?id=<?php echo $cat->id; ?>"><?php echo $cat->webTitle; ?></a></li>

<?php
}
}

?>

</ul>
</div>