<li title="<?php if($already_liked) echo "Unlike"; else echo "Like"; ?> this post" l-action="<?php if($already_liked) echo "unlike"; else echo "like";  ?>" p-id="<?php echo $post->id; ?>" class="tvbs-likes post-like-btn pointer <?php if($already_liked) echo "c-gray"; ?> ">
                                         Like<?php if($already_liked) echo "d"; ?> <?php if(!empty($post->likes)) echo "(".count($post->likes).")"; ?>
                                        </li>