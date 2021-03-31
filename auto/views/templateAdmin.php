<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" href="./assets/css/templateAdmin.css">

</head>
<body>

<div class="sidenav">
  <!-- <a href="#about">About</a>
  <a href="#services">Services</a>
  <a href="#clients">Clients</a>
  <a href="#contact">Contact</a> -->
  
  <div class="text-center">
      <i class="fas fa-car fa-3x text-white"></i>
  </div>
  <?php if(isset($_SESSION['Auth'])){ ?>

  <a href="index.php?action=logout"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Déconnexion</a>
  <button class="dropdown-btn"><i class="fa fa-list-alt"></i> Catégorie
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="index.php?action=add_cat"><i class="fa fa-plus" aria-hidden="true"></i> Ajout</a>
    <a href="index.php?action=list_cat"><i class="fa fa-bars" aria-hidden="true"></i> Liste</a>
  </div>

  <button class="dropdown-btn"><i class="fas fa-car-side"></i> Voiture
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="index.php?action=add_v"><i class="fa fa-plus" aria-hidden="true"></i> Ajout</a>
    <a href="index.php?action=list_v"><i class="fa fa-bars" aria-hidden="true"></i> Liste</a>
  </div>
<?php if($_SESSION['Auth']->id_g  != 3){ ?>
  <button class="dropdown-btn"><i class="fa fa-user-tag"></i> Grade
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="#"><i class="fa fa-plus" aria-hidden="true"></i> Ajout</a>
    <a href="index.php?action=list_g"><i class="fa fa-bars" aria-hidden="true"></i> Liste</a>
  </div>

  <button class="dropdown-btn"><i class="fas fa-users"></i> Utilisateurs
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <!-- <a href="#"><i class="fa fa-plus" aria-hidden="true"></i> Ajout</a> -->
    <?php if($_SESSION['Auth']->id_g  == 1){ ?>
    <a href="index.php?action=register"><i class="fa fa-registered" aria-hidden="true"></i> Inscription</a>
    <?php } ?>
    <!-- <a href="index.php?action=login"><i class="fas fa-key"></i> Connexion</a> -->
    <a href="index.php?action=list_u"><i class="fa fa-bars" aria-hidden="true"></i> Liste</a>
  </div>
  <!-- <a href="#contact">Search</a> -->
<?php }} ?>
</div>
<div class="main">
  <h1 class="bg-secondary text-center text-white">ADMINISTRATION</h1>
    <h2 class="text-end">
    <?php if(isset($_SESSION['Auth']))
      echo $_SESSION['Auth']->nom;
    ?>
  </h2>
  <?= $contenu; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="./assets/js/templateAdmin.js"></script>
<script src="./assets/js/scriptAjax.js"></script>

</body>
</html> 