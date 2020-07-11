if(window.XMLHttpRequest)
	xmlhttp=new XMLHttpRequest();
else
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

function change(data)
		{
			document.getElementById("year-sem").innerHTML=data;
			data=data.split("-");
			var year=data[0];
			var semester=data[1];

			xmlhttp.onreadystatechange=function()
				{
					if(this.readyState==4 && this.status==200);
				};

			xmlhttp.open("GET","/FOE/common/createdb.php?year="+year+"&semester="+semester,true);
			xmlhttp.send();
		}