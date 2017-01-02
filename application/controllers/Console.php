<?php

class Console extends CI_Controller{


	public function cron(){
		$this->load->model('scheduler_model');
		$this->scheduler_model->execExpiredTask();
	}



	public function listen()
	{
		$this->load->library('Serveur_XPL');
	
		ini_set ('max_execution_time', 1200);
		$start_time = time();

		$this->load->library('Serveur_XPL');
		$serveur = new Serveur_XPL();
		
		//Create a UDP socket
		if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
		{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		     
		    die("Couldn't create socket: [$errorcode] $errormsg \n");
		}
		 
		echo "Socket created \n";
		 
		// Bind the source address
		if( !socket_bind($sock, "0.0.0.0" , 3865) )
		{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		     
		    die("Could not bind socket : [$errorcode] $errormsg \n");
		}
		 
		//Do some communication, this loop can handle multiple clients
		while(1)
		{

		     
		    //Receive some data
		    $r = socket_recvfrom($sock, $buf, 512, 0, $remote_ip, $remote_port);
			if($buf){

					
				echo "data".$buf;
				/*$this->db->reconnect();

				$datas = explode("\n", $buf);
				$type = $datas[0];
				$source = $datas[3];
				$target = $datas[4];
				$message_type = $datas[6];
				$cmds = array_slice($datas, 8, sizeof($datas)-10);
				$tab_cmd = array();


				foreach($cmds as $commande){
					$lacmd = explode("=", $commande);
					$tab_cmd[$lacmd[0]] =$lacmd[1];
				}
				
				switch($type){
					case 'xpl-trig':
					case 'xpl-stat':
						if($message_type == "hbeat.basic")
							$serveur->make_hbeat($source);
						else
							$serveur->interprete($source, $message_type, $tab_cmd);
					break;

				}*/
			}
			
			  if ((time() - $start_time) > 600) {
			  socket_close($sock);
			exit(0);
			}
		}
		 
		socket_close($sock);
	}

	public function espion()
	{
	
		ini_set ('max_execution_time', 1200);
		$start_time = time();

		$this->load->library('Serveur_XPL');
		$serveur = new Serveur_XPL();
		
		//Create a UDP socket
		if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
		{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		     
		    die("Couldn't create socket: [$errorcode] $errormsg \n");
		}
		 
		echo "Socket created \n";
		 
		// Bind the source address
		if( !socket_bind($sock, "0.0.0.0" , 3865) )
		{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		     
		    die("Could not bind socket : [$errorcode] $errormsg \n");
		}
		 
		//Do some communication, this loop can handle multiple clients
		while(1)
		{

		     
		    //Receive some data
		    $r = socket_recvfrom($sock, $buf, 512, 0, $remote_ip, $remote_port);
			if($buf){

					
			echo $buf;
			}
			
			  if ((time() - $start_time) > 600) {
			  socket_close($sock);
			exit(0);
			}
		}
		 
		socket_close($sock);
	}
}