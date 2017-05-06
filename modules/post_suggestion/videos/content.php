<?php

include("includes.php");

//index of starting page 
$page=empty($_GET['page'])?1:$_GET['page'];

//get videos
$videos=$youtube->get_videos($_GET['cat'],$page);

//display content
foreach($videos as $video){

//Youtube URL 
$href="http://youtube.com/watch?v={$video['v_id']}";

?>
<div class="news_block">
<div class="api-video-content">
<diV><strong class="pointer yt-v-title"><?php echo $video['title']; ?></strong></div>
<p><a class="yt-video" href="<?php echo $href; ?>"><img class="yt-v-pic" src="<?php echo $video['mthumb']; ?>?<?php echo mktime(); ?>"/></a></p>
<div style="position:relative;width:0px;height:0px;"><a title="Play" class="yt-video yt-v-play" href="<?php echo $href; ?>"><img src="images/play.png"/></a></div>
<div><strong>Published:</strong> <?php echo date("M d, Y",strtotime($video['published'])); ?></div>
<div><strong>Views:</strong> <span class="yt-v-views"><?php echo $video['views']; ?></span></div>
<p class="yt-v-des none"><?php echo $video['description']; ?></p>
<div class="right"><span class="pointer small smd-video light_text"><u>...More details</u></span></div>
</div>
<div class="include-sfp pointer include-api-video" v-id="<?php echo $video['v_id']; ?>" v-published="<?php echo strtotime($video['published']); ?>">Include this video</div>
</div>
<?php
}
?>

<div class="center more_sps light_text small pointer activate-yt-video" content-link="<?php echo $m_path; ?>/content.php?page=<?php echo $page+20; ?>&cat=<?php echo $_GET['cat'] ?>">More</div>