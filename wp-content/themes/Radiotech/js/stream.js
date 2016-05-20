$(document).ready(function(){
	$("#button").on('click', function(){
		var filename = $(this).data("name");
		$("#audio_player").attr("src", "/wordpress/wp-content/plugins/videostream/streaming.php?filename="+filename);
		$('#audio_player').get(0).play();

		/*jQuery.post(
		    ajaxurl,
		    {
		        'action': 'read_stream',
		        'param': filename
		    },
		    function(response){
		    	console.log(response);
		    }
		);*/
	});
});