<?php

require('securimage.php');

$securimage = new Securimage();

echo json_encode($securimage->check($_POST['ct_captcha']));

?>