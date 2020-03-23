<?php

class Serveur extends CI_Controller{


	public function cron(){
		$this->load->model('scheduler_model');
		$this->load->library('Arduihome_log');
		$this->load->library('Arduihome_demon');
		//$this->arduihome_log->write("infos", "execution de la cron");

		$this->scheduler_model->execExpiredTask();
		
		
		if($this->arduihome_demon->getStatut() ==0){
				$this->arduihome_demon->startProcess();				
				//$this->arduihome_log->write("infos", "redemarrage automatique du serveur via la tache cron");
		}

	}

	public function start_xpl()
	{
		$this->load->library('Demon_xpl');
		$this->demon_xpl->build_demon();
	}

	public function start_mqtt()
	{
		$this->load->library('Demon_mqtt');
		$this->demon_mqtt->build_demon();

	}
}