<div id="zone-log"></div>


<script>

function load_log(){
	$.ajax({
	  url: site_url+"/ajax/log/<?php echo $type; ?>"
	}).done(function( data ) {
		$('#zone-log').html("<div>"+data+"</div>");
	});


	$('#zone-log').scrollTop($('#zone-log div').height());

}

$(function () {
	load_log();
});

setInterval(load_log, 1000);


</script>