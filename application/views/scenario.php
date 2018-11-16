<br/>
<div class="row">
	<div class="col-sm-10">
		<h1>Scénario <?php echo $obj->nom; ?></h1>
	</div>
	<div class="col-sm-2">
		<a href="#" class="btn btn-primary" onclick="saveScenario('<?php echo $type; ?>');" >Enregistrer</a>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/blockly/blockly_compressed.js"></script>
<script src="<?php echo base_url(); ?>assets/blockly/blocks_compressed.js"></script>
<script src="<?php echo base_url(); ?>assets/blockly/msg/messages.js"></script>
<script src="<?php echo base_url(); ?>assets/blockly/msg/js/fr.js"></script>
<script src="<?php echo base_url(); ?>assets/blockly/php_compressed.js"></script>

<div id="blocklyDiv" style="height: 600px; width: 100%;"></div>

 <?php include('includes/toolbox_scenario.php'); ?>

  <code id="code">Code</code>

<script>

  <?php 
    include("includes/blocks/commande.inc");
    include("includes/blocks/valeur.inc");
    include("includes/blocks/heure.inc");
    include("includes/blocks/sleep.inc");
    include("includes/blocks/mode_valeur.inc");
  ?>

  var workspace = Blockly.inject('blocklyDiv',{toolbox: document.getElementById('toolbox')});

	<?php if($obj->xml != ""){ ?>
	 var xml = Blockly.Xml.textToDom('<?php echo $obj->xml; ?>');
	 Blockly.Xml.domToWorkspace(xml, workspace);
	<?php } ?>

	function saveScenario(type_script){
		var xml = Blockly.Xml.workspaceToDom(workspace);
		var xml_text = Blockly.Xml.domToText(xml);
    	var code = Blockly.PHP.workspaceToCode(workspace);
    	var url;

    	switch(type_script){
    		case "scenario":
    			url = "<?php echo site_url('ajax/save_scenario/'.$obj->id); ?>";
    			var_xml = "xml";
    			var_code = "code";
    		break;
    		case "mode_activation":
    			url = "<?php echo site_url('ajax/save_activation/'.$obj->id); ?>";
    			var_xml = "active_xml";
    			var_code = "active_code";
    		break;
    		case "mode_desactivation":
    			url = "<?php echo site_url('ajax/save_desactivation/'.$obj->id); ?>";
    			var_xml = "desactive_xml";
    			var_code = "desactive_code";
    		break
    	}
//data: 'xml='+xml_text+'&code='+btoa(code),
		$.ajax({
		  type: "POST",
		  url: url,
		  data: var_xml+'='+encodeURIComponent(xml_text)+'&'+var_code+'='+encodeURIComponent(code),
		  dataType: "text"
		}).done(function() {
		  alert( "Sauvegarde reussie !" );
		});
	}

  function myUpdateFunction(event) {
      var code = Blockly.PHP.workspaceToCode(workspace);
      code.replace("\\r", "<br/>");
      $('#code').html(code);
   }
  workspace.addChangeListener(myUpdateFunction);

//store
/*    var xml = Blockly.Xml.workspaceToDom(workspace);
var xml_text = Blockly.Xml.domToText(xml);*/

//restore
/*var xml = Blockly.Xml.textToDom(xml_text);
Blockly.Xml.domToWorkspace(xml, workspace);*/






</script>