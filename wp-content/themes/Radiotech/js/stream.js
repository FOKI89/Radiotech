$(document).ready(function(){
	$("#button").on('click', function(){
		var filename = $(this).data("name");
		$("#audio_player").attr("src", "/wordpress/wp-content/plugins/audiostream/streaming.php?filename="+filename);
		$('#audio_player').get(0).play();
	});
});