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


	public function sendCommandeByIdCommande($id_commande){
		$obj = $this->db
					->join('peripherique p', 'p.id = c.id_peripherique')
					->join('type_peripherique t', 't.id = p.id_type_peripherique')
					->where('c.id', $id_commande)
					->get('commande c')
					->row();

		$this->sendCommande($obj);

	}

	public function sendCommandeByPerifAndValeur($id_peripherique,$valeur){
		$obj = $this->db
					->join('peripherique p', 'p.id = c.id_peripherique')
					->join('type_peripherique t', 't.id = p.id_type_peripherique')
					->where('p.id', $id_peripherique)
					->where('c.nouvelle_valeur', $valeur)
					->get('commande c')
					->row();
		
		$this->sendCommande($obj);
	}

	public function sendCommande($commande){
		$this->load->model('xpl_message'); 
		$this->xpl_message->init('xpl-cmnd', $commande->target, $commande->type_message, $commande->contenu);
		$this->xpl_message->send();

		$this->load->library('Arduihome_log');
		$this->arduihome_log->write("infos", "Envoi de la commande du perif : ".$commande->id_peripherique.", nouvelle valeur ".$commande->nouvelle_valeur);

		$this->peripherique_model->updateValeurPeripherique($commande->id_peripherique,$commande->nouvelle_valeur);
	}
}