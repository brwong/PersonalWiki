<?php
if($_GET['method']=='ajax'){
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");// Date in the past
}
$master_out = '';

// PLACE CODE HERE \/ \/ \/ \/ \/ \/

include "name.php";
if($_GET['method']=='ajax' && isset($wanted_file)==false){
	$wanted_file = $_GET['file'];
}

if($wanted_file==""){//page doesn't exist
	if($_GET['method']=='ajax'){exit("***ERROR-page doesn't exist***");}
	else{echo '<span class="contenterror">The page you have selected doesn\'t exist yet. <a href="#">Click here</a> to create it.</span>';}
}
elseif(file_exists($wanted_file)==false){//file not found
	if($_GET['method']=='ajax'){exit("***ERROR-file not found***");}
	else{echo '<span class="contenterror">Sorry, that page is temporarily unavailable.</span>';}
}
else{
	$the_page = simplexml_load_file($wanted_file);
	$content = "";
	foreach($the_page->content->children() as $ver){
		$checker = $ver->attributes();
		if($checker['current'] == 'true'){
			$content = $ver;
			break;
		}
	}

	// text processing happens here
	// special tags replacing (if necessary)
	// html special characters reversion
	

	$master_out .= nl2br($content);
}


// END OF CODE /\ /\ /\ /\ /\ /\ /\

echo $master_out;
?>