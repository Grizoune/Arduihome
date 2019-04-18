<?php
	class Arduihome_log{

			private $path;
			private $types = array("infos", "errors", "trames");

			public function __construct(){
				$this->path  = FCPATH."application/logs/";
					/*foreach($this->types as $type)
						$this->write($type, "");*/

			}

			public function write($type, $message){

				//if(in_array($type, $this->types)){
					try {
						$file = fopen($this->path.$type."_".date('Ymd').".log", 'a+');
						fwrite($file, date("Y-m-d H:i:s")." : ".$message."\n");
						fclose($file);
					}catch(Exception $e){
							$this->write('errors', 'Exception reçue lors de la mise en log : '.$e->getMessage());
					}
				//}
			}

			public function getContent($type){
				if(file_exists($this->path.$type."_".date('Ymd').".log"))
					$content = file_get_contents($this->path.$type."_".date('Ymd').".log");
				else
					$content = "Fichier inexistant";
				return $content;
			}
	}