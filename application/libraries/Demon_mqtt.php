<?php 

class Demon_mqtt {

	private $CI;
	private $log;

	public function __construct(){

	}

	public function build_demon() {
			require("phpMQTT.php");

			echo "Start MQTT client";

			$server = "192.168.1.5";     // change if necessary
			$port = 1883;                     // change if necessary
			$username = "";                   // set your username
			$password = "";                   // set your password
			$client_id = "phpMQTT-subscriber"; // make sure this is unique for connecting to sever - you could use uniqid()

			$mqtt = new phpMQTT($server, $port, $client_id);

			if(!$mqtt->connect(true, NULL, $username, $password)) {
				exit(1);
			}

			$topics['#'] = array("qos" => 0, "function" => "Arduihome_demon::procmsg");

			$mqtt->subscribe($topics, 0);

			while($mqtt->proc()){
				
			}
			$mqtt->close();
	}

	public static function procmsg($topic, $msg){

			$CI =& get_instance();
		    $peripherique = $CI->peripherique_model->findByTopic($topic);

		    if(isset($peripherique))
				$CI->peripherique_model->updateValeurPeripherique($peripherique->id, $msg);

			$CI->scenario_model->executeAll();
	}

}