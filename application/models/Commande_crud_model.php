<?php

class Commande_crud_model extends grocery_CRUD_Model  {
 
	function get_relation_n_n_unselected_array($field_info, $selected_values)
	 
	{

		$valeurs = parent::get_relation_n_n_unselected_array($field_info, $selected_values);

		$retours = $this->db
			->select('c.id, CONCAT(z.zone, " / ", p.nom, " / ", c.nom) as nom')
			->where('c.id IN ('.implode(array_keys($valeurs), ",").')')
			->join('peripherique p', 'p.id = c.id_peripherique')
			->join('zone z', 'z.id = p.id_zone')
			->order_by("z.id, p.id")
			->get('commande c')
			->result();

		$tab_result = array();
		foreach($retours as $retour){
			$tab_result[$retour->id] = $retour->nom;
		}

		return $tab_result;
   
	}

	function get_relation_n_n_selection_array($field_info, $selected_values)
	 
	{

		$valeurs = parent::get_relation_n_n_selection_array($field_info, $selected_values);

		$retours = $this->db
			->select('c.id, CONCAT(z.zone, " / ", p.nom, " / ", c.nom) as nom')
			->where('c.id IN ('.implode(array_keys($valeurs), ",").')')
			->join('peripherique p', 'p.id = c.id_peripherique')
			->join('zone z', 'z.id = p.id_zone')
			->order_by("z.id, p.id")
			->get('commande c')
			->result();

		$tab_result = array();
		foreach($retours as $retour){
			$tab_result[$retour->id] = $retour->nom;
		}

		return $tab_result;
   
	}
	 
}