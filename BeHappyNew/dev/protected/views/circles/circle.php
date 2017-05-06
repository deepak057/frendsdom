
<?php

if($circle){

?>

<div circle-id="<?php echo $circle->id; ?>" id="app-circle-data-container" class="row">

<?php

$this->Widget("Circledata",array("circle"=>$circle));

?>

</div>

<?php

}

else {

?>

<div class="alert alert-danger">Sorry, no Circle found.</div>

<?php


}


?>
