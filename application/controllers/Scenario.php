<?php

class Scenario extends CI_Controller {



	public function index(){


			$this->load->view('header');
			$this->load->view('scenario', array(
				'commandes' => $this->commande_model->findAll(),
				'peripheriques' => $this->peripherique_model->findAll()
				));
			$this->load->view('footer');
	}
}