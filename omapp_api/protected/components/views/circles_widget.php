<?php

if(!empty($circles)){

?>

<div class="circles-widget-wrap">

<?php


foreach ($circles as $circle){
?>

<div class="pull-left m-b-5">

<?php $this->widget("Circleicon",array("circle"=>$circle)); ?>

</div>


<?php

}

?>

</div>

<?php

}

else echo "<small>No Circles</small>";

?>