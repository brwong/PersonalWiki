<?php
// handle all GETs here
/* "8 modes"
- main page
- read
- edit
- create
- list categories
- list all
- edit history
- previous version view
*/
if(isset($_GET['page'])){$page = $_GET['page'];}
if($_GET['action']=='edit'){$action = 'edit';}
elseif($_GET['action']=='create'){$action = 'create';}
elseif($_GET['action']=='history'){$action = 'history';}
else{$action = 'read';}
?>
<html>
<head>
<title>wiki
<?php
if(isset($true_name)){
	echo " - ";
	echo $true_name;
}
elseif(isset($page)){
	echo " - ";
	echo $page;
}
?>
</title>
<!--APPLY WIKI STYLE-->
<link rel="stylesheet" type="text/css" href="wikistyle.css">

<script type="text/javascript" src="wikiwork.js"></script>
</head>
<body>
<span id="titlebar">WIKI
<?php
if(isset($true_name)){
	echo " - ";
	echo $true_name;
}
elseif(isset($page)){
	echo " - ";
	echo $page;
}
?>
</span>
<?php
if(isset($true_name) && $true_name!=$page){
	echo '(redirected from "' . $page . '")';
}
?>
<br/><hr/>

<span id="toolbar">
<a href=".">Main Page</a> |
<a href="?action=create">Create a New Page</a> |
<a>Categories</a> |
<a>List of All Pages</a> |
<a>Random Page</a> |
<a>What Links Here</a> |
<a href="about.html">About</a> |
</span>
<br/><hr/>

<span id="content">
<div id="contenttoolbar">
<?php
if($action=='read'){echo '<a id="read_button">read</a> |';}
elseif($action=='edit'){echo '<a id="read_button">read (save)</a> |';}// SAVE THROUGH AJAX LINK
if($action=='edit'){echo ' <a id="edit_button">edit</a> |';}
else{echo ' <a href="' . $_SERVER['REQUEST_URI'] . '&action=edit" id="edit_button">edit</a> |';}// onclick="editor(\'' . $wanted_file . '\');"
echo ' <a target="_blank">edit history</a> ';// MAKE SURE IT OPENS A NEW TAB
?>
</div>
<br/><br/><br/>
<span id="mainpane">
<?php
/* "8 modes"
- main page
- read
- edit
- create
- list categories
- list all
- edit history
- previous version view
*/
// DETERMINE ACTION
if($action=='edit'){include "edit.php";}
elseif($action=='create'){
	if(isset($page)){
		include "name.php";
		if(isset($true_name) || $wanted_file!=""){
			include "read.php";
		}
		else{
			include "create.php";
		}
	}
	else{
		include "create.php";
	}
}
else{
	if(isset($page)){
		if(isset($_POST['maincontent'])){
			include "save.php";
		}
		else{
			include "read.php";
		}
	}
	else{
		include "mainpage.php";
	}
}
?>
</span>

</span>
<br/><br/><br/>
<div id="bottombar">wiki created by Brandon Wong in 2007. see edit history for writers of this page.</div>
<br/><br/>
</body>
</html>