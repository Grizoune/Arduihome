<?php

class Serveur extends CI_Controller{


	public function cron(){
		$this->load->model('scheduler_model');
		$this->scheduler_model->execExpiredTask();
		
		$this->load->library('Arduihome_demon');
		if($this->arduihome_demon->getStatut() ==0){

				$this->arduihome_demon->startProcess();
				
				$this->load->library('Arduihome_log');
				$this->arduihome_log->write("infos", "redemarrage automatique du serveur via la tache cron");
		}

	}



	public function start()
	{
		$this->load->library('Arduihome_demon');
		$this->arduihome_demon->startProcess();
	}
}