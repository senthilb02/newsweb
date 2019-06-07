<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
       <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	   
	   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<style>

</style>

        <!-- Styles -->

    </head>
    <body>
  
   <div class="container">
    <div class="col-md-12 text-center">
<h1>News search</h2>
</div>  

</div>
<hr>     
<div class="container">

<form>

<div class="row">
	
	<div class="col-md-6 col-md-offset-3">
	<select id="dates-field2" name="searchNews[]" class="multiselect-ui form-control">
	
            <option value="Donald Trump">Donald Trump</option>
            <option value="Blockchain"> Blockchain</option>
 
     </select>
	 </div>
		

	
<div class="col-md-2">
		<input type="button" id="search" value="submit">
</div>
</div>
<div class="row">
<div id="dynamicTable">

</div>
<div id="error"></div>
</div>


<div class="row">
<div class="col-md-12 text-center">
<h1>Domain search</h2>
</div>  

</div>

	<div class="col-md-10">
	<div class="col-md-4">
	Domain Search
	<select id="websitesearch" name="searchNews[]" class="multiselect-ui form-control">
			
            <option value="yahoo.com">bbc.com</option>
            <option value="wsj.com">wsj.com</option>
     </select>
	 </div>
		<div class="col-md-4">
			From Date(YYYY-mm-dd)
			<input type="text" id="datevf">
		
		</div>
		<div class="col-md-4">
		To Date(YYYY-mm-dd)
			<input type="text" id="datevt">
		
		</div>
	</div>
	
<div class="col-md-2">
		<input type="button" id="search2" value="submit">
</div>
</div>
<div class="col-md-12">
<div id="dynamicTable2">

</div>
<div id="error2"></div>
</div>
</form>


				
</div>

<script type="text/javascript">
var CSRF_TOKEN= "{{ csrf_token() }}";

$('#search').on('click',function(e){
	
	var searchv=$('#dates-field2').find(":selected").text();
	var seardate=$('#datev').val();
	var searchvalue = 'searchNews='+searchv+'&_token='+CSRF_TOKEN;
	var inHTML = "";
	$.ajax
	({
		Type:'post',
		dataType:'json',
		url:'search',
		data:searchvalue,
		success:function(response)
		{
			console.log(response.searchv);
			
			if(response.success == true)
			{
			$.each( response.searchv, function( key, value ) {
				console.log(value.urlToImage);
				
				var newItem ="<div class='col-md-4' style='margin-top:10px; '><div style='border:1px solid #666;height:400px;'> <a href="+value.url+" target='_blank'><div class='text-center'><img width='200' height='200px' style='margin:auto;' src="+value.urlToImage+" ></div><h1 style='font-size:17px;'>"+ value.title+"</h1></a><p>Author: "+value.author+"</p><p>"+value.description+"</p></div></div>";
				/* var newItem = "<details><summary>"+value.title+"</summary><table><tr><td>"+ value.author + "</td><td>"+ value.title+ "</td><td><img width='200' src="+ value.urlToImage+ "></td><td>"+value.content+ "</td><td>"+value.description+ "</td></tr></table></details>" */
				inHTML += newItem;
			});
			$("div#dynamicTable").html(inHTML);
			}
			if(response.success == false)
			{
				var error = response.message;
				$("table#dynamicTable").html();
				$("#error").html(error);
			}
		}
		

		
		
	});
});

	$('#search2').on('click',function(e){
	
	var searchv2=$('#websitesearch').find(":selected").text();
	var seardate=$('#datevf').val();
	var seardatet=$('#datevt').val();
	var searchvalue2 = 'searchwebsite='+searchv2+'&date='+seardate+'&datet='+seardatet+'&_token='+CSRF_TOKEN;
	var inHTML2 = "";
	$.ajax
	({
		Type:'post',
		dataType:'json',
		url:'websitesearch',
		data:searchvalue2,
		success:function(response)
		{
			if(response.success == true)
			{
			//console.log(response.searchv);
			$.each( response.searchv, function( key, value ) {
				console.log(value);
					var newItem ="<div class='col-md-4' style='margin-top:10px; '><div style='border:1px solid #666;height:400px;'> <a href="+value.url+" target='_blank'><div class='text-center'><img width='200' height='200px' style='margin:auto;' src="+value.urlToImage+" ></div><h1 style='font-size:17px;'>"+ value.title+"</h1></a><p>Author: "+value.author+"</p><p>"+value.description+"</p></div></div>";
				inHTML2 += newItem;
			});
			$("div#dynamicTable2").html(inHTML2);
			}
			if(response.success == false)
			{
				var error2 = response.message;
				$("#error2").html(error2);
			}
			
		}
		

		
		
	});
	
});

</script>
    </body>
</html>
