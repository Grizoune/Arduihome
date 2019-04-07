<?php

class Peripherique_model extends CI_Model{
	

	public function findAll(){
		$data = array();

		foreach($this->db->select('id')->get('peripherique')->result() as $periph){
			$data[] = $this->find($periph->id);
		}

		return $data;
	}

	public function find($_id){
		$obj = $this->db
					->select('z.*, p.*')
					->where('p.id', $_id)
					->join('zone z', 'z.id = p.id_zone')
					->get('peripherique p')
					->row();
		if(isset($obj)){
			$obj->commandes = $this->db->where('id_peripherique', $obj->id)->get('commande')->result();
			$obj->warns = $this->getDefauts($_id);
			$obj->errors = $this->getErrors($_id);
		}
		return $obj;
	}

	public function getValue($_id){

		$perif = $this->find($_id);
		return $perif->valeur;
	}

	public function getDefauts($_id){

		$results = $this->db
					->where('id_peripherique', $_id)
					->where('lue', 0)
					->where("type", "wrn")
					->get('defaut')
					->result();

		return $results;
	}

	public function getErrors($_id){

		$results = $this->db
					->where('id_peripherique', $_id)
					->where('lue', 0)
					->where('type', "err")
					->get('defaut')
					->result();

		return $results;
	}

	public function updateValeurPeripherique($_id_peripherique, $valeur){
		$this->config->load('arduihome');

		$this->db
				->set('valeur', $valeur)
				->set('last_heartbeat', date('Y-m-d H:i:s'))
				->where('id', $_id_peripherique)
				->update('peripherique');

		$perif = $this->find($_id_peripherique);
		if($perif->log_value == 1){

			
		if($this->config->item('influx_url')){
		
				$data = str_replace(" ","_", $perif->nom).",device=".$perif->target.",zone=".$perif->zone." value=".$valeur." ".(int)((microtime(true)*10000)*100000);
				echo $data."\n";

				$tuCurl = curl_init();
				curl_setopt($tuCurl, CURLOPT_URL, $this->config->item('influx_url')); 
				curl_setopt($tuCurl, CURLOPT_POST, 1);
				curl_setopt($tuCurl, CURLOPT_POSTFIELDS, $data); 

				$tuData = curl_exec($tuCurl); 
				if(!curl_errno($tuCurl)){
				  $info = curl_getinfo($tuCurl);
				  echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
				} else {
				  echo 'Curl error: ' . curl_error($tuCurl);
				}

				curl_close($tuCurl);
				echo $tuData."\n"; 
			}
		}
	}

	public function updateFavorisPeripherique($_id_peripherique, $valeur){
		$this->db
				->set('favoris', $valeur)
				->where('id', $_id_peripherique)
				->update('peripherique');
	}

	public function lock($_id_peripheriques){
			$q = $this->db->set('locked', 1);

			if(is_array($_id_peripheriques))
				$q->where('id IN ('.implode(",", $_id_peripheriques).')');
			else
				$q->where('id', $_id_peripheriques);

			$q->update('peripherique');
	}

	public function unlock($_id_peripheriques){
			$q = $this->db->set('locked', 0);

			if(is_array($_id_peripheriques))
				$q->where('id IN ('.implode(",", $_id_peripheriques).')');
			else
				$q->where('id', $_id_peripheriques);

			$q->update('peripherique');
	}
}