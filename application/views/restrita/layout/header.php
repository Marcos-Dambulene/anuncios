<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <?php echo (isset($titulo) ? '<title>Anuncios legais | ' .$titulo. '</title>' : 'title>Anuncios legais| Não deixa de anunciar</title>') ?>;
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/app.min.css'); ?>">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/components.css'); ?>">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/custom.css'); ?>">
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('public/restrita/assets/img/favicon.ico'); ?>' />



    <?php if (isset($styles)): ?>

      <?php foreach ($styles as $estilo): ?>
          
          <link rel="stylesheet" href="<?php echo base_url('public/restrita/' . $estilo); ?>">

      <?php endforeach; ?>

    <?php endif; ?>



</head>

<body>
  <div class="loader"></div>
  
  <div id="app">