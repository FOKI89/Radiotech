$(document).ready(function(){
		var user_id = $("h2").data("user_id");
		var filename = $("h2").text() + ".mp3";
		$("#audio_player").attr("src", data_array.site_url+"/wp-content/plugins/audiostream/streaming.php?user_id="+user_id+"&filename="+filename);
});