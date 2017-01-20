
function sendCommande(_id_commande){
	$.ajax(site_url+"/ajax/sendCommande/"+_id_commande )
  	.done(function() {
  	  actualise_demon_status();
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
	setInterval(actualise_demon_status, 15000);
});

function actualise_demon_status(){
	$.ajax({
	  url: site_url+"/ajax/demondStatus"
	}).done(function( data ) {
		if(data.demon_status == "1"){
			$('#demon-statut').html("Serveur ok");
			$('#demon-statut').removeClass("btn-outline-danger");
			$('#demon-statut').addClass("btn-outline-success");
		}else{
			$('#demon-statut').html("Serveur done !");
			$('#demon-statut').removeClass("btn-outline-success");
			$('#demon-statut').addClass("btn-outline-danger");	
		}
			$('.bouton').addClass("btn-primary");
		for(i=0; i < data.peripheriques_status.length; i++){
				$('.bouton-'+data.peripheriques_status[i].id+"-"+data.peripheriques_status[i].valeur).removeClass("btn-primary");
		}	
	});
}

function ajoutFavoris(id_peripherique){
		$.ajax(site_url+"/ajax/favoris/"+id_peripherique)
  	.done(function() {
  	  window.location.reload();
 	 });
}