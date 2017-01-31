
var valeurModeJson = {
  "message0": "Etat du mode %1",
  "output": "Number",
  "colour": 212,
  "args0": [
    {
      "type": "field_dropdown",
      "name": "MODE_VALEUR",
      "options": [
        <?php foreach($this->mode_model->findAll() as $mode){ 
            echo '[ "'.$mode->nom.'", "'.$mode->id.'" ],';
         } ?>
      ]
    }
  ]
};

Blockly.Blocks['valeur_mode'] = {
  init: function() {
    this.jsonInit(valeurModeJson);
    // Assign 'this' to a variable for use in the tooltip closure below.
    var thisBlock = this;
    /*this.setTooltip(function() {
      return 'Add a number to variable "%1".'.replace('%1',thisBlock.getFieldValue('VAR'));
    });*/
  }
};

Blockly.PHP['valeur_mode'] = function(block) {
  var val = block.getFieldValue('MODE_VALEUR');
  var code = '$this->getValeurMode('+val+')';

  return [code, Blockly.PHP.ORDER_MEMBER];
};