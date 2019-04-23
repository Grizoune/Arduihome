
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
			$('#demon-statut').html("Serveur ok - "+data.timeserver);
			$('#demon-statut').removeClass("btn-outline-danger");
			$('#demon-statut').addClass("btn-outline-success");
		}else{
			$('#demon-statut').html("Serveur done !");
			$('#demon-statut').removeClass("btn-outline-success");
			$('#demon-statut').addClass("btn-outline-danger");	
		}
			$('.bouton').addClass("btn-primary");

		for(i=0; i < data.peripheriques_status.length; i++){
				$('.bouton-'+data.peripheriques_status[i].id+"-"+(data.peripheriques_status[i].valeur).replace(".","-")).removeClass("btn-primary");

				if(data.peripheriques_status[i].locked == "1")
					$('.verou-'+data.peripheriques_status[i].id).show();
				else
					$('.verou-'+data.peripheriques_status[i].id).hide();
		}	

		for(j=0; j < data.modes_status.length; j++){
				if(data.modes_status[j].active == "1"){
					$('.mode-'+data.modes_status[j].id).html("Desactiver");
					$('.mode-'+data.modes_status[j].id).addClass("btn-danger");
				}else{
					$('.mode-'+data.modes_status[j].id).html("Activer");
					$('.mode-'+data.modes_status[j].id).addClass("btn-success");
				}

		}	
	});
}

function ajoutFavoris(id_peripherique){
	$.ajax(site_url+"/ajax/favoris/"+id_peripherique)
  	.done(function() {
  	  window.location.reload();
 	 });
}

function changeBtnMode(id_mode){
	if($('.mode-'+id_mode).html() == "Activer"){
			$('.mode-'+id_mode).removeClass("btn-success");
			$('.mode-'+id_mode).addClass("btn-danger");
			$('.mode-'+id_mode).html("Desactiver");
	}else{
			$('.mode-'+id_mode).removeClass("btn-danger");
			$('.mode-'+id_mode).addClass("btn-success");
			$('.mode-'+id_mode).html("Activer");
	}
}

function activeMode(id_mode){
	changeBtnMode(id_mode);

	$.ajax(site_url+"/ajax/update_mode/"+id_mode)
  	.done(function() {

 	 });
}