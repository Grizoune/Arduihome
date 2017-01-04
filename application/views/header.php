<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

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

    <nav class="navbar navbar-fixed-top navbar-dark bg-inverse">

      <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>/assets/img/arduihome.gif" /></a>

      <ul class="nav navbar-nav">



        <li class="nav-item active">
          <a class="nav-link" href="<?php echo site_url('dashboard/index'); ?>">Dashboard <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('admin/scenario'); ?>">Scénarios </a>
        </li>

          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestion</a>
          <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/peripherique'); ?>">Peripheriques</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/action'); ?>">Actions</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/scheduler'); ?>">Actions planifiées</a>
          </div>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
    


