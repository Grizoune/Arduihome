
		 <div class="col-md-12 zone-principale">
	        <h1><img src="<?php echo base_url(); ?>assets/img/icons/modes.svg" style="height: 50px; width: 50px;"/> Modes</h1>
	        <div class="row">
		        <?php foreach($modes as $mode){ ?>
		     	 <div class="col-md-2">

					<div class="card">
					  <div class="card-block">
					    <h4 class="card-title"><?php echo $mode->nom; ?> </h4>
							
					    <a href="#" onclick="activeMode(<?php echo $mode->id; ?>); return false;" class="card-link btn mode mode-<?php echo $mode->id; ?>" >Activer</a>
					    
					  </div>
					</div>

				</div>
				<?php } ?>
			</div>
		</div>