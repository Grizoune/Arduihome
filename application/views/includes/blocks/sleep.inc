var sleepJson = {
  "message0": "stop %1 seconds",
  "args0": [
    {
      "type": "field_number",
      "name": "VALUE_SLEEP",
      "value": 1
    }
  ],
  "previousStatement": null,
  "nextStatement": null,
  "colour": 135
};

Blockly.Blocks['sleep'] = {
  init: function() {
    this.jsonInit(sleepJson);
    // Assign 'this' to a variable for use in the tooltip closure below.
    var thisBlock = this; 

    /*this.setTooltip(function() {
      return 'Add a number to variable "%1".'.replace('%1', thisBlock.getFieldValue('VAR_ACTION'));
    });*/
  }
};


Blockly.PHP['sleep'] = function(block) {
  var val = block.getFieldValue('VALUE_SLEEP');
  var code = 'sleep('+val+')\;';
  return code;
};

