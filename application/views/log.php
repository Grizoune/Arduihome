<div id="zone-log"></code>


<script>

function load_log(){
	$.ajax({
	  url: site_url+"/ajax/log/<?php echo $type; ?>"
	}).done(function( data ) {
		$('#zone-log').html(data);
	});
}

$(function () {
	load_log();
});

setInterval(load_log, 1000);


</script>