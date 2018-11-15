		<?php include('includes/sidebar.php'); ?>

		 <div class="col-md-10 zone-principale">
	        <h1><img src="<?php echo base_url().'assets/img/icons/'.$zone->image; ?>.svg" style="height: 50px; width: 50px;"/> <?php echo $zone->zone; ?></h1>
	        <div class="row">

	        <!--<video width="400" height="222" src="rtsp://admin@192.168.1.33:554">
				  Ici l'alternative à la vidéo : un lien de téléchargement, un message, etc.
				</video>-->


		        <?php foreach($peripheriques as $periph){ ?>
		     	 <div class="col-md-3">

					<div class="card">
					  <div class="card-block">
					    <h4 class="card-title"><?php echo $periph->nom; ?> 
					    <a href="#" onclick="ajoutFavoris(<?php echo $periph->id; ?> );">
					    <?php if($periph->favoris){ ?>
					    <img src="<?php echo base_url(); ?>assets/img/icons/etoile.svg" style="height: 20px;width: 20px;" /></a>
					    <?php }else{ ?>
						<img src="<?php echo base_url(); ?>assets/img/icons/etoile_vide.svg" style="height: 20px;width: 20px;" /></a>
					    <?php } ?>
					    <img src="<?php echo base_url(); ?>assets/img/icons/clef.svg" style="height: 20px;width: 20px;display:none;" class="verou-<?php echo $periph->id; ?>"/></a>
					    </h4>

					    <?php if(!empty($periph->widget))include('widget/'.$periph->widget.".php"); ?>

					  	<?php foreach($periph->commandes as $commande){ ?>
					    <a href="#" onclick="sendCommande(<?php echo $commande->id; ?>); return false;" class="card-link btn bouton bouton-<?php echo $periph->id."-".$commande->nouvelle_valeur; ?>" ><?php echo $commande->nom; ?></a>
					    <?php } ?>
					  </div>
					</div>

				</div>
				<?php } ?>
			</div>
		</div>