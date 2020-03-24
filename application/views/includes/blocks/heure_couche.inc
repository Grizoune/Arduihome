var heureCJson = {
  "message0": "Heure couché soleil",
  "colour": 230,
  'output': null
};

Blockly.Blocks['heure_couche_domo'] = {
  init: function() {
    this.jsonInit(heureCJson);
    // Assign 'this' to a variable for use in the tooltip closure below.
    var thisBlock = this; 

  }
};

Blockly.PHP['heure_couche_domo'] = function(block) {
  return ['h_couche()', Blockly.PHP.ORDER_MEMBER];
};

