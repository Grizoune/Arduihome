var heureLJson = {
  "message0": "Heure levé soleil",
  "colour": 230,
  'output': null
};

Blockly.Blocks['heure_leve_domo'] = {
  init: function() {
    this.jsonInit(heureLJson);
    // Assign 'this' to a variable for use in the tooltip closure below.
    var thisBlock = this; 

  }
};

Blockly.PHP['heure_leve_domo'] = function(block) {
  return ['h_leve()', Blockly.PHP.ORDER_MEMBER];};

