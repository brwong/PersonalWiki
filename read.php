<?php
if($_GET['method']=='ajax'){
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");// Date in the past
}
$master_out = '';

// PLACE CODE HERE \/ \/ \/ \/ \/ \/

/*
$wanted_file
$true_name
*/
if($wanted_file==""){//page doesn't exist
	//if($_GET['method']=='ajax'){exit("***ERROR-page doesn't exist***");}
	//else{echo '<span class="contenterror">The page you have selected doesn\'t exist yet. <a href="#">Click here</a> to create it.</span>';}
	$pagetitle = ' - ' . $_GET['page'];
	$pageredirect = '';
	$pagetoolbar = '<a id="read_button">read</a> | <a href="?page=' . $_GET['page'] . '&action=create" id="edit_button">create</a> | <a target="_blank">edit history</a> ';
	$pagestatus = '<span class="contenterror">The page you have selected doesn\'t exist yet. <a href="?page=' . $_GET['page'] . '&action=create">Click here</a> to create it.</span>';
	$pagecontent = '';
}
elseif(file_exists($wanted_file)==false){//file not found
	//if($_GET['method']=='ajax'){exit("***ERROR-file not found***");}
	//else{echo '<span class="contenterror">Sorry, that page is temporarily unavailable.</span>';}
	$pagetitle = ' - ' . $true_name;
	if($_GET['page']!=$true_name){$pageredirect = '(redirected from ' . $_GET['page'] . ')';}
	$pagetoolbar = '<a id="read_button">read</a> | <a id="edit_button">edit</a> | <a target="_blank">edit history</a> ';
	$pagestatus = '<span class="contenterror">Sorry, that page is temporarily unavailable.</span>';
	$pagecontent = '';
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
	$pagetitle = ' - ' . $true_name;
	if($_GET['page']!=$true_name){$pageredirect = '(redirected from ' . $_GET['page'] . ')';}
	$pagetoolbar = '<a id="read_button">read</a> | <a href="' . $_SERVER['REQUEST_URI'] . '&action=edit" id="edit_button">edit</a> | <a target="_blank">edit history</a> ';
	$pagestatus = '';
	$pagecontent = $master_out;
}



// END OF CODE /\ /\ /\ /\ /\ /\ /\

if($_GET['method']=='ajax'){echo $master_out;}
?>