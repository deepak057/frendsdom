<?php


/***
** Get all the common componenets by capturing the 
** Output of Commonlayoutcontent widget
**/

ob_start();

$this->widget("Commonlayoutcontent",array(

"content"=>$content

));

$content_=ob_get_clean();

/***
** Render the page
**/

$this->widget("Layout",array(

"content"=>$content_,
"title"=>!empty($this->pageTitle)?$this->pageTitle:false,

));


?>