<?php

require("includes.php");

//set page index
$page=empty($_GET['page'])? 1 : $_GET['page'];

//get content for received category id
$content=$news->get_item($_GET['id'],$page);

//display content
foreach($content->response->results as $block){
?>

<div class="news_block">
<div><a href="#" class="api-news api-news-title"><strong><?php echo $block->webTitle; ?></strong></a></div>
<div><span class="api-news-des"><?php echo $block->fields->trailText; ?></span>&nbsp;<span class="api-news pointer light_text small"><u>..read full story</u></span></div>
<div class="news_body none"><div class="news_body_content"><?php echo str_replace("<a","<a target='_blank'", $block->fields->body); ?></div><div><span class="api-news-collapse pointer light_text small"><u>..collapse</u></span></div></div>
<div news-api-url="<?php echo $block->apiUrl; ?>" class="include-sfp include-api-news pointer">Use this story</div>
</div>

<?php

}

//putting link to fetch more content
echo "<div class='center more_sps light_text small pointer' content-link='/modules/post_suggestion/news/content.php?id=".$_GET['id']."&page=".($page+1)."'>More</div>";


?>