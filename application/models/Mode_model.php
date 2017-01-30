<?php

class Mode_model extends CI_Model{

	public function find($_id){
		return $this->db
			->where('id', $_id)
			->get('mode')
			->row();
	}

	public function save($_id, $datas){

		foreach($datas as $key=>$data)
				$datas[$key] = $data;

		$this->db->where('id', $_id);
		$this->db->update('mode', $datas); 

	}

}