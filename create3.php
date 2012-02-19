<?php
if($_GET['method']=='ajax'){
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");// Date in the past
}
$master_out = '';

// PLACE CODE HERE \/ \/ \/ \/ \/ \/

if(isset($_POST['newcontent'])){
	$xml = simplexml_load_string('<page></page>');
	$dets = $xml->addChild('details');
	$name = $dets->addChild('name', $_POST['newname']);
	$cont = $xml->addChild('content');
	$curver = $cont->addChild('version', $_POST['newcontent']);
	$curver->addAttribute("current", "true");
	$curver->addAttribute("ip", $_SERVER['REMOTE_ADDR']);
	//$curver->addAttribute('by', );
	$curver->addAttribute('created', date('Y-m-d|H:i:s'));
	$toname = $_POST['newname'] . '.xml';
	$attempt = @file_put_contents($toname, $xml->asXML());
	$master = simplexml_load_file('master.xml');
	$newone = $master->addChild('file');
	$newone->addAttribute('src', $toname);
	$newone->addChild('name', $_POST['newname']);
	//alt names
	$updater = @file_put_contents('master.xml', $master->asXML());
	if($attempt){$master_out .= 'Your page has been successfully created.<br />';}
	$master_out .= nl2br(stripslashes($_POST['newcontent']));
}
else{
	$master_out .= '<form id="pagecreator" method="POST" action="?action=create">';
	$master_out .= '<span class="contentinputlabel">name: </span>';
	$master_out .= '<input type="text" name="newname" value="' . $_GET['page'] . '" class="contentinput" /><br/>';
	$master_out .= '<span class="contentinputlabel">keywords (N/A): </span>';
	$master_out .= '<input type="text" name="keywords" class="contentinput" /><br/>';//keywords
	$master_out .= '<span style="float:right;"><input type="submit" value="save" /></span>';
	$master_out .= 'content:';
	$master_out .= '<textarea class="contentbox" name="newcontent" rows="50">';

	$master_out .= '</textarea>';
	$master_out .= 'categories?';// do something with categories here
	$master_out .= '</form>';
}

// END OF CODE /\ /\ /\ /\ /\ /\ /\

echo $master_out;
?>