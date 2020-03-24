<?php 
function heure_leve($current_time=null){
	$long = 47.27;
	$lat = 0.52;

	if(empty($current_time))
		$current_time = time();
	return date_sunrise($current_time, SUNFUNCS_RET_STRING, $long, $lat, 90, 1);
}

function heure_couche($current_time=null){
	$long = 47.27;
	$lat = 0.52;

	if(empty($current_time))
		$current_time = time();
	return date_sunset($current_time, SUNFUNCS_RET_STRING, $long, $lat, 90, 1);
}

function h_leve($current_time=null){
	$tab_couche = explode(":",heure_leve($current_time));
	return $tab_couche[0]*60 + $tab_couche[1];
}

function h_couche($current_time=null){
	$tab_leve = explode(":",heure_couche($current_time));
	return $tab_leve[0]*60 + $tab_leve[1];
}

function heure_courante(){
	return date('G')+":"+date('i');
}

function h_courante(){
	return date('G')*60+date('i');
}

function sun_time(){
	$min = (h_couche()-h_leve())-(h_couche(time()-86400)-h_leve(time()-86400));
	if($min > 0)
		return "+".$min;
	elseif($min < 0)
		return "-".$min;
}