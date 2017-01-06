<?php

class Console extends CI_Controller{


	public function cron(){
		$this->load->model('scheduler_model');
		$this->scheduler_model->execExpiredTask();
	}



	public function listen()
	{
		//$this->load->library('Serveur_XPL');
		
		ini_set ('max_execution_time', 1200);
		$start_time = time();

		//$serveur = new Serveur_XPL();
		
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
				//ICI C EST LE COEUR DU REACTEUR
				$this->db->reconnect();
				$message = $this->parseMessage($buf);

				//recherche du peripherique
				if(isset($message->peripherique)){
					$peripherique = $this->peripherique_model->find($message->peripherique);
					if(isset($peripherique->id) && isset($message->valeur)){
						//truc de ouf, on a trouvé un peripherique, on met à jour sa valeur
						$this->peripherique_model->updateValeurPeripherique($peripherique->id, $message->valeur);
						echo "mise à jour de la valeur de '".$peripherique->nom."', nouvelle valeur : ".$message->valeur;
						$this->load->model('scenario_model');
						//on relance tous les scenarios
						$this->scenario_model->executeAll();
						echo "fin de l'execution des scenarios";
					}
				}
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


	public function parseMessage($buf){
		$message = new StdClass();

		$datas = explode("\n", $buf);
		$message->type = $datas[0];
		$message->source = $datas[3];
		$message->target = $datas[4];
		$message->message_type = $datas[6];
		$cmds = array_slice($datas, 8, sizeof($datas)-10);
		$message->commandes = array();


		foreach($cmds as $commande){
			$lacmd = explode("=", $commande);
			$message->commandes[$lacmd[0]] =$lacmd[1];

			if($lacmd[0] == "device")
				$message->peripherique = (int)$lacmd[1];
			if($lacmd[0] == "current")
				$message->valeur = (int)$lacmd[1];
		}

		return $message;
	}
}