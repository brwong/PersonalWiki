<?php
if($_GET['method']=='ajax'){
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");// Date in the past
}
$master_out = '';

// PLACE CODE HERE \/ \/ \/ \/ \/ \/


include "name.php";
$file_to_write = '';
$contents = '';
if($_GET['method']=='ajax'){
	$file_to_write = $_GET['file'];
	$contents = $_GET['contents'];
}
else{
	//$file_to_write = $_POST['file'];
	$file_to_write = $wanted_file;
	$contents = $_POST['maincontent'];
}
$contents = stripslashes($contents);
$xml_to_write = simplexml_load_file($file_to_write);
foreach($xml_to_write->content->children() as $ver){
	if($ver['current']=='true'){unset($ver['current']);break;}
}
$newone = $xml_to_write->content->addChild("version", $contents);
$newone->addAttribute("current", "true");
$newone->addAttribute("ip", $_SERVER['REMOTE_ADDR']);
//$newone->addAttribute("by", );
$newone->addAttribute("created", date('Y-m-d|H:i:s'));
$attempt = file_put_contents($file_to_write, $xml_to_write->asXML());// WHAT IF THE TO-BE-SAVED VERSION IS THE SAME AS THE CURRENT?
$master_out .= 'Your version has been successfully saved.<br/><br/>';// THIS HAS TO BE ENHANCED (SELF-DISAPPEARING)
$master_out .= nl2br($contents);


// END OF CODE /\ /\ /\ /\ /\ /\ /\

echo $master_out;
?>