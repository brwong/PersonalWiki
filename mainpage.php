<?php
$pagetitle = '';
$pageredirect = '';
$pagetoolbar = '';
$pagestatus = '';
$pagecontent .= '<h5>currently, all the basic functionalities of a wiki are available</h5>
<pre>
this includes:
- reading pages
- editing pages
- creating pages
these actions are only available through standard form GET and POST methods
 is a possible future upgrade, but things seem to work just fine like this.
 besides, I want to focus on other things.
other things:
- edit history
- security/user accounts
- talk pages
- random page (how is this done?)
- categories
- other editable organization of pages
- keywords
- internal page linking ***important
- source code sections

</pre>
<h5>at the moment, pages include:</h5>';
$count = 0;
$the_master = simplexml_load_file("master.xml");
foreach($the_master->children() as $file){
	$attri = $file->attributes();
	if($attri['protected']=='true'){continue;}
	$pagecontent .= '<a href="' . /*$_SERVER['SCRIPT_NAME'] . */'?page=' . $file->name . '">' . $file->name . '</a><br/>';
	$count++;
}
$pagecontent .= 'Totalling ' . $count . 'page(s).';
?>