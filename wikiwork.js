function washcycle(){
	var xmltp;
	try{xmltp=new XMLHttpRequest();}
	catch(e){
		try{xmltp = new ActiveXObject("Msxml2.XMLHTTP");}
		catch(e){
			try{xmltp = new ActiveXObject("Microsoft.XMLHTTP");}
			catch(e){
				alert("Your browser does not support this particular AJAX-based page. To edit, add '&action=edit' to the url or change '&action=read' to '&action=edit'.");
				return false;
			}
		}
	}
	return xmltp;
}

/*function pony(action, attach){
	xmltp = washcycle();
	xmltp.onreadystatechange = function(){
		if(xmltp.readyState==4){//0-The request is not initialized, 1-The request has been set up, 2-The request has been sent, 3-The request is in process, 4-The request is complete
			document.getElementById("mainpane").innerHTML = xmltp.responseText;
		}
		else{
			document.getElementById("mainpane").innerHTML = "<h2>got nothing so far...</h2>";
		}
	}
	var place;
	if(action=='edit'){place="edit.php?";}// AJAX SERVER
	else if(action=='create'){place="create.php?";}
	place += "action=" + action
	place += "action=edit&method=ajax";
	xmltp.open("GET", place, true);
	xmltp.send(null);
}*/
function saver(){
	document.getElementById("contentform").submit();
}
/*function saver(){
	xmltp = washcycle();
	xmltp.onreadystatechange = function(){
		if(xmltp.readyState==4){//0-The request is not initialized, 1-The request has been set up, 2-The request has been sent, 3-The request is in process, 4-The request is complete
			document.getElementById("mainpane").innerHTML = xmltp.responseText;
			document.getElementById("read_button").innerHTML = 'read';
			document.getElementById("read_button").removeAttribute('onclick');
			document.getElementById("read_button").removeAttribute('href');
			document.getElementById("edit_button").onclick = '';// THIS HAS TO BE DEALT WITH
			document.getElementById("edit_button").href = '#';
		}
		else{
			document.getElementById("mainpane").innerHTML = "<h2>loading file...</h2>";
		}
	}
	var place;
	place="save.php?";// AJAX SERVER
	place += "action=edit&method=ajax&file=turtles.xml";
	place += "&contents=" + document.getElementById('maincontent').value;
	xmltp.open("GET", place, true);
	xmltp.send(null);
}*/
function editor(file){
	xmltp = washcycle();
	xmltp.onreadystatechange = function(){
		if(xmltp.readyState==4){//0-The request is not initialized, 1-The request has been set up, 2-The request has been sent, 3-The request is in process, 4-The request is complete
			document.getElementById("mainpane").innerHTML = xmltp.responseText;
			document.getElementById("read_button").innerHTML = 'read (save)';
			document.getElementById("read_button").onclick = 'saver();';
			document.getElementById("read_button").href = '#';
			document.getElementById("edit_button").removeAttribute('onclick');
			document.getElementById("edit_button").removeAttribute('href');
		}
		else{
			document.getElementById("mainpane").innerHTML = "<h2>loading file...</h2>";
		}
	}
	var place;
	place="edit.php?";// AJAX SERVER
	place += "action=edit&method=ajax";
	place += "&file=" + file;
	xmltp.open("GET", place, true);
	xmltp.send(null);
}