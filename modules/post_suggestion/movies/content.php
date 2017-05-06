<?php

include("includes.php");

//setting page number,default is 1
$page=empty($_GET['page'])?1:$_GET['page'];

//get content
$results=$movies->get_content($_GET['cat'],$page);

//display content
foreach($results->results as $res){
?>
<div class="news_block">
<div class="api-movie-content">
<p><strong class="smd-movie pointer ps-m-title"><?php echo $res->original_title; ?></strong></p>
<div>
<img class="smd-movie pointer" src="<?php echo $movies->get_pic($res->poster_path);?>" height="300" width="250"/>
</div>
<div>
<strong>Release date:</strong> <?php echo date("M d, Y",strtotime($res->release_date)); ?>
</div>
<div>
<strong>Vote:</strong> <span class="ps-m-vote"><?php echo round($res->vote_average)."</span>/10"; ?>
</div>

<div class="md-container none" m-release-date="<?php echo strtotime($res->release_date); ?>" m-poster-id="<?php echo $res->poster_path;?>" m-path="<?php echo $m_path."/get_details.php"; ?>" m-id="<?php echo $res->id; ?>"></div>

<div class='right'><span class="pointer small smd-movie light_text"><u>...More details</u></span></div>
</div>

<div class="include-sfp pointer include-api-movie">Include this movie</div>

</div>

<?php
}

?>

<div class="center more_sps light_text small pointer" content-link="<?php echo $m_path; ?>/content.php?page=<?php echo ++$page; ?>&cat=<?php echo $_GET['cat'] ?>">More</div>
