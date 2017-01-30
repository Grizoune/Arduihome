<?php

class Mode extends CI_Controller{

	public function index(){
		$this->load->view('header');
		$this->load->view('modes',array(
			'modes' => $this->mode_model->findAll()

		));
		$this->load->view('footer');
	}


	public function edit_activation($id_mode){
			$mode = $this->mode_model->find($id_mode);
			$mode->xml = $mode->active_xml;
			$mode->nom = "activation du mode : ".$mode->nom;

			$this->load->view('header');
			$this->load->view('scenario', array(
				'obj' => $mode,
				'type' => 'mode_activation',
				'commandes' => $this->commande_model->findAll(),
				'peripheriques' => $this->peripherique_model->findAll()
				));
			$this->load->view('footer');
	}

	public function edit_desactivation($id_mode){

			$mode = $this->mode_model->find($id_mode);
			$mode->xml = $mode->desactive_xml;
			$mode->nom = "desactivation du mode : ".$mode->nom;

			$this->load->view('header');
			$this->load->view('scenario', array(
				'obj'=> $mode,
				'type' => 'mode_desactivation',
				'commandes' => $this->commande_model->findAll(),
				'peripheriques' => $this->peripherique_model->findAll()
				));
			$this->load->view('footer');
	}
}