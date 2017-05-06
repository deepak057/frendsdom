<?php


class HtmlComponents{


/**
** Method to return the HTML for the form of "Top Search Bar"
**/

public static function TopSearchBar($placeholder=false){

ob_start();
?>

  <form class="top-search-form" action="<?php echo AppURLs::SearchURL(); ?>" method="get"> <input placeholder="<?php echo $placeholder?$placeholder:'Search for People, Circles or Posts';?>" name="k" id="top-search-field" type="text"></form>


<?php

return ob_get_clean();


}



}




?>