<?php

//include system's environment 
include("includes.php");

//get all the tables from post suggestion database in an array
$table_arr=get_tables($GLOBALS['post_suggestion_db']);

?>

<div class="ps_sub_tabs">
<ul>
<?php

foreach($table_arr as $tab)
{
?>
<li><a href="/modules/post_suggestion/quotes/tab_content.php?tab=<?php echo $tab;?>"><?php echo ucwords($tab);?></a></li>
<?php
}
?>

</ul>
</div>
