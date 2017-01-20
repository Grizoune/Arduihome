<?php

class Zone_model extends CI_Model{

	public function  getZones(){
			$zones = $this->db->order_by('ordre')->get('zone')->result();
			return $zones;

	}

	public function BuildFavorisZone(){
		$zone = new StdClass();
		$zone->zone = 'Mes favoris';
		$zone->image = 'etoile';
		$zone->id = null;

		return $zone;
	}

	public function find($id_zone){
		return  $this->db->where('id', $id_zone)->get('zone')->row();
	}	

	public function getPeripheriques($zone){
		if($zone->id)
			$periphs = $this->db->where('id_zone', $zone->id)->get('peripherique')->result();
		else
			$periphs = $this->db->where('favoris', 1)->get('peripherique')->result();

		$peripheriques = array();

		foreach($periphs as $periph)
			$peripheriques[] = $this->peripherique_model->find($periph->id);

		return $peripheriques;

	}
}