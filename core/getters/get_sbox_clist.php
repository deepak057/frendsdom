<ul class="colorlist">

<?php

foreach (get_vp_colors() as $color){

?>

<li class="cs-clist-slice" color="<?php echo $color; ?>" style="background:<?php echo $color; ?>"></li>

<?php
}

?>


</ul>