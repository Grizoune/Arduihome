<?php

class Ajax extends CI_Controller {
	
	public function sendCommande($_id_commande){

			$this->commande_model->sendCommandeByIdCommande($_id_commande);
	}

	public function update_mode($mode_id){
		$mode = $this->mode_model->find($mode_id);

		if($mode->active)
			$this->mode_model->desactive($mode_id);
		else
			$this->mode_model->active($mode_id);
		
	}


	public function save_scenario($_id_scenario){
		$this->load->model('scenario_model');
		$this->scenario_model->save($_id_scenario, $this->input->post());
	}

	public function save_activation($_id_mode){
		$this->mode_model->save($_id_mode, $this->input->post());
	}

		public function save_desactivation($_id_mode){
		$this->mode_model->save($_id_mode, $this->input->post());
	}

	public function log($type){
		$this->load->library('Arduihome_log');
		$content = $this->arduihome_log->getContent($type);
		$content = str_replace("\n", "<br/>", $content);
		echo $content;
	}

	public function demondStatus(){

		header("Access-Control-Allow-Origin: *");              // Tous les domaines

		$this->load->library('Arduihome_demon');

		$data_peripheriques = $this->db
			->select('id, valeur')
			->get('peripherique')
			->result_array();

		$data_modes = $this->db
			->select('id, active')
			->get('mode')
			->result_array();

		$data = array(
			'demon_status' => (int)$this->arduihome_demon->getStatut(),
			'peripheriques_status' => $data_peripheriques,
			'modes_status' => $data_modes
			);


		header('content-type: application/json');
		echo json_encode($data);
	}

	public function startServeur(){
		$this->load->library('Arduihome_demon');
		$this->load->library('Arduihome_log');
		$this->arduihome_log->write("infos", "redemarrage manuel du serveur");
		if($this->arduihome_demon->getStatut() ==0)
				$this->arduihome_demon->startProcess();
	}

	public function favoris($id_perif){
		$perif = $this->peripherique_model->find($id_perif);

		if($perif->favoris == 0)
			$this->peripherique_model->updateFavorisPeripherique($id_perif, 1);
		else
			$this->peripherique_model->updateFavorisPeripherique($id_perif, 0);


	}

}