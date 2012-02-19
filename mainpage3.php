<h5>currently, the only functionality here includes:</h5>
<pre>
- differentiating between "read" and "edit", both through $_GET and through ajax
- the most basic of editing (but don't type in # or &, etc., and you can forget about line breaks)

</pre>
<h5>at the moment, pages include:</h5>
<?php
$count = 0;
$the_master = simplexml_load_file("master.xml");
foreach($the_master->children() as $file){
	$attri = $file->attributes();
	if($attri['protected']=='true'){continue;}
	echo '<a href="' . /*$_SERVER['SCRIPT_NAME'] . */'?page=' . $file->name . '">' . $file->name . '</a><br/>';
	$count++;
}
echo 'Totalling ' . $count . 'page(s).';
?>