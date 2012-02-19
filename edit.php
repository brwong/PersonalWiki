<?php
if($_GET['method']=='ajax'){
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");// Date in the past
}
$master_out = '';

// PLACE CODE HERE \/ \/ \/ \/ \/ \/

$edit_name = '';
$name_can_change = false;
$edit_contents = '';
$can_edit = false;
$keywords = '';
/*$type = '';*/

if(isset($wanted_file) && $wanted_file!=''){
	if(file_exists($wanted_file)){// EDIT IT!
		$edit_name = $true_name;
		$can_edit = true;
		$page_xml = simplexml_load_file($wanted_file);
		// LOAD ALL DETAILS NECESSARY
		foreach($page_xml->content->children() as $version){
			$att = $version->attributes();
			if($att['current']=='true'){
				$edit_contents = $version;
				break;
			}
		}
	}
	else{//FILE IS UNAVAILABLE
		
	}
}
else{// CREATE IT!
	$name_can_change = true;
	if($_GET['page']){$edit_name = $_GET['page'];}// it has a name request
	$can_edit = true;
}


/*$file_to_edit = "";
if(isset($wanted_file)){$file_to_edit = $wanted_file;}
else{$file_to_edit = $_GET['file'];}
if($file_to_edit==""){//page doesn't exist
	if($_GET['method']=='ajax'){exit("***ERROR-page doesn't exist***");}
	else{echo '<span class="contenterror">The page you have selected doesn\'t exist yet. <a href="#">Click here</a> to create it.</span>';}
}
elseif(file_exists($file_to_edit)==false){//file not found
	if($_GET['method']=='ajax'){exit("***ERROR-file not found***");}
	else{echo '<span class="contenterror">Sorry, that page is temporarily unavailable.</span>';}
}
else{
	//open xml, get content, categories?, keywords, markup type (html/special/regular text/etc)
	$page_xml = simplexml_load_file($file_to_edit);
	$content = '';
	$keywords = '';
	$type = '';
	foreach($page_xml->content->children() as $version){
		$att = $version->attributes();
		if($att['current']=='true'){
			$content = $version;
			break;
		}
	}
	$master_out .= '<form id="contentform" action="?page=' . $true_name . '" method="POST">';
	$master_out .= '<span class="contentinputlabel">keywords (currently N/A): </span>';
	$master_out .= '<input type="text" id="keywords" name="keywords" class="contentinput" value="' . $keywords . '" /><br/><br/>';
	$master_out .= '<span style="float:right;"><input type="submit" value="save" /></span>';
	$master_out .= 'content';
	if($type!=''){$master_out .= ' (using ' . $type . ')';}
	$master_out .= ': <br/>';
	$master_out .= '<textarea class="contentbox" name="maincontent" rows="50">';
	$master_out .= htmlspecialchars(stripslashes($content));
	$master_out .= '</textarea>';
	//$master_out .= '<input type="hidden" name="file" value="' . $file_to_edit . '" />';
	$master_out .= '</form>';
}*/
if($can_edit){
	$master_out .= '<form id="contentform" action="?';
	if($edit_name){$master_out .= 'page=' . $true_name;}
	$master_out .= '" method="POST">';
	$master_out .= '<span class="contentinputlabel">name: </span>';
	if($name_can_change){$master_out .= '<input type="text" name="page" value="' . $edit_name . '" class="contentinput" /><br/>';}
	else{$master_out .= $edit_name . '<input type="hidden" name="page" value="' . $edit_name . '" /><br/>';}
	$master_out .= '<span class="contentinputlabel">keywords (N/A): </span>';
	$master_out .= '<input type="text" id="keywords" name="keywords" class="contentinput" value="' . $keywords . '" /><br/><br/>';
	$master_out .= '<span style="float:right;"><input type="submit" value="save" /></span>';
	$master_out .= 'content';
	if($type!=''){$master_out .= ' (using ' . $type . ')';}
	$master_out .= ': <br/>';
	$master_out .= '<textarea class="contentbox" name="maincontent" rows="50">';
	$master_out .= htmlspecialchars(stripslashes($edit_contents));
	$master_out .= '</textarea>';
	$master_out .= '</form>';
}
else{
	$master_out .= '<span class="contenterror">Sorry, that page is temporarily unavailable.</span>';
}
$pagetitle = 'editing';
if($name_can_change==false){$pagetitle .= ' - ' . $true_name;}
$pageredirect = '';
$pagetoolbar = '<a href="#" onclick="document.getElementById(\'contentform\').submit()" id="read_button">read (save)</a> | <a id="edit_button">edit</a> | <a target="_blank">edit history</a> ';
$pagestatus = '';
$pagecontent = $master_out;

// END OF CODE /\ /\ /\ /\ /\ /\ /\

if($_GET['method']=='ajax'){echo $master_out;}
?>