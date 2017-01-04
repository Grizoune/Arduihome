<?php


class Scenario_model extends CI_Model{


	public function find($_id){
		return $this->db
			->where('id', $_id)
			->get('scenario')
			->row();
	}
}