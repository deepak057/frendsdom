<?php

if(!empty($_POST['p_id'])){

display_posts(0,0,$_POST['p_id'],false,get_uid_from_post_id($_POST['p_id']));

}



?>