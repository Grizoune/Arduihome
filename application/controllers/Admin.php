<?php

class Admin extends CI_Controller{

	public function peripherique(){
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('peripherique');
			$crud->set_subject('peripherique');
			$crud->set_relation('id_type_peripherique','type_peripherique','type');
			$crud->set_relation('id_zone','zone','zone');
			$crud->set_relation('id_fonction','fonction','fonction');
			$output = $crud->render();

			$this->load->view('header', $output);
			$this->load->view('admin', $output);
			$this->load->view('footer');
	}

	public function scheduler(){
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_model('Commande_crud_model');
			$crud->set_table('planification');
			$crud->set_subject('actions panifiées');
			$crud->add_action('Activer/Desactiver', '', 'admin/activeScheduler', 'ui-icon-power');
			$crud->set_relation_n_n('commandes', 'commande_planifiees', 'commande', 'id_planification', 'id_commande', 'nom');
			$output = $crud->render();

			$this->load->view('header', $output);
			$this->load->view('admin', $output);
			$this->load->view('footer');
	}

	public function activeScheduler($_id){
			$this->load->model('scheduler_model');
			$tache_planif = $this->scheduler_model->find($_id);

			if($tache_planif->active == 1){
					$this->db
					->set('active',0)
					->where('id', $_id)
					->update('planification');
			}else{
					//calcul de la prochaine execution
					$next_exec = $this->scheduler_model->calcNextExec($_id);

					$this->db
					->set('active',1)
					->set('next_exec', $next_exec)
					->where('id', $_id)
					->update('planification');
			}

			redirect('admin/scheduler');
	}

	public function scenario(){
			
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('scenario');
			$crud->set_subject('scénario');
			$crud->columns('nom','active','priorite');
			$crud->add_action('Editer le scénario', '', 'scenario/edit', 'ui-icon-script');
			$crud->fields('nom','priorite', 'active');
			$output = $crud->render();

			$this->load->view('header', $output);
			$this->load->view('admin', $output);
			$this->load->view('footer');
	}

	public function log($type){
			$this->load->view('header');
			$this->load->view('log', array('type'=>$type));
			$this->load->view('footer');
	}


	public function serveur_statut(){
			$this->load->library('Arduihome_demon');
			//$this->arduihome_demon->startProcess();
			echo $this->arduihome_demon->getStatut();
	}
}
