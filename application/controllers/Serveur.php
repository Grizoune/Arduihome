<?php

class Serveur extends CI_Controller{


	public function cron(){
		$this->load->model('scheduler_model');
		$this->scheduler_model->execExpiredTask();
	}



	public function start()
	{
		$this->load->library('Arduihome_demon');
		$this->arduihome_demon->build_demon();
	}
}