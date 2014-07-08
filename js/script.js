jQuery(document).ready(function($) {
	//when document is ready, listen for search form for event of submit
	$("#search").on('submit', function(event) {
		//prevent the default action.
		event.preventDefault();
		loading="<img src='//jimpunk.net/Loading/wp-content/uploads/loading18.gif' height='250' width='250'>";
		//display a loading feedback using a image
		$("#table").html(loading);
		query=$("#query").val();
		//send a request to the server
		$.get('ajax/index.php?query='+query, function(data) {
			//as soon as the data is ready, insert into div#table
			$("#table").html(data);
			$("button").each(function (index){
				url=$(this).attr("href");
				$(this).load(url+" [data-card-type=photo] img");

			});
		});
	});
});