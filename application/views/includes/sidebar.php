		 <div class="col-md-2 sidebar">
		          <ul>
		            <li class="active"><a href="<?php echo site_url('dashboard/index'); ?>"><i class="icon-fav"></i> Favoris</a></li>
		            <?php foreach($this->zone_model->getZones() as $zone_sidebar){ ?>
		            	<li><nobr><a href="<?php echo site_url('dashboard/index/'.$zone_sidebar->id); ?>"><i class="icon" style="background-image: url('<?php echo base_url().'assets/img/icons/'.$zone_sidebar->image.'.svg'; ?>');"></i> <?php echo $zone_sidebar->zone; ?></a></nobr></li>
		            <?php } ?>
		          </ul>
		 </div>
