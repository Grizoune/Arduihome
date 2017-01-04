<?php

class Ajax extends CI_Controller {
	
	public function sendCommande($_id_commande){

			$this->commande_model->sendCommande($_id_commande);
	}


	public function save_scenario(){
		print_r($this->input->post());
	}
}