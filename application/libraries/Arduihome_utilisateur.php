<?php


	class Arduihome_utilisateur{

			public function __construct(){
				$this->ci =& get_instance();
	
				if($this->ci->session->has_userdata('is_ident') == null && $this->ci->router->fetch_class()!="front" && $this->ci->router->fetch_class()!="serveur")
					redirect('front/identification');
			}
	}