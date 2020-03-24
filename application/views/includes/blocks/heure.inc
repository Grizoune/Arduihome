var heureJson = {
  "message0": "Heure courante",
  "colour": 230,
  'output': null
};

Blockly.Blocks['heure_domo'] = {
  init: function() {
    this.jsonInit(heureJson);
    // Assign 'this' to a variable for use in the tooltip closure below.
    var thisBlock = this; 

  }
};

Blockly.PHP['heure_domo'] = function(block) {
  return ['h_courante()', Blockly.PHP.ORDER_MEMBER];
};

