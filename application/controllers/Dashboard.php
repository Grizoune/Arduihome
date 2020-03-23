<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($_id_zone=null)
	{

		if($_id_zone)
			$zone = $this->zone_model->find($_id_zone);
		else
			$zone = $this->zone_model->BuildFavorisZone();
		
		$data = array(
			'zone' => $zone,
			'peripheriques' => $this->zone_model->getPeripheriques($zone)
		);

		$this->load->view('header');
		$this->load->view('dashboard', $data);
		$this->load->view('footer');
	}


	public function identification(){
		$this->load->view('identification');
	}

	public function tablette(){
		$this->config->load('arduihome');
		redirect($this->config->item('arduihome_screensaver'));
	}
}
