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

		$obj->commandes = $this->db->where('id_peripherique', $obj->id)->get('commande')->result();
		$obj->defauts = $this->getDefauts($_id);
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
					->get('defaut')
					->result();

		return $results;
	}

	public function updateValeurPeripherique($_id_peripherique, $valeur){
		$this->db
				->set('valeur', $valeur)
				->set('last_heartbeat', date('Y-m-d H:i:s'))
				->where('id', $_id_peripherique)
				->update('peripherique');
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