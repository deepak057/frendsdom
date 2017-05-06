<div class="contacts clearfix row">
                                        

<?php

if(!empty($users)){

foreach($users as $user){

$this->widget("Personitem",array("user"=>$user));

}

}

else {

?>


<div class="alert alert-danger">No one has voted on this Post yet.</div>

<?php

}

?>

 </div>