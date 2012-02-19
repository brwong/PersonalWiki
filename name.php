<?php
//this script receives a page name via GET, and accesses the master xml in order to return the appropriate file
if($_GET['method']=='ajax'){
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");// Date in the past
}
//$master_out = '';

// PLACE CODE HERE \/ \/ \/ \/ \/ \/


$wanted_page = $_GET['page'];
//change spaces for underscores

$the_master = simplexml_load_file("master.xml");

$wanted_file = "";
$true_name = "";

foreach($the_master->children() as $file){
	$att = $file->attributes();
	if($att['protected']=='true'){continue;}
	if($file->name==$wanted_page){
		$true_name = $file->name;
		$wanted_file = $att['src'];
		break;
	}
	foreach($file->altname as $alt){
		if($alt == $wanted_page){
			$true_name = $file->name;
			$wanted_file = $att['src'];
			break;
		}
	}
}



// END OF CODE /\ /\ /\ /\ /\ /\ /\

if($_GET['method']=='ajax'){
	echo $wanted_file;
}

//echo $master_out;
?>