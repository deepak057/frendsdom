<?php
if(!empty($_POST['flag']))
{
$module_path="modules/post_suggestion/";
?>
<div id="ps_main_tabs">
<ul>
<li><a href="<?php echo "{$module_path}quotes/index.php"; ?>">Quotes</a></li>
<li><a href="<?php echo "{$module_path}news/index.php"; ?>">News</a></li>
<li><a href="<?php echo "{$module_path}movies/index.php"; ?>">Movies</a></li>
<li><a href="<?php echo "{$module_path}videos/index.php"; ?>">Videos</a></li>
</ul>
</div>

<?php
}
?>