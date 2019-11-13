<?php

class Demon_xpl
{

		private $CI;
		private $log;

		public function __construct(){

		}

		public function build_demon(){


			$this->CI =& get_instance();

			$this->CI->load->library('Arduihome_log');
			$this->log = $this->CI->arduihome_log;
			
			//ini_set ('max_execution_time', 0);
			$start_time = time();

			//$serveur = new Serveur_XPL();
			
			//Create a UDP socket
			if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
			{
			    $errorcode = socket_last_error();
			    $errormsg = socket_strerror($errorcode);
			     
			    die("Couldn't create socket: [$errorcode] $errormsg \n");
			}
			 
			echo "Serveur XPL started \n";
			 
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

					$this->log->write("trames", $buf);

					//ICI C EST LE COEUR DU REACTEUR
					try{
						$message = $this->parseMessage($buf);

						//recherche du peripherique
						if(isset($message->peripherique)){

							if($peripherique = $this->CI->peripherique_model->find($message->peripherique)){

								//si c'est une trame courte (type log), bas on log
								if($message->longueur == 1){

									$this->CI->defaut_model->add($message);
									
								}elseif($message->longueur == 2 && isset($peripherique->id) && isset($message->valeur)){
								//sinon on execute les scénarios
									//truc de ouf, on a trouvé un peripherique, on met à jour sa valeur
									$this->CI->peripherique_model->updateValeurPeripherique($peripherique->id, $message->valeur);

									if(isset($message->commandes["lock"]) && $message->commandes["lock"] == "1")
										$this->CI->peripherique_model->lock($peripherique->id);
									if(isset($message->commandes["lock"]) && $message->commandes["lock"] == "0")
										$this->CI->peripherique_model->unlock($peripherique->id);
									//$this->log->write("infos", "mise à jour de la valeur de '".$peripherique->nom."', nouvelle valeur : ".$message->valeur);
									$this->CI->load->model('scenario_model');

									//on relance tous les scenarios*
									$this->CI->scenario_model->executeAll();
								}

							}


						}
					}catch(Exception $e){
						$this->log->write('errors', 'Exception reçue : '.$e->getMessage());
					}
				}
				if ((time() - $start_time) > 600) {
				    socket_close($sock);
					exit(0);
				}
			}
			 
			socket_close($sock);
			echo "close server";
			$this->log->write("infos", "process serveur terminé");
		}

		private function parseMessage($buf){
			$longueur = mb_substr_count($buf, "{");
			//type 1 = message simple type log
			//type 2 = message long
			$message = new StdClass();
			$message->longueur = $longueur;
			$datas = explode("\r\n", $buf);
			$message->type = $datas[0];

			if($longueur == 2){
				$message->source = $datas[3];
				$message->target = $datas[4];
				$message->message_type = $datas[6];
				$cmds = array_slice($datas, 8, sizeof($datas)-10);
			}else{
				$cmds = array_slice($datas, 2, sizeof($datas)-2);
			}

			
			$message->commandes = array();

			foreach($cmds as $commande){
				$lacmd = explode("=", $commande);

				if(strstr($commande, "=")){
					$message->commandes[$lacmd[0]] =$lacmd[1];

					if($lacmd[0] == "device")
						$message->peripherique = (int)$lacmd[1];
					if($lacmd[0] == "current" || $lacmd[0] == "value")
						$message->valeur = (float)$lacmd[1];										
				}
			}

			return $message;
		}

		public function getStatut(){

			exec("ps -ef | grep 'index.php serveur start'", $process);

			if(sizeof($process) > 2)
				return true;
			else
				return false;
		}

		public function startProcess(){
			set_time_limit(3);
			exec("php ".FCPATH."index.php serveur start >> /dev/null &");
			echo "serveur started !";
		}
}
