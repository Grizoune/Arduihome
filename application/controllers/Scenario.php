<?php

class Scenario extends CI_Controller {

	public function edit($_id){
			$this->load->model('scenario_model');

			$this->load->view('header');
			$this->load->view('scenario', array(
				'scenario' => $this->scenario_model->find($_id),
				'commandes' => $this->commande_model->findAll(),
				'peripheriques' => $this->peripherique_model->findAll()
				));
			$this->load->view('footer');
	}
}