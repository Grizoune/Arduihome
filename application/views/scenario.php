<br/>
<div class="row">
	<div class="col-sm-10">
		<h1>Scénario : <?php echo $scenario->nom; ?></h1>
	</div>
	<div class="col-sm-2">
		<a href="#" class="btn btn-primary" onclick="saveScenario();" >Enregistrer</a>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/blockly/blockly_compressed.js"></script>
<script src="<?php echo base_url(); ?>assets/blockly/blocks_compressed.js"></script>
<script src="<?php echo base_url(); ?>assets/blockly/msg/js/fr.js"></script>
<script src="<?php echo base_url(); ?>assets/blockly/php_compressed.js"></script>

<div id="blocklyDiv" style="height: 700px; width: 100%;"></div>

 <?php include('includes/toolbox_scenario.php'); ?>

  <div id="code">Code</div>

<script>
	<?php if($scenario->xml != ""){ ?>}
	var xml = Blockly.Xml.textToDom('<?php echo $scenario->xml; ?>');
	Blockly.Xml.domToWorkspace(xml, workspace);
	<?php } ?>

	function saveScenario(){
		var xml = Blockly.Xml.workspaceToDom(workspace);
		var xml_text = Blockly.Xml.domToText(xml);

		$.ajax({
		  type: "POST",
		  url: "<?php echo site_url('ajax/save_scenario'); ?>",
		  data: xml_text,
		  dataType: "text"
		}).done(function() {
		  $( this ).addClass( "done" );
		});
	}


  var workspace = Blockly.inject('blocklyDiv',
      {toolbox: document.getElementById('toolbox')});

    function myUpdateFunction(event) {
      var code = Blockly.PHP.workspaceToCode(workspace);
      $('#code').html(xml_text);
    }
    workspace.addChangeListener(myUpdateFunction);

//store
/*    var xml = Blockly.Xml.workspaceToDom(workspace);
var xml_text = Blockly.Xml.domToText(xml);*/

//restore
/*var xml = Blockly.Xml.textToDom(xml_text);
Blockly.Xml.domToWorkspace(xml, workspace);*/


var actionJson = {
  "type": "example_dropdown",
  "message0": "Commande: %1",
  "previousStatement": null,
  "nextStatement": null,
  "colour": 230,
  "args0": [
    {
      "type": "field_dropdown",
      "name": "FIELDNAME",
      "options": [
      	<?php foreach($commandes as $commande){ 
			echo '[ "'.$commande->zone.' / '.$commande->peripherique.' / '.$commande->nom.'", "'.$commande->id.'" ],';
      	 } ?>

      ]
    }
  ],

};

Blockly.Blocks['commande_domo'] = {
  init: function() {
    this.jsonInit(actionJson);
    // Assign 'this' to a variable for use in the tooltip closure below.
    var thisBlock = this; 

   /* this.setTooltip(function() {
      return 'Add a number to variable "%1".'.replace('%1', thisBlock.getFieldValue('FIELDNAME'));
    });*/
  }
};


Blockly.PHP['commande_domo'] = function(block) {
  var val = block.getFieldValue('FIELDNAME');
  var code = '$this->commande_model->sendCommande('+val+')\;';
  return code;
};


var valeurJson = {
  "type": "example_dropdown",
  "message0": "Valeur: %1",
  "output": "Number",
  "colour": 85,
  "args0": [
    {
      "type": "field_dropdown",
      "name": "FIELDNAME",
      "options": [
        <?php foreach($peripheriques as $peripherique){ 
      echo '[ "'.$peripherique->zone.' / '.$peripherique->nom.'", "'.$peripherique->id.'" ],';
         } ?>

      ]
    }
  ],

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
  var val = block.getFieldValue('FIELDNAME');
  var code = '$this->peripherique_model->getValue('+val+')';

  return [code, Blockly.PHP.ORDER_MEMBER];
};


</script>