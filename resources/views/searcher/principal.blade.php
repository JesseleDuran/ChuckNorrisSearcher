@extends('app')

@section('content')

<div id="rectangle" style="display: none;"></div>
<div class="container" >
	<div id="word" style="position: relative;"><span class="spang">G</span><span class="spano">o</span><span class="spano2">o</span><span class="spang2">g</span><span class="
	    spanl">l</span><span class="spane">e</span>
	</div>
	    <div class="search">
	    	<input type="Text" vname="" class="search-box" maxlength="100" id="searchTerm">
	    </div>

	    <div class="btn-search" >
	    	Google Search
	    </div>
	    <div class="btn-luck">
	    	Feeling Random
	    </div>
</div>		    
	    <div class="searchResults">
  			<div class="container-fluid">
    			<div class="displayResults">
    			</div><!-- end displayResults -->
  			</div><!-- end container-fluid -->
		</div><!-- end searchResults -->
    
@stop

@section('scripts')

<script type="text/javascript">
var bandera = false;

$( "#searchTerm" ).keyup(function() 
{
  	doSearch();
});

function doMovimiento()
{

        $('.container').animate({'marginTop':"-=200px",
        							'marginLeft' : "-=100px"
    							});
        $('#searchTerm').animate({'marginTop':"-=40px",
        						  'marginLeft' : "-=200px"
    							});

        $('#word').animate({
        	'marginTop' : "+=50px",
        	'marginLeft' : "-=300px",
        	'font-size': "3em"
        });

        $('.btn-search').hide();
        $('.btn-luck').hide();
        $('#rectangle').show();
	

	bandera = true;
}


function doSearch()
{
	 $(".displayResults").html("");
  	var query = $("#searchTerm").val()

  	if (query.length >= 3) 
  	{
  		if (bandera == false) 
  		{
  			doMovimiento();
  		};
      	$.ajax({
      	url: "https://api.chucknorris.io/jokes/search?query="+ query,	
      	type: 'GET',
      	success: function (entry) 
      	{
      		console.log(entry);
      		for(var i = 0; i < entry.result.length; i++)
      		{	
        		$(".displayResults").append("<div class=\"searchResult\"><a href=\"" + entry.result[i].url + "\" target=\"_blank\"><h3>" + entry.result[i].id + "</h3></a><p class=\"resultLink\">" + entry.result[i].url + "</p><p>" + entry.result[i].value + "</p></div>");
      		}
    	}
  	});

  	};

}

// random button
$(".btn-luck").on("click", function()
{
	$(".displayResults").html("");
	$.getJSON("https://api.chucknorris.io/jokes/random", function(json)
	{
    	$(".displayResults").append("<div class=\"searchResult\"><a href=\"" + 
    		json.url + "\" target=\"_blank\"><h3>" + json.id + 
    		"</h3></a><p class=\"resultLink\">" + json.url + "</p><p>" + 
    		json.value + "</p></div>");
	});
});

// search button
$(".btn-search").on("click", function()
{
  	doSearch();
});

</script>

@endsection


