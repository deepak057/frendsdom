<?php

//update points
echo update_points($_SESSION["userid"],$_REQUEST['points'],$_REQUEST['action'])?"1":"0";


?>