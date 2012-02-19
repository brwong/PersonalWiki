<?php
if($_GET['method']=='ajax'){
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");// Date in the past
}
$master_out = '';

// PLACE CODE HERE \/ \/ \/ \/ \/ \/

//check for name/file
if($wanted_file==''){//new
	$new_page = true;
	$save_file = str_replace(' ', '_', $_POST['page']) . '.xml';
	$xml = simplexml_load_string('<page></page>');
	$dets = $xml->addChild('details');
	$name = $dets->addChild('name', $_POST['page']);
	$cont = $xml->addChild('content');
}
elseif(file_exists($wanted_file)){//exists
	$save_file = $wanted_file;
	$xml = simplexml_load_file($wanted_file);
}
else{//unavailable
	
}
//get contents from POST
if(isset($xml)){
	foreach($xml->content->children() as $ver){
		if($ver['current']=='true'){unset($ver['current']);break;}
	}
	$contents = stripslashes($_POST['maincontent']);
	// MODIFY STRING
	$newone = $xml->content->addChild("version", $contents);
	$newone->addAttribute("current", "true");
	$newone->addAttribute("ip", $_SERVER['REMOTE_ADDR']);
	//$newone->addAttribute("by", );
	$newone->addAttribute("created", date('Y-m-d|H:i:s'));
	$attempt = @file_put_contents($save_file, $xml->asXML());// WHAT IF THE TO-BE-SAVED VERSION IS THE SAME AS THE CURRENT?
	$pagetitle = $_POST['page'];
	$pageredirect = '';
	$pagetoolbar = '<a id="read_button">read</a> | <a href="?page=' . $_POST['page'] . '&action=edit" id="edit_button">edit</a> | <a target="_blank">edit history</a> ';
	if($attempt){
		$pagestatus = 'Your version has been successfully saved.';
		if($new_page){
			$master = simplexml_load_file('master.xml');
			$entry = $master->addChild('file');
			$entry->addAttribute('src', $save_file);
			$entry->addChild('name', $_POST['page']);
			//$entry->addChild('altname',);//ALTERNATE NAMES HERE
			@file_put_contents('master.xml', $master->asXML());
		}
	}// THIS HAS TO BE ENHANCED (SELF-DISAPPEARING)
	else{$pagestatus = '<span class="contenterror">The content was unable to be saved - an unknown error has occured.</span>';}
	$pagecontent = nl2br($contents);
}
else{
	$pagetitle = 'save error';
	$pageredirect = '';
	$pagetoolbar = '<a id="read_button">read</a> | <a href="?page=' . $_POST['page'] . '&action=edit" id="edit_button">edit</a> | <a target="_blank">edit history</a> ';
	$pagestatus = '<span class="contenterror">The content was unable to be saved - the file was unavailable.</span>';
	$pagecontent = $_POST['maincontent'];//format string
}

/*
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
$master_out .= nl2br($contents);*/


// END OF CODE /\ /\ /\ /\ /\ /\ /\

if($_GET['method']=='ajax'){echo $master_out;}
?>