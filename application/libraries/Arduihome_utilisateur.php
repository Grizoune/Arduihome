<?php


	class Arduihome_utilisateur{

			public function __construct(){
				$this->ci =& get_instance();
	
				if(empty($this->ci->session->userdata('is_ident')) && $this->ci->router->fetch_class()!="front" && $this->ci->router->fetch_class()!="serveur")
					redirect('front/identification');
			}
	}