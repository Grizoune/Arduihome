
var valeurJson = {
  "message0": "Valeur: %1",
  "output": "Number",
  "colour": 85,
  "args0": [
    {
      "type": "field_dropdown",
      "name": "VAR_VALEUR",
      "options": [
        <?php foreach($peripheriques as $peripherique){ 
      echo '[ "'.$peripherique->zone.' / '.$peripherique->nom.'", "'.$peripherique->id.'" ],';
         } ?>
      ]
    }
  ]
};

Blockly.Blocks['valeur_domo'] = {
  init: function() {
    this.jsonInit(valeurJson);
    // Assign 'this' to a variable for use in the tooltip closure below.
    var thisBlock = this;
    /*this.setTooltip(function() {
      return 'Add a number to variable "%1".'.replace('%1',thisBlock.getFieldValue('VAR'));
    });*/
  }
};

Blockly.PHP['valeur_domo'] = function(block) {
  var val = block.getFieldValue('VAR_VALEUR');
  var code = '$this->peripherique_model->getValue('+val+')';

  return [code, Blockly.PHP.ORDER_MEMBER];
};