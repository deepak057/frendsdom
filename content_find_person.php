<?php

include("environment.php");
check_auth();

$countries=return_array("countries","country");

echo "<div class='hp_spend_points_div'><h3><img src='images/spend.png' align='middle'/>Spend your points, expand your world</h2><p class='hp_sp_des'>Find people with similar interests, offer them your points to be part of your ".RELATIONS_NETWORK_LABEL."</p>

<div class='find_person_div'>


<table cellspacing='1'><tr><td align='right' class='dark-grey font14'>Age:</td><td><select name='age' id='hp_fp_age'><option value='all'>All<option value='13-18'>13-18<option value='19-25'>19-25<option value='26-35'>26-35<option value='36-45'>36-45<option value='46-60'>46-60<option value='60+'>60+</select></td></tr><tr><td align='right' class='dark-grey font14'>Sex:</td><td><select name='sex' id='hp_fp_sex'><option value='all'>All<option value='male'>Male<option value='female'>Female</select></td></tr><tr><td align='right' class='dark-grey font14'>Location:</td><td><select name='country' id='hp_fp_country'><option value='all'>Country (All)"; 

for($i=0;$i<sizeof($countries);$i++)
{

echo "<option value='{$countries[$i]}'>$countries[$i]";

}

echo "</select>&nbsp;<input type='text' name='state' id='hp_fp_state' placeholder='State (optional)' class='blue_onhover'/>&nbsp;<input type='text' name='city' placeholder='City (optional)' class='blue_onhover' id='hp_fp_city'/></td></tr>


<tr><td></td><td><input type='submit' style='margin-top:10px;' class='special_btn find_btn' value='Find'/></td></tr>

</table></div>


</div>";




?>