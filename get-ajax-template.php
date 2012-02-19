<?php
if($_GET['method']=='ajax'){
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");// Date in the past
}
$master_out = '';

// PLACE CODE HERE \/ \/ \/ \/ \/ \/

include "name.php";



// END OF CODE /\ /\ /\ /\ /\ /\ /\

echo $master_out;
?>