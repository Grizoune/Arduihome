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
}