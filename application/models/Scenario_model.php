<?php

class Scenario_model extends CI_Model{

	private $peripheriques_valeurs;
	private $new_peripheriques_valeurs;

	public function __construct(){
		parent::__construct();


	}

	public function find($_id){
		return $this->db
			->where('id', $_id)
			->get('scenario')
			->row();
	}

	public function findAllActifs(){
		return $this->db
			->where('active', 1)
			->order_by('priorite DESC')
			->get('scenario')
			->result();
	}

	public function save($_id, $datas){

		foreach($datas as $key=>$data)
				$datas[$key] = $data;

		$this->db->where('id', $_id);
		$this->db->update('scenario', $datas); 

	}


	public function executeAll(){
			foreach($this->peripherique_model->findAll() as $peripherique)
				$this->peripheriques_valeurs[$peripherique->id] = $peripherique->valeur;	

			$this->new_peripheriques_valeurs = $this->peripheriques_valeurs;	

			foreach($this->findAllActifs() as $scenario)
				$this->execute($scenario->id);

			$this->executeCommandes();
	}


	public function execute($_id_scenario){
			$scenar = $this->find($_id_scenario);
			eval($scenar->code);
	}

	public function sendCommande($_id_commande){
		$commande = $this->commande_model->find($_id_commande);
		$this->new_peripheriques_valeurs[$commande->id_peripherique] = $commande->nouvelle_valeur;
	}

	public function getValeur($_id_peripherique){
		return $this->new_peripheriques_valeurs[$_id_peripherique];
	}

	public function getValeurMode($_id_mode){
		return $this->mode_model->find($_id_mode)->valeur;
	}

	public function executeCommandes(){
		//$this->load->library('Arduino_log');
		foreach($this->peripherique_model->findAll() as $peripherique){

			if($this->peripheriques_valeurs[$peripherique->id] != $this->new_peripheriques_valeurs[$peripherique->id] && !$peripherique->locked){
				$this->commande_model->sendCommandeByPerifAndValeur($peripherique->id, $this->new_peripheriques_valeurs[$peripherique->id]);
				time_nanosleep(0,300000000);
				//$this->Arduino_log->write('infos',"Modification automatique de : ".$peripherique->nom.", nouvelle valeur : ".$this->new_peripheriques_valeurs[$peripherique->id]);
			}
		}
	}

    private function encode($value)
	{
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    return str_replace($search, $replace, $value);
	}
}