@extends('app')

@section('content')

<div class="container">
	<div id="word"><span class="spang">G</span><span class="spano">o</span><span class="spano2">o</span><span class="spang2">g</span><span class="
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

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$( "#searchTerm" ).keyup(function() 
{
  	//$('.container').empty();
  	doSearch();
});

function doSearch()
{
  	/*$(".container").append($("<div>", {
                    class: "col-lg-12 ",
                    id: "titulo_tipoPedido",
                    html:"<span class='text-blue'>hola</span>"
                }));*/

  	var query = $("#searchTerm").val()

      $.ajax({
      url: "https://api.chucknorris.io/jokes/search?query={query}",	
      type: 'POST',
      data: {_token: CSRF_TOKEN, query: $("#searchTerm").val()},
      //data: {_token: CSRF_TOKEN, query:query},
      dataType: 'JSON',
      success: function (data)
      {
        	console.log(data);   
      }});
}

// random button
$(".btn-luck").on("click", function()
{
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


