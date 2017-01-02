
function sendCommande(_id_commande){

	$.ajax(site_url+"/ajax/sendCommande/"+_id_commande )
  	.done(function() {
  	  
 	 });

}