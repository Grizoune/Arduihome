var actionJson = {
  "message0": "Commande: %1",
  "previousStatement": null,
  "nextStatement": null,
  "colour": 230,
  "args0": [
    {
      "type": "field_dropdown",
      "name": "VAR_ACTION",
      "options": [
      	<?php foreach($commandes as $commande){ 
			echo '[ "'.$commande->zone.' / '.$commande->peripherique.' / '.$commande->nom.'", "'.$commande->id.'" ],';
      	 } ?>
      ]
    }
  ]
};

Blockly.Blocks['commande_domo'] = {
  init: function() {
    this.jsonInit(actionJson);
    // Assign 'this' to a variable for use in the tooltip closure below.
    var thisBlock = this; 

    /*this.setTooltip(function() {
      return 'Add a number to variable "%1".'.replace('%1', thisBlock.getFieldValue('VAR_ACTION'));
    });*/
  }
};


Blockly.PHP['commande_domo'] = function(block) {
  var val = block.getFieldValue('VAR_ACTION');
  var code = '$this->commande_model->sendCommande('+val+')\;';
  return code;
};
