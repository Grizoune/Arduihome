<?php

include "Scenario_model.php";

class Mode_model extends Scenario_model{

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
		$mode = $this->find($id_mode);
		$this->save($id_mode, array('active'=>1));
		eval($mode->active_code);
	}

	public function desactive($id_mode){
		$mode = $this->find($id_mode);
		$this->save($id_mode, array('active'=>0));
		eval($mode->desactive_code);
	}

	public function sendCommande($_id_commande){
		$this->commande_model->sendCommande($this->commande_model->find($_id_commande));
		time_nanosleep(0,300000000);
	}

}