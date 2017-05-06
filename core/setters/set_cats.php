<?php


/*
* first, check if any categories have been unsbscribed and 
* if so, remove the related posts from user's status view
*/

$cats_to_unsbscribe=array_diff(user_cats(),explode(",",$_POST['cats']));

if(count($cats_to_unsbscribe)){

remove_posts_by_cats($cats_to_unsbscribe);

}

if(set_user_value("subscribed_cats",$_POST['cats'])){

echo "1";

}

else {

echo "0";

}


?>