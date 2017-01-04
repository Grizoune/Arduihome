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
		return $obj;
	}
}