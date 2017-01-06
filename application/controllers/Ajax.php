<?php

class Ajax extends CI_Controller {
	
	public function sendCommande($_id_commande){

			$this->commande_model->sendCommandeByIdCommande($_id_commande);
	}


	public function save_scenario($_id_scenario){
		$this->load->model('scenario_model');
		/*print_r($_POST);
		print_r($this->input->post());*/
		$this->scenario_model->save($_id_scenario, $this->input->post());
	}


}