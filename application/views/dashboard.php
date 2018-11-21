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
					    <?php } ?></a>
					    <img src="<?php echo base_url(); ?>assets/img/icons/clef.svg" style="height: 20px;width: 20px;display:none;" class="verou-<?php echo $periph->id; ?>"/>
						<img src="<?php echo base_url(); ?>assets/img/warning.png" style="<?php if(sizeof($periph->warns)==0)echo "display:none;"; ?>" class="warning-<?php echo $periph->id; ?>" data-toggle="modal" data-target="#exampleModalCenter" />
						<img src="<?php echo base_url(); ?>assets/img/error.png" style="<?php if(sizeof($periph->errors)==0)echo "display:none;"; ?>" class="alert-<?php echo $periph->id; ?>" data-toggle="modal" data-target="#exampleModalCenter" />


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
<script type="text/javascript">
$('.modal').modal({});
	</script>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
