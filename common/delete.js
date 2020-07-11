if(window.XMLHttpRequest)
	xmlhttp=new XMLHttpRequest();
else
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

function search()
{
	var id=document.getElementById("rollno_field").value;
	xmlhttp.onreadystatechange=function()
	{
		if(this.readyState==4&&this.status==200)
			document.getElementById("three").innerHTML=this.responseText;
	};
	xmlhttp.open("GET","ConfirmDelete.php?id="+id,true);
	xmlhttp.send();
}
function del()
{
	ids="";
	var checked=document.getElementsByName("c_del");
	var radio_btn_response="";
	if(document.getElementsByName("radio_btn_response")[0].checked)
		radio_btn_response="CR"
	else if(document.getElementsByName("radio_btn_response")[1].checked)
		radio_btn_response="RSDP"
	var count=0;
	n=checked.length;
	for(i=0;i<n;i++)
	{
		if(checked[i].checked==true)
		{
			ids=ids+"'"+checked[i].value+"'";
			if(i<n-1)
			ids=ids+",";
			count++;
		}

	}
	if(count==0)
		alert('Records are Not Selected...!');
	else
	{
		ids=ids.substr(0,ids.length);
		xmlhttp.onreadystatechange=function()
		{
		if(this.readyState==4&&this.status==200)
			document.getElementById("three").innerHTML=this.responseText;
		};
		xmlhttp.open("GET","ConfirmDelete.php?ids="+ids+"&radio_btn_response="+radio_btn_response,true);
		xmlhttp.send();
	}
}