<?php

class Defaut_model extends CI_Model{



	public function add($message){
		$this->load->library('Arduihome_log');

		$peripherique = $this->peripherique_model->find($message->peripherique);

		$this->db->insert('defaut', array(
		"defaut_date"=> Date("Y-m-d H:i:s"),
		"id_peripherique"=>(int)$peripherique->id,
		"type"=>$message->commandes["type"],
		"libelle"=>$message->commandes["text"],
		"code"=>(int)$message->commandes["code"]
		));

		$this->arduihome_log->write("default-device-".$peripherique->id, "[".$message->commandes["type"]."][".$message->commandes["code"]."] - ".$message->commandes["text"]);
	}
}