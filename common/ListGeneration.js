if(window.XMLHttpRequest)
	xmlhttp=new XMLHttpRequest();
else
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

fun();

	function fun()
	{	
		var urlParams = new URLSearchParams(window.location.search);
		var fun=urlParams.get('function');
		// alert(fun);


		xmlhttp.onreadystatechange=function()
		{
			if(this.readyState==4&&this.status==200)
				document.getElementById("one").innerHTML=this.responseText;
		};

		xmlhttp.open("GET","show.php?function="+fun,true);
		xmlhttp.send();
	}

	function fun1()
	{
		var branch=document.getElementById("branch").value;

		xmlhttp.onreadystatechange=function()
		{
			if(this.readyState==4&&this.status==200)
				document.getElementById("tw").innerHTML=this.responseText;
		};
		xmlhttp.open("GET","show.php?branch="+branch+"&submitted_list=submitted_list",true);
		xmlhttp.send();
	}

	function fun2()
	{
		var branch=document.getElementById("branch").value;
		var oe_sub=document.getElementById("sub").value;
		xmlhttp.onreadystatechange=function()
		{
			if(this.readyState==4&&this.status==200)
				document.getElementById("tw").innerHTML=this.responseText;
		};
		xmlhttp.open("GET","show.php?branch="+branch+"&alloted_list=alloted_list&oe_sub="+oe_sub,true);
		xmlhttp.send();
	}

	function fun3()
	{
		var branch=document.getElementById("branch").value;

		xmlhttp.onreadystatechange=function()
		{
			if(this.readyState==4 && this.status==200)
				document.getElementById("tw").innerHTML=this.responseText;
		};
		xmlhttp.open("GET","show.php?branch="+branch+"&unalloted_list=unalloted_list",true);
		xmlhttp.send();
	}

	// function excel_download()
	// {
	// 	var branch=document.getElementById("branch").value;
	// 	var oe_sub='None';
	// 	try
	// 	{
	// 		oe_sub=document.getElementById("sub").value;
	// 	}
	// 	catch(err){}
	// 	finally
	// 	{
	// 		var title=document.getElementById("title").innerText();
	// 		xmlhttp.onreadystatechange=function()
	// 		{
	// 			if(this.readyState==4 && this.status==200)
	// 				document.getElementById("").innerHTML=this.responseText;
	// 		};
	// 		xmlhttp.open("GET","exce_download.php?branch="+branch+"&list="+title+"&oe_sub="+oe_sub,true);
	// 		xmlhttp.send();
	// 	}
	// }

	function excel_download()
    {
     var branch=document.getElementById("branch").value;
     var oe_sub='None';
     try
     {
      oe_sub=document.getElementById("sub").value;
     }
    catch(err){}
     var title=document.getElementById("title").innerText;
     
     window.open("excel_download.php?branch="+branch+"&list="+title+"&oe_sub="+oe_sub);
    }