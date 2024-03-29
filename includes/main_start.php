<?php
require_once("base.php");
require_once("database.php");
require_once("functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>

  <!-- Favicon icon -->
  <link rel="icon" href="<?= BASEURL ?>/assets/img/logo/favicon.svg" type="image/x-icon">
  <!-- Font Family -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <?php if (!isset($_SESSION["login"]) || $_SESSION["login"] != true || $_SESSION["level"] != 1) : ?>
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/style-custom.css">
    <!-- Preloader -->
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/preloader.css">
  <?php else : ?>
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <link href="<?= BASEURL ?>/assets/css/style.css" rel="stylesheet">
  <?php endif; ?>
</head>

<body class="min-vh-100">
  <div id="preloader">
    <div class="sk-three-bounce">
      <div class="sk-child sk-bounce1"></div>
      <div class="sk-child sk-bounce2"></div>
      <div class="sk-child sk-bounce3"></div>
    </div>
  </div>

  <div id="main-wrapper">
    <?php if (!isset($_SESSION["login"]) || $_SESSION["login"] != true || $_SESSION["level"] != 1) : ?>
      <?php require_once("templates/navbar.php"); ?>
    <?php else : ?>
      <?php
      $user = getUserByEmail($_SESSION["email"]);
      require_once("templates/navbar-admin.php");
      require_once("templates/sidebar-admin.php");
      ?>
    <?php endif; ?>