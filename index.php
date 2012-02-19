<?php
// ACTION?
$action = '';
switch($_GET['action']){
	case "edit":
		$action = "edit";
		break;
	case "create":
		$action = "create";
		break;
	default:
		$action = "read";
}
// WHAT TO DO?
$include_name = false;
$include_edit = false;
$include_save = false;
$include_main = false;
$include_read = false;
if(isset($_POST['page'])){$_GET['page']=$_POST['page'];}// just in case
if(isset($_GET['page'])){$include_name = true;}
if($action=='read'){
	if(isset($_POST['maincontent'])){$include_save = true;}
	else{
		if(isset($_GET['page'])){$include_read = true;}
		else{$include_main = true;}
	}
}
else{$include_edit = true;}
// READY, SET.....
$pagetitle = '';
$pageredirect = '';
$pagetoolbar = '';
$pagestatus = '';
$pagecontent = '';
// NOW DO IT!
if($include_name){include "name.php";}
if($include_edit){include "edit.php";}
if($include_save){include "save.php";}
if($include_main){include "mainpage.php";}
if($include_read){include "read.php";}





?>
<html>
<head>
<title>wiki
<?php
//***********************TITLE
echo $pagetitle;
?>
</title>
<!--APPLY WIKI STYLE-->
<link rel="stylesheet" type="text/css" href="wikistyle.css">
<!--INCLUDE WIKIWORK.JS-->
<!--<script type="text/javascript" src="wikiwork.js"></script>-->
</head>
<body>
<span id="titlebar">WIKI
<?php
//***********************TITLE
echo $pagetitle;
?>
</span>
<?php
//***********************REDIRECTED
echo $pageredirect;
?>
<br/>

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
//***********************TOOLBAR
echo $pagetoolbar;
?>
</div>
<br/>
<span id="mainpane">
<?php
//***********************STATUS LINE?
echo '<div id="statusbar">';
echo $pagestatus;
echo '</div>';
//***********************MAIN CONTENT
echo $pagecontent;
?>
</span>

</span>
<br/><br/>
<div id="bottombar">wiki created by Brandon Wong in 2007. see edit history for writers of this page.</div>
<br/><br/>
</body>
</html>