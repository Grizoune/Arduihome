		<?php include('includes/sidebar.php'); ?>

		 <div class="col-md-10 zone-principale">
	        <h1><img src="<?php echo base_url().'assets/img/icons/'.$zone->image; ?>.svg" style="height: 50px; width: 50px;"/> <?php echo $zone->zone; ?></h1>
	        <div class="row">
		        <?php foreach($peripheriques as $periph){ ?>
		     	 <div class="col-md-3">

					<div class="card">
					  <div class="card-block">
					    <h4 class="card-title"><?php echo $periph->nom; ?></h4>
					  	<?php foreach($periph->commandes as $commande){ ?>
					    <a href="#" onclick="sendCommande(<?php echo $commande->id; ?>); return false;" class="card-link btn bouton bouton-<?php echo $periph->id."-".$commande->nouvelle_valeur; ?>" ><?php echo $commande->nom; ?></a>
					    <?php } ?>
					  </div>
					</div>

				</div>
				<?php } ?>
			</div>
		</div>