<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url(); ?>assets/iui-favicon.png">

    <title>Arduihome - Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/arduihome.css" rel="stylesheet">

      <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
           <script src="<?php echo base_url(); ?>/assets/js/arduihome.js"></script>


    <?php 
        if(isset($css_files)){
          foreach($css_files as $file){ 
            ?><link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" /><?php 
          }
        }
        if(isset($js_files)){ 
            foreach($js_files as $file){ 
              ?><script src="<?php echo $file; ?>"></script><?php
             }
        } 
?>
    <script>
        var site_url = "<?php echo site_url(); ?>";
    </script>
  </head>

  <body>
     <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse navbar-dark">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>/assets/img/arduihome.gif" /></a>

          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="nav navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo site_url('dashboard/index'); ?>">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('mode/index'); ?>">Modes </a>
            </li>
          </ul>

            <div class="my-3 my-lg-0">

              <ul class="collapse navbar-collapse mini-menu">
                <li>
                <a href="#" onclick="restartServeur();" class="btn" id="demon-statut">Demond status</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url()."assets/img/engrenage.png"; ?>" /></a>
                  <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
                    <a class="dropdown-item" href="<?php echo site_url('admin/peripherique'); ?>">Peripheriques</a>
                    <a class="dropdown-item" href="<?php echo site_url('admin/scheduler'); ?>">Actions planifiées</a>
                    <a class="dropdown-item" href="<?php echo site_url('admin/scenario'); ?>">Scénarios </a>
                    <a class="dropdown-item" href="<?php echo site_url('admin/mode'); ?>">Modes </a>
                  </div>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url()."assets/img/info.png"; ?>" /></a>
                  <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
                    <a class="dropdown-item" href="<?php echo site_url('admin/log/infos'); ?>">infos</a>
                    <a class="dropdown-item" href="<?php echo site_url('admin/log/errors'); ?>">Errors</a>
                    <a class="dropdown-item" href="<?php echo site_url('admin/log/trames'); ?>">Trames</a>
                  </div>
                </li>

                <li class="nav-item"><a href="<?php echo site_url('front/deconnexion'); ?>"><img src="<?php echo base_url()."assets/img/power.png"; ?>" /></a></li>
              </ul>
            </div>
          </div>
        </nav>

        <div class="container-fluid">

          <div class="row">
    


