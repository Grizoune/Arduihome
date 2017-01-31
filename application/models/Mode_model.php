<?php

include "Scenario_model.php";

class Mode_model extends Scenario_model{

	private $perif_modifies;


	public function find($_id){
		return $this->db
			->where('id', $_id)
			->get('mode')
			->row();
	}

	public function findAll(){
		return $this->db
			->get('mode')
			->result();
	}

	public function save($_id, $datas){
		foreach($datas as $key=>$data)
				$datas[$key] = $data;

		$this->db->where('id', $_id);
		$this->db->update('mode', $datas); 
	}

	public function active($id_mode){
		$this->perif_modifies = array();

		$mode = $this->find($id_mode);
		$this->save($id_mode, array('active'=>1));
		eval($mode->active_code);

		$this->peripherique_model->lock($this->perif_modifies);
	}

	public function desactive($id_mode){
		$this->perif_modifies = array();

		$mode = $this->find($id_mode);
		$this->save($id_mode, array('active'=>0));
		eval($mode->desactive_code);

		$this->peripherique_model->unlock($this->perif_modifies);
	}

	public function sendCommande($_id_commande){
		$commande = $this->commande_model->find($_id_commande);
		$this->commande_model->sendCommande($commande);
		$this->perif_modifies[] = $commande->id_peripherique;

		time_nanosleep(0,300000000);
	}

}