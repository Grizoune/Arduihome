<?php

class Defaut_model extends CI_Model{



	public function add($message){
		$peripherique = $this->peripherique_model->find($message->peripherique);

		$this->db->insert('defaut', array(
		"defaut_date"=> Date("Y-m-d H:i:s"),
		"id_peripherique"=>(int)$peripherique->id,
		"type"=>$message->commandes["type"],
		"libelle"=>$message->commandes["text"],
		"code"=>(int)$message->commandes["code"]
		));
	}
}