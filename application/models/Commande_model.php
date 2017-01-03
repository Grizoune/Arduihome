<?php

class Commande_model extends CI_Model{
	
	public function find($_id_commande){
		$obj = $this->db
					->join('peripherique p', 'p.id = c.id_peripherique')
					->join('type_peripherique t', 't.id = p.id_type_peripherique')
					->where('c.id', $_id_commande)
					->get('commande c')
					->row();

		return $obj;
	}

	public function findAll(){
				$objs = $this->db
					->select('c.*, p.*, t.*, z.*, p.nom as peripherique, c.nom as nom, c.id as id')
					->join('peripherique p', 'p.id = c.id_peripherique')
					->join('type_peripherique t', 't.id = p.id_type_peripherique')
					->join('zone z', 'z.id = p.id_zone')
					->order_by('zone, peripherique')
					->get('commande c')
					->result();
		return $objs;
	}


	public function sendCommande($id_commande){
		$obj = $this->db
					->join('peripherique p', 'p.id = c.id_peripherique')
					->join('type_peripherique t', 't.id = p.id_type_peripherique')
					->where('c.id', $id_commande)
					->get('commande c')
					->row();
		
		$this->load->model('xpl_message'); 
		$xpl_message = new xpl_message();
		$xpl_message->send('xpl-cmnd', $obj->target, $obj->type_message, $obj->contenu);
	}
}