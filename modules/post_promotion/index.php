<?php

include("includes.php");

//content URL
$content_url=$this_mod."/content.php?post_id={$_REQUEST['post_id']}";

?>

<div class="pp-container text-style">
<h3>Post Promotion</h3>

<p>Promote this post. Choose people who will be seeing this as a promotional post.</p>



<div id="pp-tabs">
<ul>
<li><a href="<?php echo $content_url; ?>&type=recently_online">Recently Online</a></li>
<li><a href="<?php echo $content_url; ?>&type=top_users">Top Users</a></li>
<li><a href="<?php echo $content_url; ?>&type=recent_users">Recently Joined</a></li>


</ul>
</div>





</div>