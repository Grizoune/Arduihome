<?php if($periph->valeur == 1){ ?>
<span style="color: #fff;background-color: #c9302c;padding: 5px;">Alarme active</span>
<?php }else{ ?>
<span style="color: #fff;background-color: #5cb85c;padding: 5px;">Alarme inactive</span>
<?php } ?><br/>
<span style="font-size: 8pt;"><i>Last heatbeat : <?php echo $periph->last_heartbeat; ?></i></span>