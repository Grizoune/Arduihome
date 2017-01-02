<?php

class Serveur_XPL
{
	function interprete($source, $type_message, $commandes){

		$CI =& get_instance();
		$CI->load->model('arduino_interface');
		
		$fonctionnalite = $CI->db->select('f.*, fct.*, z.libelle as zone, f.id as id')
							->where('f.id',$commandes['device'])
							->join('zone z', 'z.id = f.zone_id')
							->join('fonction fct', 'fct.id = f.fonction_id')
							->get('fonctionnalite f')->row();
		
		//on actualise la valeur et l'heure de la derniere mise à jours
		if($fonctionnalite->nom_variable_valeur != ""){
			$CI->db->set(array(
				'valeur'=>$commandes[$fonctionnalite->nom_variable_valeur], 
				'dernier_update'=>date('Y-m-d H:i:s')))
				->where('id', $fonctionnalite->id)
				->update('fonctionnalite');
				
			echo date('Y-m-d H:i:s')." update : ".$fonctionnalite->libelle.", Zone : ".$fonctionnalite->zone.", device :".$fonctionnalite->id.", valeur ".$commandes[$fonctionnalite->nom_variable_valeur]."\n";
		}else{
			echo date('Y-m-d H:i:s')." message ignoré : ".$fonctionnalite->libelle.", Zone : ".$fonctionnalite->zone.", device :".$fonctionnalite->id."\n";
		}
		
					
		$this->make();
		
		//recherche si jamais la valeur est dans un graphique
		$graphiques = $CI->db->from("graphique g")
		->join("graphique_has_fonctionnalite ghf", "ghf.graphique_id = g.id")
		->where("ghf.fonctionnalite_id", $fonctionnalite->id)
		->get()->result();
		
		foreach($graphiques as $graphique){
				$rrdFile = dirname(__FILE__) . "/../../graphiques/".$graphique->id.".rrd";
				
				if(!file_exists($rrdFile)){
					$creator = new RRDCreator($rrdFile, "now -1h", 60);
					$creator->addDataSource("val1:GAUGE:600:-50:100");
					$creator->addArchive("AVERAGE:0.5:1:525600");
					$creator->save();
				}
				
				$updater = new RRDUpdater($rrdFile);
				$updater->update(array("val1" => $commandes[$fonctionnalite->nom_variable_valeur]),mktime());
				
				$outputPngFile1 = dirname(__FILE__) . "/../../graphiques/".$graphique->id."-1.png";
				$graphObj1 = new RRDGraph($outputPngFile1);
				$graphObj1->setOptions(
					array(
						"--start" => (mktime()-50000),
						"--end" => mktime(),
						"--upper-limit" => 30,
						"--lower-limit" => 0,
						"--vertical-label" => $graphique->legende,
						"DEF:ligne=$rrdFile:val1:AVERAGE",
						"LINE1:ligne#FF0000"
					)
				);
				$graphObj1->save();
				
				$outputPngFile2 = dirname(__FILE__) . "/../../graphiques/".$graphique->id."-2.png";
				$graphObj2 = new RRDGraph($outputPngFile2);
				$graphObj2->setOptions(
					array(
						"--start" => (mktime()-86400),
						"--end" => mktime(),
						"--upper-limit" => 30,
						"--lower-limit" => 0,
						"--vertical-label" => $graphique->legende,
						"DEF:ligne=$rrdFile:val1:AVERAGE",
						"LINE1:ligne#FF0000"
					)
				);
				$graphObj2->save();
				
				$outputPngFile3 = dirname(__FILE__) . "/../../graphiques/".$graphique->id."-3.png";
				$graphObj3 = new RRDGraph($outputPngFile3);
				$graphObj3->setOptions(
					array(
						"--start" => (mktime()-604800),
						"--end" => mktime(),
						"--upper-limit" => 30,
						"--lower-limit" => 0,
						"--vertical-label" => $graphique->legende,
						"DEF:ligne=$rrdFile:val1:AVERAGE",
						"LINE1:ligne#FF0000"
					)
				);
				$graphObj3->save();

		}		

	}

	function make_hbeat($carte){
		$CI =& get_instance();
		$tab_source = explode(".",$carte);
		$nom = $tab_source[1];

		$CI->db->set(
		array('dernier_headbeat'=>date('Y-m-d H:i:s')))
		->where('nom', $nom)
		->update('interface');

		echo "headBeat : ".$carte."\n";
	}
	
	function make(){
	
		$CI =& get_instance();
		$CI->load->model('arduino_interface');
		$CI->load->model('xpl_message');


		include "config/inteligence.php"; 
	}
}
