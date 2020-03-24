<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function identification(){

		$this->config->load('arduihome');

		if($this->input->post()){
			if(md5($this->input->post('password')) == $this->config->item('arduihome_motdepasse')){
				$this->session->set_userdata('is_ident', true);
				redirect('dashboard/index');
			}

		}

		$this->load->view('identification');
	}

	public function deconnexion(){
		$this->session->set_userdata('is_ident', false);
		redirect('dashboard/index');
	}

	public function tablette(){
		$this->config->load('arduihome');
		redirect($this->config->item('arduihome_screensaver'));
	}

	public function public_info(){
		$myObj = array();
		$myObj[0]['text'] = 'heure leve : '.heure_leve();
		$myObj[0]['type'] = "string";
		$myObj[1]['text'] = 'heure couche : '.heure_couche();
		$myObj[1]['type'] = "string";
		$myObj[2]['text'] = 'sun_time : '.sun_time();	
		$myObj[2]['type'] = "string";
		echo json_encode($myObj);
	}
}