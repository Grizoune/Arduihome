<?php

class Scheduler_model extends CI_Model{


	public function execExpiredTask(){

		$planifications = $this->db
							->where('next_exec <= NOW()')
							->where('active', 1)
							->get('planification')
							->result();


		foreach($planifications as $key=>$planification){
			$now = new DateTime();
			$next = new DateTime();
			$next->add(new DateInterval('P'.$planification->interval));

			$data = array(
					'last_exec' => $now->format('Y-m-d H:i:s'),
					'next_exec' => $next->format('Y-m-d H:i:s')
				);

			$this->db->where('id', $planification->id);
			$this->db->update('planification', $data);


			$commandes = $this->db
							->where('id_planification', $planification->id)
							->get('commande_planifiees cp')
							->result();

			foreach($commandes as $commande){
				$this->commande_model->sendCommande($commande->id_commande);
			}
		}
	}

	public function find($_id){
		return $this->db->where('id', $_id)->get('planification')->row();
	}

	public function calcNextExec($_id){
		$obj = $this->find($_id);

		$next_exec = new DateTime($obj->last_exec);
		$now = new DateTime();

		while($next_exec->getTimestamp() < $now->getTimestamp()){
				$next_exec->add(new DateInterval('P'.$obj->interval));
		}

		return $next_exec->format('Y-m-d H:i:s');
	}
}