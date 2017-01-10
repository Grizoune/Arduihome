
function sendCommande(_id_commande){
	$.ajax(site_url+"/ajax/sendCommande/"+_id_commande )
  	.done(function() {
  	  
 	 });
}

function restartServeur(){

	$.ajax(site_url+"/ajax/startServeur")
  	.done(function() {
  	  alert("redemarrage du serveur ok !");
 	 });
}

$(function () {
	actualise_demon_status();
	setInterval(actualise_demon_status, 5000);
});

function actualise_demon_status(){
	$.ajax({
	  url: site_url+"/ajax/demondStatus"
	}).done(function( data ) {
		if(data == "1"){
			$('#demon-statut').html("Serveur ok");
			$('#demon-statut').removeClass("btn-outline-danger");
			$('#demon-statut').addClass("btn-outline-success");
		}else{
			$('#demon-statut').html("Serveur done !");
			$('#demon-statut').removeClass("btn-outline-success");
			$('#demon-statut').addClass("btn-outline-danger");	
		}
	});
}