if(window.XMLHttpRequest)
	xmlhttp=new XMLHttpRequest();
else
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

track();

function track()
{
	xmlhttp.onreadystatechange=function()
	{
		if(this.readyState==4 && this.status==200)
			document.getElementById('track').innerHTML=this.responseText;
	};
		xmlhttp.open("GET","availability.php",true);
		xmlhttp.send();
}